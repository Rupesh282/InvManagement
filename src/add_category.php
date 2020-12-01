<script type="text/javascript" src="../function.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php

$PG_CLIENT = include "../pgsql_login_details/pg_client.php";
session_start();

if(isset($_GET['category_name']))
{
    $category_name=$_GET['category_name'];
    // check if category already exists
    $qry = "select * from category where category_name='$category_name'";
    $res = $PG_CLIENT->query_select($qry);
    if(count($res) > 0) {
        echo "Category with this name already exists !";
    } else {
        $sql_qry = "insert into category(category_name) values('$category_name')";
        $PG_CLIENT->query_update($sql_qry);
        echo '<script>redirect_home(2);</script>';
        die("<h1>Category added successfully</h1>");
    }

}

if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] and ($_SESSION['access']=='owner' || $_SESSION['access']=='manager'))
{
    echo " <br>
    <div align='center'>
        Add Category:<br>
        <form action='add_category.php'>
            Category name: <input type='text' name='category_name'> <br><br>
            <button type='submit' class='btn btn-primary'>Submit</button>
        </form>
        <button class='btn btn-danger' onclick='redirect_home(0)'>Back</button>
    </div>    
    ";
}
else if(!($_SESSION['loggedIn']))
{
    die("<h3>Login required</h3><a href='../index.php'><button>Go to login page</button></a>");
}
else
{
    die("ACCESS DENIED");
}