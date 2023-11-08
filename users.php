<?php

    $user = array("admin1" , "principle1"  ,"principle2" , "teacher1" , "teacher2" , "teacher3" , "teacher4" , "teacher5" , "teacher6");

    foreach ($user as $u){
        echo "<p>" . $u . "- " . md5($u) ."</p>";
    }


?>