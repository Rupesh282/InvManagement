<script type="text/javascript" src="../function.js"></script>

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

if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] and $_SESSION['access']=='owner')
{
    echo " 
    <form action='add_category.php'>
    Category name: <input type='text' name='category_name'> <br><br>
    <input type='submit'>
    </form>
    <button onclick='redirect_home(0)'>Back</button>
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