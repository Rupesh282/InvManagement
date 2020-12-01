<script type="text/javascript" src="../function.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php

    session_start();

    if($_SESSION["loggedIn"] == true and isset($_SESSION["employee_id"])) {
        $id = $_SESSION["employee_id"];
        if(isset($_POST['submit'])){
            if(isset($_POST['password']) and isset($_POST['recheck'])) {
                $password = $_POST['password'];
                $recheck = $_POST['recheck'];
                if($password === $recheck and $password!=""){
                    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
                    $sql_qry = "update employee  set employee_password='$password' where employee_id = $id";
                    //echo $sql_qry;
                    $test = $PG_CLIENT->query_update($sql_qry);
                    if($test == 1){
                        echo "<script>redirect_home(2)</script>";
                        die("password update succesfully!");
                    } else {
                        echo "Error ! could not change password";
                    }
                } else{
                    echo "password doesn't match";
                }
            } else{
                echo "enter password!";
            }
        }
    } else {
        die("ACCESS DENIED");
    }

?>
<br><br>
<div align="center">
    <form action="change_password.php" method="POST">
        <input name="password" type="password" placeholder="enter new password" required><br><br>
        <input name="recheck" type="password" placeholder="re-enter password" required><br><br>
        <input type="submit" name="submit" value="change" class="btn btn-primary">
    </form>
    <button class="btn btn-danger" onclick="redirect_home(0)">Back</button>
</div>
