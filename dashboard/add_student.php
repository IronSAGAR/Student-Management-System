<?php
    
    if (isset($_POST["name"]) && isset($_POST["class"])){



        if ($_POST["name"] == ""){
            header("Location: principal.php?error=Please enter name.");
        }
        if ($_POST["class"] == ""){
            header("Location: principal.php?error=Please enter Class.");
        }

        include "../php/connection.php";

        $name = $_POST["name"];
        $class = $_POST["class"];
        $school_id = $_POST["school_id"];

        //get class_id

        $query = "SELECT c.class_id 
        FROM classes c 
        WHERE c.standard = '$class' AND c.school_id = '$school_id'";

        $result = mysqli_query($link , $query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $class_id = $row['class_id'];
        }

        $query = "INSERT INTO students (class_id, school_id, name, roll_no) VALUES ('$class_id' , '$school_id', '$name', 11)";

        $result = mysqli_query($link , $query);

        header("Location: principal.php");
        


        
    }
    else{
        header("Location: principal.php");
    }


?>