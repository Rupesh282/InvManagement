<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    function autocomplete(given_items) {
        // console.log(item_name);
        // console.log(item_name);
        details = []
        for (i = 0; i < given_items.length; i++) {
            id = given_items[i]['item_id'];
            name = given_items[i]['item_name'];
            temp = {label:name, value:id};
            details.push(temp);
        }
        var availableTags = details;
        var ele = ".item";
        console.log(ele);
        $(ele ).autocomplete({
            invalidClass:'invalid',
            source: availableTags,
            change: function (event, ui) {
                if(!ui.item.label){
                    //http://api.jqueryui.com/autocomplete/#event-change -
                    // The item selected from the menu, if any. Otherwise the property is null
                    //so clear the item for force selection
                    $("." + ele).val("");
                    $(".item_id").val("");
                }

            },
            select: function(event, ui)
            {
                var id = ui.item.value;
                var name = ui.item.label;
                // var inputF = document.getElementById(ele);
                $(ele).val(name);
                $(".item_id").val(id);
                return false;
            },
            focus: function(event, ui){
                return false;
            },
            messages: {
                noResults:'',
            }
        });
    };
</script>
<script type="text/javascript">
    var item_count=0;
    console.log("yeah123123");
    // var select_quantity = "<input placeholder=\"quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\">";
    function add_item(){
        console.log("yeah");
        var id = document.getElementById("item_id").value;
        var name = document.getElementById("item").value;
        var quantity = document.getElementById("quantity").value;
        if( id!="" && name!= "" && quantity != ""){
            var select_id = "<input class=\"id"+(item_count+1)+"\" name=\"id"+(item_count+1)+"\" readonly value=\""+(id)+"\">";
            var select = "<input class=\"item"+(item_count+1)+"\" name=\"item"+(item_count+1)+"\" readonly value=\""+(name)+"\">";
            var select_quantity = "<input placeholder=\"quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\" readonly value=\""+(quantity)+"\">";
            var t = document.getElementById("bill");
            t.insertRow(item_count).insertCell(0).innerHTML = select_id + '</input>';
            t.rows[item_count].insertCell(1).innerHTML = select + '</input>';
            t.rows[item_count].insertCell(2).innerHTML = select_quantity + '</input>';
            item_count++;
        }
    }

    function putTotalItems()
    {
        var i=document.getElementById('item_count');
        i.value=item_count;
    }
</script>
<?php
    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();
    echo "<style> .ui-helper-hidden-accessible { display:none; } </style>";

    if(isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"] == true and ($_SESSION["access"]=="cashier" || $_SESSION["access"]=="owner" )) {
        $qry = "select * from inventory";
        $items = $PG_CLIENT->query_select($qry);
        if(isset($_POST['make_bill'])){
            $item_count=$_POST['item_count'];
            $contact_no=$_POST['contact_no'];
            $qry="select * from customer where contact_no='$contact_no'";
            $res=$PG_CLIENT->query_select($qry);
            if(count($res)==0)
            {
                die("Invalid contact number. Please add a customer first.");
            }
            //$selected_items[$item_count][3];
            $selected_items=array();
            for($i=1;$i<=$item_count;$i++)
            {
                $selected_items[$i-1]=array();
                $selected_items[$i-1][0]=$_POST['id'.$i];
                $selected_items[$i-1][1]=$_POST['item'.$i];
                $selected_items[$i-1][2]=$_POST['quantity'.$i];
            }
            $valid_items=array();
            $error="";
            //print_r($selected_items);
            $total_payment=0;
            $total_discount=0;
            $total_tax=0;
            foreach($selected_items as $arr)
            {
                $item_id=$arr[0];
                $item_name=$arr[1];
                $item_quan=$arr[2];
                $qry="select convert(int, round(item_price, 0)) * from inventory where item_id=$item_id and item_name='$item_name'";
                $res=$PG_CLIENT->query_select($qry);
                //echo "res<br>";
                //print_r($res);
                if(count($res)==0)
                {
                    $error=$error."'$item_name': Name is invalid\n";
                }
                else {
                    $item_price = $res[0]['item_price'];
                    $item_discount = $res[0]['item_discount'];
                    $item_tax = $res[0]['item_tax'];
                    $final_price=(intval($item_price) * intval($item_quan) * (1-floatval($item_discount)) * (1+floatval($item_tax)) );
                    print(gettype($item_price));
                    print(intval($item_price));
                    $valid_items[] = (array('ID' => $item_id, 'Name' => $item_name, 'Quantity' => $item_quan, 'Price' => $item_price, 'Discount' => $item_discount, 'Tax' => $item_tax, 'Net price'=>$final_price));
                    $total_payment += $item_price * $item_quan;
                    $total_tax += $item_price * $item_quan * $item_tax;
                    $total_discount += $item_price * $item_quan * $item_discount;
                    $available_quantity = $res['item_quantity'];
                    if ($item_quan > $available_quantity) {
                        $qry = 'update inventory set item_quantity=item_quantity - $item_quan';
                        $PG_CLIENT->query_update($qry);
                    }

                }

            }
            $current_dt = date('Y-m-d H:i:s');
            $qry="insert into bill_book(contact_no,net_discount,total_payment,total_tax,datetime) values($contact_no,
$total_discount,$total_payment,$total_tax,$current_dt)";
            $PG_CLIENT->query_update($qry);
            $qry="select bill_id from bill_book order by bill_id DESC limit 1";
            $res=$PG_CLIENT->query_select($qry);
            $bill_id=$res[0]['bill_id'];
            print($PG_CLIENT->build_table($valid_items));
            print($error);







        }
    } else {
        die("ACCESS DENIED");
    }
?>
<?php

?>
<?php
echo '

';
echo"
    
            
     <div align='center' xmlns=\"http://www.w3.org/1999/html\">
        MAKE BILL <br><br>
        <input type='text' name='contact_no' form='bill_form' placeholder='Enter customer contact no.' required>
        <h4>Enter the item name and select from suggestion list</h4>
        
            <input name='item_id' id='item_id' class='item_id' readonly></input>
            <input name='item' id='item' class='item' placeholder='Enter item name' required></input>
            <input name='quantity' id='quantity' placeholder='Enter quantity'required></input>
            <br><br>
            <button name='add_item' onclick=window.add_item()>Add</button>
            <input type='submit' name='make_bill' form='bill_form'>
            <form action='make_bill_test.php' id='bill_form' onsubmit='putTotalItems()' method='POST'>
            <input type='hidden' name='item_count' id='item_count'>
            <br><br><h2>Added Items</h2>         
            <table id='bill'>
            
";?>
<?php
echo "	     </table>
		 </form></div> ";
?>

<?php
    $temp = json_encode($items);
    echo "<script> autocomplete($temp)</script>";
?>