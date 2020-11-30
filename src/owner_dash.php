<script type="text/javascript">
    function logout() {
        window.location.replace("logout.php");
    }
</script>

<?php

    session_start();

    if($_SESSION["loggedIn"] == true && isset($_SESSION["name"]) && $_SESSION["access"] == "owner") {
        $name = $_SESSION["name"];
    } else {
        die("ACCESS DENIED");
    }

?>
<?=
"
        <h1>HI , {$name} !</h1> 
        <a href='show_stock.php'><button>Show stock</button></a>
        <a href='add_category.php'><button>Add category</button></a>
        <a href='add_employee.php'><button>Add employee</button></a>
        <a href='add_dealer.php'><button>Add Dealer</button></a>
        <a href='change_password.php'><button>Change Password</button></a>
        <a href='show_purchase_book.php'><button>Show purchase book</button></a>
        <a href='delete_employee.php'><button>Remove employee</button></a>
        <a href='manage_tax.php'><button>Manage tax</button></a>
        <a href='manage_dealers.php'><button>Manage dealers</button></a>
        <div>
            <button onclick='logout();'>Log Out</button>
        </div>        
"
?>

