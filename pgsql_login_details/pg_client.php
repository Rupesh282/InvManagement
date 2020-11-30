<?php
    $data_base_config = include "login_details.php";

function die_print($message, $file_name) {
    die("inside file : $file_name <br><br>  [ $message ] <br><br>");
}

class pg_client {
    private $pg_username;
    private $pg_password;
    private $pg_hostname;
    private $pg_dbname;
    private $pg_connection;

    function __construct($pg_username, $pg_password, $pg_hostname, $pg_dbname) {
        $this->pg_username = $pg_username;
        $this->pg_password = $pg_password;
        $this->pg_hostname = $pg_hostname;
        $this->pg_dbname = $pg_dbname;
        $this->pg_connection = pg_connect("host=$pg_hostname dbname=$pg_dbname user=$pg_username password=$pg_password");
    }

    function get_pg_connection() {
        return $this->pg_connection;
    }

    function query_select($sql_qry) {
        $result = pg_query($this->pg_connection, $sql_qry);
        if($result == false) {
            die_print(pg_last_error(), "pg_client.php");
        }
        $qry_set = array();
        $row_cnt = 0;
        while($row = pg_fetch_assoc($result)) {
            $qry_set[$row_cnt] = $row;
            $row_cnt++;
        }
        return $qry_set;
    }

    function query_update($sql_qry) {
        $result = pg_query($this->pg_connection, $sql_qry);
        if($result == false) {
            die_print(pg_last_error(), "pg_client.php");
        }
        return pg_affected_rows($result);
    }

    function build_table($array) {
        $html = '<table border="1px solid black" style="border-collapse: collapse;">';
        $html .= '<tr>';
        if(count($array) != 0) {
            foreach ($array[0] as $key => $value) {
                $html .= '<th>' . htmlspecialchars($key) . '</th>';
            }
            $html .= '</tr>';
            foreach ($array as $key => $value) {
                $html .= '<tr>';
                foreach ($value as $key2 => $value2) {
                    $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                }
                $html .= '</tr>';
            }
        }
        return $html;
    }
}

$pg_username = $data_base_config["pg_username"];
$pg_password = $data_base_config["pg_password"];
$pg_hostname = $data_base_config["pg_hostname"];
$pg_dbname = $data_base_config["pg_dbname"];

// create a pg_client instance to include it wherever needed
$PG_CLIENT = new pg_client($pg_username, $pg_password, $pg_hostname, $pg_dbname);

if(!$PG_CLIENT->get_pg_connection()) {
    die_print("Error while connecting to database : $pg_dbname", "pg_client.php");
}

return $PG_CLIENT;