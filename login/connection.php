<?php

    $username = "celestial";
    $servename = "localhost";
    $password = "mysqlpass@654";
    $db_name = "db1";

    $link = new mysqli($servename, $username, $password, $db_name);
    if ($link->connect_error) {
        die("Connection failed: ". $link->connect_error);
    }
    

?>