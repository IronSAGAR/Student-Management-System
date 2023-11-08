<?php
    session_start();
    include "../php/connection.php";

    if (isset($_SESSION['username']) && isset($_SESSION['user_id'])){
        // echo "Admin's panel";
        // echo "<pre>";
        // print_r($_SESSION);
    
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin's Dashboard</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <style>

                body{
                    margin: 10px;
                    background: #bbe4e9;
                }
                .heading{
                    margin-top: 5vh;
                    margin-bottom: 50px;
                    font-size: 3vw;
                    font-family: 'Dancing Script', cursive;
                    color: black;
                    text-shadow: 2px 2px white;
                }

            </style>
        </head>
        <body>
            <div class="container text-center heading" >
                <span>Centralized Student Management System</span>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-4 border border-dark">


                        <!-- admin  info -->
                        <div class="card container text-center mx-auto mt-3" style="width: 20rem; background: #79c2d0;">
                            <img class="card-img-top mt-3" src="../img/admin-img.jpg" alt="Card image cap" style="border-radius: 50%;">
                            <div class="card-body">
                                <h4 class="card-title"> Admin </h4>

                                                        
                                <a href="../logout.php" class="btn btn-primary">logout</a>
                            </div>
                        </div>

                    </div>

                    
                    <div class="col-8 border border-dark">


                        <!-- select options -->
                        <div class="container">
                            <form action = "" method = "post">

                                <div class="mb-3">
                                    <label for="username" class="form-label">Select Table</label>
                                    <select class="form-select" aria-label="Default select example" name = "select_table">
                                        <option selected value="school-table">Schools</option>
                                        <option value="teacher-table">Teachers</option>
                                        <option value="student-table">Students</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>


                        
                        <?php 
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                if(isset($_POST['select_table'])){
                                    if ($_POST['select_table'] == 'school-table'){ ?>

                                        <!-- schools table -->
                                        <div class="container row  m-3">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">School Id</th>
                                                    <th scope="col">School Name</th>
                                                    <th scope="col">Principal</th>
                                                    
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php 
                                                        $query = "SELECT s.* , p.name as principal_name
                                                                FROM schools s 
                                                                JOIN principals p ON s.school_id = p.school_id";

                                                        $result = mysqli_query($link , $query);

                                                        if (mysqli_num_rows($result) > 0){
                                                            while ($row = mysqli_fetch_assoc($result)){ ?>
                                                                <tr>
                                                                    <th scope="row"><?=$row['school_id']?></th>
                                                                    <td><?=$row['name']?></td>
                                                                    <td><?=$row['principal_name']?></td>
                                                                    
                                                                </tr>
                                                                
                                                            <?php }
                                                        }
                                                    
                                                    ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                    <?php }elseif ($_POST['select_table'] == 'teacher-table'){ ?>

                                        <!-- teacher table -->
                                        <div class="container row  m-3">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">teacher Id</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">School Name</th>
                                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        
                                                    <?php 
                                                        $query = "SELECT t.teacher_id , t.name as teacher_name , s.name as school_name 
                                                                FROM teachers t 
                                                                JOIN schools s ON s.school_id = t.school_id";
                                        
                                                        $result = mysqli_query($link , $query);
                                                        if (mysqli_num_rows($result) > 0){
                                                            while ($row = mysqli_fetch_assoc($result)){ ?>
                                                                <tr>
                                                                    <th scope="row"><?=$row['teacher_id']?></th>
                                                                    <td><?=$row['teacher_name']?></td>
                                                                    <td><?=$row['school_name']?></td>
                                                                    
                                                                </tr>
                                                                
                                                            <?php }
                                                        }
                                                    
                                                    ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php }elseif($_POST['select_table'] = 'student-table'){ ?>

                                        <!-- students table -->
                                        <div class="container row  m-3">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">Student Id</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Roll No</th>
                                                    <th scope="col">Standard</th>
                                                    <th scope="col">School</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        
                                                    <?php 
                                                        $query = "SELECT s.student_id, s.name , s.roll_no , c.standard, sch.name as school
                                                                FROM students s
                                                                INNER JOIN classes c ON c.class_id = s.class_id
                                                                INNER JOIN schools sch ON sch.school_id = c.school_id";
                                        
                                                        $result = mysqli_query($link , $query);
                                                        if (mysqli_num_rows($result) > 0){
                                                            while ($row = mysqli_fetch_assoc($result)){ ?>
                                                                <tr>
                                                                    <th scope="row"><?=$row['student_id']?></th>
                                                                    <td><?=$row['name']?></td>
                                                                    <td><?=$row['roll_no']?></td>
                                                                    <td><?=$row['standard']?></td>
                                                                    <td><?=$row['school']?></td>
                                                                </tr>
                                                                
                                                            <?php }
                                                        }
                                                    
                                                    ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php }

                                }
                            }
                        ?>
                    




                    </div>


                </div>
            </div>


        </body>


    <?php }else{
        header("Location: ../index.php");
    }
    

?>
