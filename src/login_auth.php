<?php
    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    $e_username = $_POST["username"];
    $e_password = $_POST["password"];
    $e_access_type = $_POST["access_type"];

    //start the session for tracking login access
    session_start();

    if(isset($_POST["submit"])) {
        $sql_qry = "select * from employee where employee_id=$e_username and employee_password='$e_password' and access_type='$e_access_type'";
        $sql_qry=htmlspecialchars($sql_qry);
        $res = $PG_CLIENT->query_select($sql_qry);
        if(count($res) == 1) {
            // set session variables
            $_SESSION["employee_id"] = $e_username;
            $_SESSION["name"] = $res[0]["first_name"];
            $_SESSION["loggedIn"] = true;
            $_SESSION["access"] = $e_access_type;

            $location = $e_access_type."_dash.php";
            echo $location;
            header("Location: ".$location);
        } else {
            //user is not valid, redirect him to login page
            header("Location: ../index.php");
        }
    } else {
        die("ACCESS DENIED");
    }