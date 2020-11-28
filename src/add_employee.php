<script type="text/javascript">
    function go_to_owner_dash() {
        window.location.replace("../index.php");
    }
</script>

<?php
    function endl() {
        echo "<br><br>";
    }

    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();

    if($_SESSION["loggedIn"] == true && isset($_SESSION["name"]) && $_SESSION["access"] == "owner") {
        $name = $_SESSION["name"];
        $accesses = $PG_CLIENT->query_select("select * from accesses");
    } else {
        die("ACCESS DENIED");
    }
?>

<?=
"
    <div align='center'>
         Add Employee <br><br>
        <form action='add_employee.php' method='post'>
            <input type='text' name='first_name' placeholder='first name' required> <br><br>
            <input type='text' name='last_name' placeholder='last name'> <br><br>
            <input type='text' name='contact_no' placeholder='contact No.'> <br><br>  
"
?>

<?php
    echo "<select name='access_type' required>";
    for($i=0; $i<count($accesses); $i++) {
        $access = $accesses[$i]['access_type'];
        echo "<option value=$access>$access</option>";
    }
    echo "</select>";
?>

<?=
"
            <input type='submit' name='add_employee'>
        </form>
        <button onclick='go_to_owner_dash();'> Back </button>
    </div>
"
?>

<?php
    // after we submit the form
    if(isset($_POST['add_employee'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_no = $_POST['contact_no'];
        $access = $_POST['access_type'];

        //for a employee with same contact no.
        $qry = "select * from employee where contact_no='$contact_no'";
        $res = $PG_CLIENT->query_select($qry);
        if(count($res) > 0) {
            echo "A Employee with same contact No. Exists in database !"; endl();
            echo "employee ID : ".$res[0]['employee_id']; endl();
            echo "first name : ".$res[0]['first_name']  ; endl();
            echo "contact No.: ".$res[0]['contact_no']; endl();
            echo "access type : ".$res[0]['access_type']; endl();
            die("");
        }
        $qry = "insert into employee(employee_password, first_name, last_name, contact_no, access_type) values('password', '$first_name', '$last_name', '$contact_no', '$access');";
        $upd = $PG_CLIENT->query_update($qry);
        if($upd > 0) {
            echo "Employee added successfully !";
            $EMP_details = $PG_CLIENT->query_select("
                        select * from employee order by employee_id DESC LIMIT 1
                    ");
            endl();
            echo "Employee Details : "; endl();
            echo "first name : ".$EMP_details[0]['first_name']  ; endl();
            echo "last name :  ".$EMP_details[0]['last_name'];  endl();
            echo "contact No.: ".$EMP_details[0]['contact_no']; endl();
            echo "Access type: ".$EMP_details[0]['access_type']; endl();
            echo "password : ".$EMP_details[0]['employee_password']; endl();
            echo "employee ID : ".$EMP_details[0]['employee_id']; endl();
        } else {
            echo "Error while adding employee :".$first_name;
            die("");
        }
    }
?>
