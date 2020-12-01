<script type="text/javascript" src="../function.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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
        var select_quantity = "<input placeholder=\"Quantity\" type=\"text\" name=\"quantity"+(item_count+1)+"\">";
        var t=document.getElementById("bill");
        t.insertRow(item_count+1).insertCell(0).innerHTML=select + options + endselect;
        t.rows[item_count+1].insertCell(1).innerHTML=select_quantity;
        t.rows[item_count+1].insertCell(2).innerHTML=`<input placeholder="Buying price" type="text" name="buying_price` + (item_count+1) +`">`;
        t.rows[item_count+1].insertCell(3).innerHTML=`<input placeholder="Selling price" type="text" name="selling_price` + (item_count+1) +`">`;
        item_count++;
    }
</script>
<?="
     <div align='center'>
        PURCHASE ITEMS <br><br>
        <form action='make_bill.php' method='POST'> 
            <table id='bill'>
            <tr colspan='4'></tr>
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
			<td><input placeholder='Quantity' type='text' name='quantity1'></td>
		
		<td><input placeholder='Buying Price' type='text' name='buying_price1'></td>
<td><input placeholder='Selling Price' type='text' name='selling_price1'> </td></tr>
	</table><br>
	"?>
<?php
$temp = json_encode($items);
echo "	 <input type='button' class='btn btn-warning' value='Add' onclick='add_item($temp)'>"
?>
<?="
    <input type='submit' class='btn btn-primary' name='make_bill'>
        </form>
        <button class='btn btn-danger' onclick='redirect_home(0)'> Back </button>
      </div>     
      
   "
?>
