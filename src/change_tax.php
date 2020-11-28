<script type="text/javascript" src="../function.js"></script>
<?php
    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && $_SESSION['access'] == 'owner' ) {
        if(isset($_POST['change_tax'])){
            $taxname = $_POST['tax_name'];
            $taxrate = $_POST['tax_rate'];
            $sql_qry = "update taxes set tax_percent='$taxrate' where tax_name='$taxname'";
            $res = $PG_CLIENT->query_update($sql_qry);
            if($res == 1){
                echo "Updated the tax $taxname to $taxrate";
            }
        }
        $sql_qry = "select * from taxes";
        $res = $PG_CLIENT->query_select($sql_qry);
        echo "<br>Current taxes";
        echo $PG_CLIENT->build_table($res);
    } else {
        die("<h3>Login required</h3><a href='../index.php'><button>Go to login page</button></a>");
    }
    ?>
<?=
"
    <div align='center'>
        Press submit to change the values<br><br>
        <form action='change_tax.php' method='POST'> 
"
?>

<?php
    echo "<select name='tax_name' required>";
    for($i=0; $i<count($res); $i++) {
        $tax = $res[$i]['tax_name'];
        echo "<option value=$tax>$tax</option>";
    }
    echo "</select>";
?>

<?=
"
            <input placeholder='new tax rate' name='tax_rate' required><br><br>
            <input type='submit' name='change_tax'>
        </form><br><br>
        <button onclick='redirect_home(0)'> Back </button>
    </div>
"
?>