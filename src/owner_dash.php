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
        <div>
            <button onclick='logout();'>Log Out</button>
        </div>        
   "
?>

