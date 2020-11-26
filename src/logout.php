<h2>You are logged out successfully !!</h2>
<button onclick="window.location.replace('../index.php')"> Go to login </button>

<?php
    session_start();
    $_SESSION["employee_id"] = null;
    $_SESSION["name"] = null;
    $_SESSION["loggedIn"] = false;
    $_SESSION["access"] = null;
    session_destroy();
