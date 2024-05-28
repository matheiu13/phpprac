<?php 
    session_start();
    include("includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="contact.php">Contact</a>
    </div>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2>Welcome!</h2>
        <div class="card forms">
            <h1><u>PHP CRMS</u></h1>
            <p>Customer Relationship Management System</p>
            <br>
            <h2>Login</h2>
            <div class="input-form"><span>username </span><input type="text" name="username"></div>
            <div class="input-form"><span>password </span><input type="password" name="password"></div>
            <br>
            <input type="submit" name="login" value="login" class="submit"><br>
            <p style="align-self:center;"><a href="/phpprac/register.php">don't have an account?</a></p>
        </div>
    </form>
</body>
</html>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM users WHERE user = '$username'";
        $select = mysqli_query($conn, $sql);

        if(mysqli_num_rows($select) > 0 ){
            $row = mysqli_fetch_assoc($select);
            if(password_verify($password, $row["password"])){
                $_SESSION["username"] = $_POST["username"];
                header("Location: home.php");
            } else{
                echo "incorrect password.";
            }
            
        } else {
            echo "user does not exists.";
        }

        mysqli_close($conn);
    }
?>