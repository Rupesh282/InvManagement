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
            <input type='submit' value='remove' name='delete_employee'>
        </form>
        <button onclick='go_to_owner_dash();'> Back </button>
    </div>
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
