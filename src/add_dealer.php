<script type="text/javascript" src="../function.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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
    <br><br>
    <div align='center'>
        <form action='add_dealer.php'>
            Dealer Name : <input type='text' name= 'dealer_name'> <br><br>
            Contact No : <input type='text' name='dealer_contact_no'> <br><br>
            <input type='submit' class='btn btn-primary' value='add'>
        </form>
        <button class='btn btn-danger' onclick='redirect_home(0)'>Back</button>    
    </div>
"
?>