<?php
    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();
    echo "<style> .ui-helper-hidden-accessible { display:none; } </style>";

    if(isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"] == true and ($_SESSION["access"]=="cashier" || $_SESSION["access"]=="owner" )) {
        $qry = "select * from inventory";
        $items = $PG_CLIENT->query_select($qry);
        $n = 1;
        if(isset($_POST['make_bill'])){
            $n = 1;
            echo "make bill";
            while(isset($_POST['item' + (string)$n])){
                echo $n;
                $n = $n +1;
            }
        }
    } else {
        die("ACCESS DENIED");
    }
?>
<script type="text/javascript">
    var item_count=1;
    
    var select_quantity = "<input placeholder=\"quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\">";
    function add_item(given_items)
    {
        var select = "<input class=\"item"+(item_count+1)+"\" name=\"item"+(item_count+1)+"\" required></input> ";
        var select_quantity = "<input placeholder=\"quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\" required ></input>";
        var t=document.getElementById("bill");
        t.insertRow(item_count+1).insertCell(0).innerHTML=select ;
        t.rows[item_count+1].insertCell(1).innerHTML=select_quantity;
        var p=document.getElementById("num_ele");
        p.value(item_count);
        item_count++;
        autocomplete(given_items,item_count);
    }
</script>
<?="
     <div align='center'>
        MAKE BILL <br><br>
        <form action='make_bill.php' method='POST'> 
            <table id='bill'>
            <tr colspan='2'></tr>
		      <tr>
		     <td><input name='item1'  class='item1' required></input></td>
					     
"
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

     function autocomplete(given_items,num) {
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
         var ele = "item" + num;
         console.log(ele);
        $( "." + ele ).autocomplete({
            source: availableTags,
            select: function(event, ui)
            {
                var id = ui.item.value;
                var name = ui.item.label;
                // var inputF = document.getElementById(ele);
                $("." + ele).val(name);
                // inputF.value = name;
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
<?="<td><input placeholder='quantity' type='text' name='quantity1' required></td>
		</tr>
	</table><input name='num_ele' id='num_ele' readonly>0</input><br>
	"?>
<?php
    $temp = json_encode($items);
    echo "<script> autocomplete($temp,'1')</script>";
	echo "	 <input type='button' value='Add' onclick='add_item($temp)'>"
?>
<?="<input type='submit' name='make_bill'>
        </form>
      </div>     
   "
?>
