<script type="text/javascript" src="../function.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();

    if($_SESSION['loggedIn']) {
        echo "<div align='center'>";
        echo "<br><br>All Stocks : ";
        $sql_qry = "select * from inventory";
        $res = $PG_CLIENT->query_select($sql_qry);
        echo $PG_CLIENT->build_table($res);
        echo "</div>";
    } else {
        die("<h3>Login required</h3><a href='../index.php'><button>Go to login page</button></a>");
    }
?>

<br><br>
<button onclick='redirect_home(0)' class="btn btn-dark">Back</button>
<br><br>
