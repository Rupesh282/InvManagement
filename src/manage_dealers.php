<script type="text/javascript" src="../function.js"></script>
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
    echo "<br>Current dealers";
    echo $PG_CLIENT->build_table($res);
} else {
    die("<h3>Login required</h3><a href='../index.php'><button>Go to login page</button></a>");
}
?>
<?=
"
    <div align='center'>
        Press submit to change the values<br><br>
        <form action='manage_dealers.php' method='POST'> 
"
?>

<?php
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
            <input type='submit' name='change_dealer'>
        </form><br><br>
        <button onclick='redirect_home(0)'> Back </button>
    </div>
"
?>