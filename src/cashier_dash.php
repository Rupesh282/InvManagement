<script type="text/javascript">
    function logout() {
        window.location.replace("logout.php");
    }
</script>

<?php

    session_start();

    if($_SESSION["loggedIn"] == true && isset($_SESSION["name"]) && $_SESSION["access"] == "cashier") {
        $name = $_SESSION["name"];
    } else {
        die("ACCESS DENIED");
    }

?>
<?=
"
        <h1>HI , {$name} !</h1> 
        <a href='show_stock.php'><button>Show stock</button></a>
        <a href='change_password.php'><button>Change password</button></a>
        <div>
            <button onclick='logout();'>Log Out</button>
        </div>        
   "
?>

