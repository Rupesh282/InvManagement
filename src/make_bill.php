<?php
    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();

    if(isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"] == true) {
        $qry = "select * from inventory";
        $items = $PG_CLIENT->query_select($qry);
//        foreach ($items as $item){
//            echo $item['item_id'];
//            echo "<br>";
//        }
    } else {
        die("ACCESS DENIED");
    }
?>
<script type="text/javascript">
    var item_count=1;
    
    var select_quantity = "<input placeholder=\"quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\">";
    function add_item(given_items)
    {
        console.log(given_items[0]);
        var select = "<select name=\"item"+(item_count+1)+"\">";
        var endselect = "</select>";
        // var option = "<option>op1</option><option>op2</option>";
        var options = "";
        for (i = 0; i < given_items.length; i++) {
            id = given_items[i]['item_id'];
            name = given_items[i]['item_name'];
            options = options + "<option value='" + id + "'>" + name + "</option>";
            console.log(id);
        }
        var select_quantity = "<input placeholder=\"quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\">";
        var t=document.getElementById("bill");
        t.insertRow(item_count+1).insertCell(0).innerHTML=select + options + endselect;
        t.rows[item_count+1].insertCell(1).innerHTML=select_quantity;
        item_count++;
    }
</script>
<?="
     <div align='center'>
        MAKE BILL <br><br>
        <form action='make_bill.php' method='POST'> 
            <table id='bill'>
            <tr colspan='2'></tr>
		      <tr>
		     <td><select name='item1' >		     
"
?>
<?php
        foreach ($items as $item){
            $id = $item['item_id'];
            $name = $item['item_name'];
            echo "<option value=$id>$name</option>";
        }
?>
<?="</select></td>
			<td><input placeholder='quantity' type='text' name='quantity1'></td>
		</tr>
	</table><br>
	"?>
<?php
    $temp = json_encode($items);
	echo "	 <input type='button' value='Add' onclick='add_item($temp)'>"
?>
<?="<input type='submit' name='make_bill'>
        </form>
      </div>     
   "
?>
