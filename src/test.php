<?php

    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    $sql = "select * from accesses";
    echo $PG_CLIENT->build_table($PG_CLIENT->query_select($sql));

