<script type="text/javascript" src="../function.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php
$PG_CLIENT = include "../pgsql_login_details/pg_client.php";
session_start();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && ($_SESSION['access'] == 'owner'
        || $_SESSION['access']=='manager')) {
    if(isset($_POST['change_dealer'])){
//        $taxname = $_POST['tax_name'];
//        $taxrate = $_POST['tax_rate'];
        $dealer_id=$_POST['dealer_id'];
        $dealer_name=$_POST['dealer_name'];
        $dealer_contact_no=$_POST['dealer_contact_no'];
       // $sql_qry = "update taxes set tax_percent='$taxrate' where tax_name='$taxname'";
        $sql_qry="update dealers set dealer_name='$dealer_name', dealer_contact_no='$dealer_contact_no' where dealer_id=$dealer_id";
        $res = $PG_CLIENT->query_update($sql_qry);
        if($res == 1){
            echo "Updated the dealer information of dealer ID $dealer_id";
        }
    }
    $sql_qry = "select * from dealers";
    $res = $PG_CLIENT->query_select($sql_qry);

    echo $PG_CLIENT->build_table($res);
} else {
    die("<h3>Login required</h3><a href='../index.php'><button>Go to login page</button></a>");
}
?>
<?=
"
    <div align='center'>
        <h2>Manage Dealers</h2>
        Press submit to change the values<br><br>
        <form action='manage_dealers.php' method='POST'> 
"
?>

<?php
echo "Dealer Id : ";
echo "<select name='dealer_id' required>";
for($i=0; $i<count($res); $i++) {
    $dealer = $res[$i]['dealer_id'];
    echo "<option value=$dealer>$dealer</option>";
}
echo "</select>";
?>

<?=
"
            <input placeholder='New dealer name' name='dealer_name' required><br><br>
            <input placeholder='Contact no.' name='dealer_contact_no' required><br><br>
            <input type='submit' class='btn btn-primary' name='change_dealer'>
        </form><br><br>
        <button class='btn btn-danger' onclick='redirect_home(0)'> Back </button>
    </div>
    <br>
    <br>Current dealers : <br><br>
"
?>