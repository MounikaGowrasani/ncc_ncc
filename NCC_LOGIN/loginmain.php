<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            position: relative;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

body::before {
    content: "";
    background-image: url('ncc.jpg'); 
    background-size: cover;
    filter: blur(2px); 
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -1; 
}

        .card {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #555;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #333;
        }

        .input-field {
            width: calc(100% - 30px);
            padding: 10px;
            padding-left: 30px;
            border: 1px solid #ccc;
            border-radius: 25px;
            outline: none;
        }

        input[type="submit"] {
            width: 60%;
            padding: 10px;
            margin-left: 60px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Login Page</h1>
        <form action="admin.php" method="post">
            <div class="input-container">
                <i class="input-icon">✉️</i>
                <input class="input-field" type="text" name="uname" id="uname" placeholder="  Enter username" required>
            </div>
            <div class="input-container">
                <i class="input-icon">🔒</i>
                <input class="input-field" type="password" name="pass" id="pass" placeholder="  Password" required>
<br>
               
                
            </div >
            <a href="/NCC_MAIN/NCC_ENROLL/enroll.html" style="float: right; color: #331;  transition: color 0.3s ease;">Enroll here</a>
<br>           
          
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
