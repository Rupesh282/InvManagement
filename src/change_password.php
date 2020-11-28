<script type="text/javascript" src="../function.js"></script>
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

<div align="center">
    <form action="change_password.php" method="POST">
        <input name="password" type="password" placeholder="enter new password" required><br><br>
        <input name="recheck" type="password" placeholder="re-enter password" required><br><br>
        <input type="submit" name="submit">
    </form>
    <button onclick="redirect_home(0)">Back</button>
</div>
