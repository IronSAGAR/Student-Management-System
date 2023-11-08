<?php
    session_start();
    include "connection.php";
   
    if (isset($_SESSION['username']) && isset($_SESSION['user_id'])){
        //check users
        $user_id = $_SESSION['user_id'];

        if($_SESSION['role'] == 'teacher'){ 
          
            //get teacher info
    
            $query = "SELECT * from `teachers` WHERE user_id = '$user_id'";
            $result = mysqli_query($link, $query);
    
            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
            }
            $_SESSION['teacher_id'] = $row['teacher_id'];
            $_SESSION['school_id'] = $row['school_id'];
            $_SESSION['name'] = $row['name'];
    

            header("Location: ../dashboard/teacher.php");

        }else if($_SESSION['role'] == 'principal'){
            //get principal info
            $query = "SELECT * FROM `principals` WHERE user_id = '$user_id'";
            $result = mysqli_query($link, $query);
    
            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
            }
            $_SESSION['principal_id'] = $row['principal_id'];
            $_SESSION['school_id'] = $row['school_id'];
            $_SESSION['name'] = $row['name'];


            header("Location: ../dashboard/principal.php");



        }else{
            //get admin info
            header("Location: ../dashboard/admin.php");
            
        }


    }else{
        header("Location: index.php");
    }

?>
