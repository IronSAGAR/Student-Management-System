

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body{
            background-image: url("img/bg-img.jpg");
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.2);
            margin: 0px;
            padding: 0px;
        }
        .heading{
            margin-top: 10vh;
            margin-bottom: 50px;
            font-size: 3vw;
            font-family: 'Dancing Script', cursive;
            color: black;
            text-shadow: 2px 2px white;
        }
        .forms{
            margin: 50px;
            max-width: 500px;
            padding: 10px;
            border: 1px white solid;
            
            padding: 3vh 2vw;
            border-radius: 10%;
            box-shadow: inset 0 0 0 1000px rgba(150, 160, 255, 0.2);
            
        }

    </style>
</head>
<body>
    <div class="container text-center heading" >
        <span>Centralized Student Management System</span>
    </div>

    <div class="d-flex justify-content-end">

        <div class="container forms">
            <h2 class="text-center">Login</h2>
            <form action = "php/check-login.php" method = "post">

                <?php if(isset($_GET['error'])) { ?>
                <div class="mb-3 alert alert-danger">
                    <?=$_GET['error']?>
                </div>
                <?php } ?>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name = "username">
                    
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name = "password">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Select Role</label>
                    <select class="form-select" aria-label="Default select example" name = "role">
                        <option selected value="teacher">Teacher</option>
                        <option value="principal">Principal</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        
    </div>
</body>
</html>