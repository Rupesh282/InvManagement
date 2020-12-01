<script type="text/javascript">
    function logout() {
        window.location.replace("logout.php");
    }
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
        <h1>Welcome , {$name} !</h1> 
        <button class='btn btn-danger' onclick='logout();'>Log Out</button>
        <hr>
        <a  style='padding-left: 100px' href='show_stock.php'><button style='width: 20%' class='btn btn-success btn-lg'>Show stock</button></a>
        <a style='padding-left: 100px'  href='add_category.php' ><button style='width: 20%' class='btn btn-success btn-lg'>Add category</button></a> 
        <a style='padding-left: 100px' href='add_employee.php'><button style='width: 20%' class='btn btn-success btn-lg'>Add employee</button></a> <br> <br>
        <a style='padding-left: 100px' href='add_dealer.php'><button style='width: 20%' class='btn btn-success btn-lg'>Add Dealer</button></a>
        <a style='padding-left: 100px' href='change_password.php'><button style='width: 20%' class='btn btn-success btn-lg'>Change Password</button></a>
        <a style='padding-left: 100px' href='show_purchase_book.php'><button style='width: 20%' class='btn btn-success btn-lg'>Show purchase book</button></a> <br> <br>
        <a style='padding-left: 100px' href='delete_employee.php'><button style='width: 20%' class='btn btn-success btn-lg'>Remove employee</button></a> 
        <a style='padding-left: 100px' href='manage_tax.php'><button style='width: 20%' class='btn btn-success btn-lg'>Manage tax</button></a> 
        <a style='padding-left: 100px' href='manage_dealers.php'><button style='width: 20%' class='btn btn-success btn-lg'>Manage dealers</button></a> <br> <br>
        <a style='padding-left: 100px' href='dealer_purchase.php'><button style='width: 20%' class='btn btn-success btn-lg'>Purchase from dealers</button></a>
        <a style='padding-left: 100px' href='show_bills.php'><button style='width: 20%' class='btn btn-success btn-lg'>Show Bills</button></a>
        <a style='padding-left: 100px' href='make_bill.php'><button style='width: 20%' class='btn btn-success btn-lg'>Make bill</button></a> <br> <br>
        <a style='padding-left: 100px' href='add_customer.php'><button style='width: 20%' class='btn btn-success btn-lg'>Add Customer</button></a> <br> <br>
"
?>

<h5 style="position: absolute; bottom: 0; right: 0">Owner DashBoard</h5>




