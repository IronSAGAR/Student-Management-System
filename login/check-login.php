<?php 

    session_start();
    include "connection.php";


    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']) ){
        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = test_input($_POST['username']);
        $password = test_input($_POST['password']);
        $role = test_input($_POST['role']);

        if (empty($username)){
            header("Location: ../index.php?error=Username is required");
        }else if (empty($password)){
            header("Location: ../index.php?error=Password is required");
        }else{
            
            $new_pass = md5($password);

            $query = "SELECT * FROM `users` WHERE username = '$username' AND password = '$new_pass'";
            $result = mysqli_query($link , $query);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                
                if ($row['role'] == $role){
                    // $_SESSION['name'] = $row['name'];
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['username'] = $row['username'];

                    header("Location: check-user.php");
                    
                }else{
                    header("Location: ../index.php?error=You dont have access to this role.");
                }
                
            }
            else{
                header("Location: ../index.php?error=Incorrect username or password");
            }
        }

    }
    else{
        header("Location: ../index.php");
    }


?>