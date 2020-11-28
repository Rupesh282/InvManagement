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


<div align="center">
    <h31>Login Window</h31> <br><br>
    <form action="src/login_auth.php" method="post">
        <input type="text" name="username" placeholder="username" required> <br><br>
        <input type="password" name="password" placeholder="password" required> <br><br>
        <select name="access_type" required>
            <option value="owner">Owner</option>
            <option value="cashier">Cashier</option>
            <option value="manager">Manager</option>
        </select>
        <input type="submit" name="submit"> <br><br>
    </form>
</div>


<?php

//    $PG_CLIENT = include "pgsql_login_details/pg_client.php";
//    $data = $PG_CLIENT->query_select("select * from employee");
//    var_dump($data);
//    echo "<h1> rupesh </h1>";
?>