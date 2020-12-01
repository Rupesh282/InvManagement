<script type="text/javascript">
    function go_to_owner_dash() {
        window.location.replace("../index.php");
    }
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php
    function endl() {
        echo "<br><br>";
    }

    $PG_CLIENT = include "../pgsql_login_details/pg_client.php";
    session_start();

    if($_SESSION["loggedIn"] == true && isset($_SESSION["name"]) && $_SESSION["access"] == "owner") {
        //show all employees
        // give dropdown to delete
        $qry = "select * from employee";
        $employees = $PG_CLIENT->query_select($qry);
        echo "<div align='center'>";
        echo $PG_CLIENT->build_table($employees);
        echo "</div>";
    } else {
        die("ACCESS DENIED");
    }
?>

<?=
"
    <h2 align='center'>Remove Employees</h2>
    <div align='left'>
         select Id of  Employee for removing it: <br><br>
        <form action='delete_employee.php' method='post'>
"
?>

<?php
    echo "<select name='employee_id' required>";
    for($i=0; $i<count($employees); $i++) {
        $employee_id = $employees[$i]['employee_id'];
        $employee_name = $employees[$i]['first_name'];
        $access = $employees[$i]['access_type'];
        echo "<option value=$employee_id>$employee_id , name : $employee_name, access : $access</option>";
    }
    echo "</select>";
?>

<?=
"
            <input type='submit' value='remove'  class='btn btn-primary' name='delete_employee'>
        </form>
        <button class='btn btn-danger' onclick='go_to_owner_dash();'> Back </button>
    </div><br>
    All Employees : 
"
?>

<?php
    if(isset($_POST['delete_employee'])) {
        // write query for deleting employee
        $employee_id = $_POST['employee_id'];
        $qry = "delete from employee where employee_id=$employee_id";
        $upd = $PG_CLIENT->query_update($qry);
        if($upd > 0) {
            echo "Employee with employee ID : [ $employee_id ] removed successfully !";
            //refresh the page
            header("Location: delete_employee.php");
        } else {
            echo "No one was ejected !";
        }
    }
?>
