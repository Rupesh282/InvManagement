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
            // change: function (event, ui) {
            //     // if(!ui.item){
            //     //     //http://api.jqueryui.com/autocomplete/#event-change -
            //     //     // The item selected from the menu, if any. Otherwise the property is null
            //     //     //so clear the item for force selection
            //     //     $("." + ele).val("");
            //     // }
            //
            // }
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
    var item_count=1;
    console.log("yeah123123");
    // var select_quantity = "<input placeholder=\"quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\">";
    function add_item(){
        console.log("yeah");
//        var select = `<input class=\"item"+(item_count+1)+"\" name=\"item"+(item_count+1)+"\" required></input> `;
//        var select_quantity = `<input placeholder=\"quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\" required ></input>`;
//        var select ="test";
//        var select_quantity ="test1";
//        var t=document.getElementById("bill");
//        t.insertRow(item_count+1).insertCell(0).innerHTML=select ;
//        t.rows[item_count+1].insertCell(1).innerHTML=select_quantity;
//        var p=document.getElementById("num_ele");
//        p.value = item_count;
//        item_count++;
    }
</script>
<?php
    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();
    echo "<style> .ui-helper-hidden-accessible { display:none; } </style>";

    if(isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"] == true and ($_SESSION["access"]=="cashier" || $_SESSION["access"]=="owner" )) {
        $qry = "select * from inventory";
        $items = $PG_CLIENT->query_select($qry);
//        if(isset($_POST['add_item'])){
//            echo "Iam here";
//            $id = $_POST['item_id'];
//        }
        if(isset($_POST['make_bill'])){
            $n = $_POST['num_ele'] + 1;
            echo $n;
            for ($i =1 ;$i<=$n;$i++){
                $id = "item".strval($i);
                echo $id;
                $id = $_POST[$id];
                echo $id;
            }
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
        <form action='make_bill.php' method='POST'>
            <input name='item_id' id='item_id' class='item_id' hidden></input>
            <input name='item' id='item' class='item' placeholder='Enter item name' required></input>
            <input name='quantity' id='quantity' placeholder='Enter quantity'required></input>
            <br><br>
            <button name='add_item' onclick=add_item()>Add</button>
            <input type='submit' name='make_bill'></input>
         
         
            <table id='bill'>
            <tr colspan='2'></tr>
";?>
<?php
echo "<tr>        
            <td>
		      <input class='item1' name='item1' readonly></input>
            </td>
		    <td >
		        <input class='quantity1' name='quantity1' readonly></input>
		    </td>
		    </tr>
		     </table>
		 </form></div> ";
?>

<?php
    $temp = json_encode($items);
    echo "<script> autocomplete($temp)</script>";
?>