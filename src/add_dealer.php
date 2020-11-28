<script type="text/javascript" src="../function.js"></script>

<?php
$PG_CLIENT = include "../pgsql_login_details/pg_client.php";
session_start();

if(isset($_GET['dealer_name']) and isset($_GET['dealer_contact_no']))
{
    $dealer_name=$_GET['dealer_name'];
    $dealer_contact_name=$_GET['dealer_contact_no'];
    $sql_qry = "insert into dealers(dealer_name,dealer_contact_no) values('$dealer_name','$dealer_contact_name')";
    //echo $sql_qry;
    $PG_CLIENT->query_update($sql_qry);
    echo "<script> redirect_home(2); </script>";
    die("<h1>Dealer successfully added</h1>");

}

if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] and $_SESSION['access']=='owner')
{

}
else if(!($_SESSION['loggedIn']))
{
    die("<h3>Login required</h3><a href='../index.php'><button>Go to login page</button></a>");
}
else
{
    die("ACCESS DENIED");
}
?>
<?=
"
    <form action='add_dealer.php'>
    Dealer Name : <input type='text' name='dealer_name'> <br><br>
    Contact No : <input type='text' name='dealer_contact_no'> <br><br>
    <input type='submit'>
    </form>
    <button onclick='redirect_home(0)'>Back</button>    
"
?>