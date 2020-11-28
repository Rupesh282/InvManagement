<script type="text/javascript" src="../function.js"></script>
<?php
    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && ($_SESSION['access'] == 'owner' || $_SESSION['access'] == 'manager')) {
        $sql_qry = "select * from purchase_book";
        $res = $PG_CLIENT->query_select($sql_qry);
        echo $PG_CLIENT->build_table($res);
        echo "<button onclick='redirect_home(0);'>Back</button>";
    } else {
        die("<h3>Login required</h3><a href='../index.php'><button>Go to login page</button></a>");
    }