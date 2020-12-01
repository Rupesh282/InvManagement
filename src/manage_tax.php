<script type="text/javascript" src="../function.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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
        if(isset($_POST['add_new_tax'])){
            $newtaxname = $_POST['new_tax_name'];
            $newtaxrate = $_POST['new_tax_rate'];
            $sql_qry = "insert into taxes (tax_name,tax_percent) values ('$newtaxname','$newtaxrate')";
            $res = $PG_CLIENT->query_update($sql_qry);
            if($res == 1){
                echo "Added the tax $newtaxname";
            } else if($res == 0){
                echo "Tax with the name $newtaxname already exists";
            } else {
                echo "error while adding tax";
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
        <h2>Manage Taxes</h2>
        Press submit to change the values<br><br>
        <form action='manage_tax.php' method='POST'> 
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
            <input type='submit' class='btn btn-primary' name='change_tax'>
        </form><br><br>
        
    </div>
"
?>
<?= "
    <br><br><br>
    <div align='center'>
        Enter new tax : <br><br>
        <form action='manage_tax.php' method='POST'>
        <input placeholder='Enter tax name' name='new_tax_name' required><br><br>
        <input placeholder='Enter tax rate' name='new_tax_rate' required><br><br>
        <input type='submit' class='btn btn-primary' name='add_new_tax'>
        </form><br><br>
     <button class='btn btn-danger' onclick='redirect_home(0)'> Back </button>
     <div>
"
?>
