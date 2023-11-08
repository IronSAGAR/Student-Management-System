<?php
    session_start();
    include "../php/connection.php";

    if (isset($_SESSION['username']) && isset($_SESSION['user_id'])){
       

        $user_id = $_SESSION['user_id'];
        $principal_id = $_SESSION['principal_id'];
        $school_id = $_SESSION['school_id'];

        ?>
    
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Principal's Dashboard</title>
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

                    <div class = "container">
                        <div class="row">
                            <div class="col-4 border border-dark">


                                <!-- principal's info -->
                                <div class="card container text-center mx-auto mt-3" style="width: 20rem; background: #79c2d0; ">
                                    <img class="card-img-top mt-3" src="../img/principal-img.jpg" alt="Card image cap" style="border-radius: 50%;">
                                    <div class="card-body">
                                        <h4 class="card-title"> <?=$_SESSION['name'] ?> </h4>

                                        <?php 
                                            $query = "SELECT s.name
                                                    FROM principals p 
                                                    INNER JOIN schools s ON p.school_id = s.school_id
                                                    WHERE p.principal_id = '$principal_id' LIMIT 1";
                                            $result = mysqli_query($link , $query);
                                            if (mysqli_num_rows($result) > 0){
                                                $row = mysqli_fetch_assoc($result);
                                                ?> 
                                                
                                                <h6 class="card-subtitle mb-2 text-muted"><?=$row['name']?> </h6>
                                                
                                            <?php }
                                        ?>



                                        
                                        
                                        <a href="../logout.php" class="btn btn-success">logout</a>
                                    </div>
                                </div>


                                <div class="cotainer  mx-auto mt-3">
                                    <button class="btn btn-primary my-2 my-sm-0" onclick="toggleForm()"> Add student</button>
                                    
                                    <div class="container">

                                        <form action="add_student.php" method= "post" id="myForm" style="display: none;" >
                                                
                                            <div class="mb-3">

                                                <label for="name" class="form-label"> Name</label>
                                                <input type="text" id="name" name="name" class="form-control">
                                            </div>

                                            <div class="mb-3">

                                                <label for="class" class="form-label">Class</label>
                                                
                                                <select class="form-select" aria-label="Default select example" name = "class">
                                                    <option selected value="Fifth">Fifth</option>
                                                    <option value="Sixth">Sixth</option>
                                                    <option value="Seventh">Seventh</option>
                                                </select>
                                            </div>

                                            <input type="hidden" name="school_id" value = "<?=$school_id?>">
                                            
                                            <input type="submit" value= "submit" class= "btn btn-primary">
                                        </form>
                                    </div>
                                </div>

                            </div>
                            
                            <!-- teacher panel -->

                            <div class="col-8 border border-dark">

                                <!-- search function -->
                                <div class="container row  m-3">

                                    <form class="form-inline my-2 my-lg-0 col" action = "" method = "post">
                                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name = "search_query">
                                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                    </form>

                                    <?php 
                                        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                            if (isset($_POST['search_query'])){
                                                function test_input($data){
                                                    $data = trim($data);
                                                    $data = stripslashes($data);
                                                    $data = htmlspecialchars($data);
                                                    return $data;
                                                }
                                                $search_query = test_input($_POST['search_query']);
                                                
                                                if($search_query != ""){

                                                
                                                    $query = "SELECT s.student_id, s.name , s.roll_no , c.standard 
                                                            FROM students s 
                                                            INNER JOIN classes c on c.class_id = s.class_id
                                                            WHERE c.school_id = '$school_id' AND s.name LIKE '%$search_query%'";
                                                    
                                                    $result = mysqli_query($link , $query);
                                                    if (mysqli_num_rows($result) > 0){ ?>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">Student Id</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Roll No</th>
                                                                <th scope="col">Standard</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php while ($row = mysqli_fetch_assoc($result)){ ?>
                                                                    <tr>
                                                                    <th scope="row"><?=$row['student_id']?></th>
                                                                    <td><?=$row['name']?></td>
                                                                    <td><?=$row['roll_no']?></td>
                                                                    <td><?=$row['standard']?></td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>

                                                    <?php }else{ ?>
                                                    <div class="mb-3 col alert alert-danger">
                                                        <span>No results found.</span>
                                                    </div>
                                                <?php }
                                                }else{ ?>
                                                    <div class="mb-3 col alert alert-danger">
                                                        <span>Enter Name</span>
                                                    </div>
                                                <?php }


                                            }
                                        }
                                    
                                    ?>


                                </div>
                                
    
                                <!-- teacher's table -->
                                <div class="container row  m-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">teacher Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Total students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
            
                                            <?php 
                                                $query = "SELECT t.teacher_id, t.name, c.standard, COUNT(s.student_id) AS total_students
                                                        FROM teachers t
                                                        JOIN classes c ON t.teacher_id = c.teacher_id
                                                        JOIN students s ON c.class_id = s.class_id
                                                        WHERE t.school_id = '$school_id'
                                                        GROUP BY t.teacher_id;";

                                                $result = mysqli_query($link , $query);
                                                if (mysqli_num_rows($result) > 0){
                                                    while ($row = mysqli_fetch_assoc($result)){ ?>
                                                        <tr>
                                                            <th scope="row"><?=$row['teacher_id']?></th>
                                                            <td><?=$row['name']?></td>
                                                            <td><?=$row['standard']?></td>
                                                            <td><?=$row['total_students']?></td>
                                                        </tr>
                                                        
                                                    <?php }
                                                }
                                            
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <!-- students table -->
                                <div class="container row  m-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">Student Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Roll No</th>
                                            <th scope="col">Standard</th>
                                            </tr>
                                        </thead>
                                        <tbody>
            
                                            <?php 
                                                $query = "SELECT s.student_id, s.name , s.roll_no , c.standard
                                                            FROM students s
                                                            INNER JOIN classes c ON c.class_id = s.class_id
                                                            WHERE c.school_id = '$school_id'";

                                                $result = mysqli_query($link , $query);
                                                if (mysqli_num_rows($result) > 0){
                                                    while ($row = mysqli_fetch_assoc($result)){ ?>
                                                        <tr>
                                                            <th scope="row"><?=$row['student_id']?></th>
                                                            <td><?=$row['name']?></td>
                                                            <td><?=$row['roll_no']?></td>
                                                            <td><?=$row['standard']?></td>
                                                        </tr>
                                                        
                                                    <?php }
                                                }
                                            
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                    </div>

                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


                    <script>
                        function toggleForm(){
                            var form = document.getElementById("myForm");
                            if (form.style.display === "none") {
                                form.style.display = "block";
                            } else {
                                form.style.display = "none";
                            }
                        }
                    </script>
                    

                </body>
            </html>

    
    <?php }else{
        header("Location: ../index.php");
    }

?>

