<script type="text/javascript">
    function owner() {
        window.location.replace("src/owner_dash.php");
    }
    function manager() {
        window.location.replace("src/manager_dash.php");
    }
    function cashier() {
        window.location.replace("src/cashier_dash.php");
    }
</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<?php
    session_start();
    if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] )
    {
        if($_SESSION['access']=='owner') {
            echo "<script>owner();</script>";
        }
        elseif($_SESSION['access']=='manager') {
            echo "<script>manager();</script>";
        }
        elseif($_SESSION['access']=='cashier') {
            echo "<script>cashier();</script>";
        }
        else{
            echo "internal error occcured!!";
        }
    }

?>


<div align="center" class="form-group">
    <h31>Login Window</h31> <br><br>
    <form action="src/login_auth.php" method="post">
        <input type="text" name="username" placeholder="username" required> <br><br>
        <input type="password" name="password" placeholder="password" required> <br><br>
            <select name="access_type" required>
            <option value="owner">Owner</option>
            <option value="cashier">Cashier</option>
            <option value="manager">Manager</option>
        </select>
        <button type="submit" name="submit" class="btn btn-primary">Log in</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php

//    $PG_CLIENT = include "pgsql_login_details/pg_client.php";
//    $data = $PG_CLIENT->query_select("select * from employee");
//    var_dump($data);
//    echo "<h1> rupesh </h1>";
?>