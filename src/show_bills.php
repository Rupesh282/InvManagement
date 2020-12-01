<script type="text/javascript" src="../function.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php
    //queries
    //select * from bill_book order by datetime ASC;
    //select * from bill_book where datetime >= '' and datetime <= '';
    //select * from bill_book where customer_no='';
    //select * from bill_book where bill_id='';
    function endl() {
        echo "<br><br>";
    }
    function printRed() {
        echo "<h5 style='color:#ff0000;'> No bills found ! </h5>";
    }

    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();

    if($_SESSION["loggedIn"] == true && isset($_SESSION["name"]) && $_SESSION["access"] == "owner" || $_SESSION == "cashier") {
        $name = $_SESSION["name"];
    } else {
        die("ACCESS DENIED");
    }
?>

<?=
"
    <center><h2>BILL CHECKING PORTAL</h2></center> <hr>
    <div align='left'>
        <form action='show_bills.php' method='POST'>
            <input type='submit' class='btn btn-primary' name='show_all' value='show All bills'> <br><br>
        </form><hr>
        <form action='show_bills.php' method='POST'>
            <input type='submit' class='btn btn-primary' name='show_on_datetime' value='show on date'> <br><br>
            From : <input type='date' name='from_date' required> 
            To   : <input type='date' name='to_date' value='to_date' id='to_date' required> <br><br>
        </form><hr>
        <form action='show_bills.php' method='POST'>
            <input type='submit' class='btn btn-primary' name='show_on_customer' value='show on customer'> <br><br>
            Customer No. : <input type='text' name='contact_no' required> <br><br>
        </form><hr>
        <form action='show_bills.php' method='POST'>
            <input type='submit' class='btn btn-primary' name='show_on_bill_id' value='show on bill Id'> <br><br>
            Bill Id : <input type='text' name='bill_id' id='bill_id' required>
        </form><hr>
        <button class='btn btn-danger' onclick='redirect_home(0)'>Back</button>
    </div>
"
?>

<?php
    endl();
    echo "<center>";
    if(isset($_POST['show_all'])) {
        echo "Showing all bills : ";
        endl();
        $qry = "select * from bill_book";
        $res = $PG_CLIENT->query_select($qry);
        if(count($res) == 0) {
            printRed();
        } else {
            echo $PG_CLIENT->build_table($res);
        }
    } else if(isset($_POST['show_on_datetime'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        echo "Bills from $from_date to $to_date";
        endl();
        $qry = "select * from bill_book where datetime >= '$from_date' and datetime <= '$to_date'";
        $res = $PG_CLIENT->query_select($qry);
        if(count($res) == 0) {
            printRed();
        } else {
        echo $PG_CLIENT->build_table($res);
        }
    } else if(isset($_POST['show_on_customer'])) {
        $contact_no = $_POST['contact_no'];
        echo "Bills of Customer with contact No. : ".$contact_no;
        endl();
        $qry = "select * from bill_book where contact_no='$contact_no'";
        $res = $PG_CLIENT->query_select($qry);
        if(count($res) == 0) {
            printRed();
        } else {
            echo $PG_CLIENT->build_table($res);
        }
    } else if(isset($_POST['show_on_bill_id'])) {
        $bill_id = $_POST['bill_id'];
        echo "Bills for Bill Id : $bill_id";
        endl();
        $qry = "select * from bill_book where bill_id='$bill_id'";
        $res = $PG_CLIENT->query_select($qry);
        if(count($res) == 0) {
           printRed();
        } else {
            echo $PG_CLIENT->build_table($res);
        }
    }
    echo "</center>";
?>
<script>
    document.getElementById("to_date").value = new Date().toISOString().slice(0,10);
</script>