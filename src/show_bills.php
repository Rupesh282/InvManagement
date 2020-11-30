<script type="text/javascript" src="../function.js"></script>
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
    <center><h2>BILL CHECKING PORTAL</h2></center>
    <div align='left'>
        <form action='show_bills.php' method='POST'>
            <input type='submit' name='show_all' value='show All bills'> <br><br>
        </form>
        <form action='show_bills.php' method='POST'>
            <input type='submit' name='show_on_datetime' value='show on date'> <br><br>
            From : <input type='date' name='from_date' required> 
            To   : <input type='date' name='to_date' value='to_date' id='to_date' required> <br><br>
        </form>
        <form action='show_bills.php' method='POST'>
            <input type='submit' name='show_on_customer' value='show on customer'> <br><br>
            Customer No. : <input type='text' name='contact_no' required> <br><br>
        </form>
        <form action='show_bills.php' method='POST'>
            <input type='submit' name='show_on_bill_id' value='show on bill Id'> <br><br>
            Bill Id : <input type='text' name='bill_id' id='bill_id' required>
        </form>
        <button onclick='redirect_home(0)'>Back</button>
    </div>
"
?>

<?php
    endl();
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
?>

<script>
    document.getElementById("to_date").value = new Date().toISOString().slice(0,10);
</script>