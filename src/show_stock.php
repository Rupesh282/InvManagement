<?php
$PG_CLIENT = include "../pgsql_login_details/pg_client.php";
session_start();

if($_SESSION['loggedIn']) {
    $sql_qry = "select * from inventory";
    $res = $PG_CLIENT->query_select($sql_qry);
    echo $PG_CLIENT->build_table($res);
} else {
    die("<h3>Login required</h3><a href='../index.php'><button>Go to login page</button></a>");
}