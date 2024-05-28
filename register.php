<?php
    include("includes/db.php")
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
        <div class="card forms">
                <h1><u>PHP CRMS</u></h1>
                <p>Customer Relationship Management System</p>
                <br>
                <h2>Register</h2>
                <div class="input-form"><span>username </span><input type="text" name="username"></div>
                <div class="input-form"><span>email </span><input type="text" name="email"></div>
                <div class="input-form"><span>password </span><input type="password" name="password"></div>
                <div class="input-form"><span>confirm password </span><input type="password" name="confPass"></div>
                <br>
                <input type="submit" name="login" value="login" class="submit"><br>
                <p style="align-self:center;"><a href="/phpprac/index.php">Already have an account?</a></p>
        </div>
    </form>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confPass = filter_input(INPUT_POST, "confPass", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($username)){
            echo "Please enter a Username.";
        } else if(empty($email)) {
            echo "Please enter an Email.";
        } else if(empty($password)){
            echo "Please enter a Password.";
        } else if(empty($confPass)) {
            echo "Please confirm your Password.";
        } else if($password != $confPass) {
            echo "Password and Confirm Password must match.";
        }
        else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql1 = "INSERT INTO users (user, password) VALUES ('$username', '$hash')";
            $sql2 = "INSERT INTO user_data (user_name, user_email) VALUES ('$username', '$email')";
            try{
                mysqli_query($conn, $sql1);
                mysqli_query($conn, $sql2);
                echo "Registration successful";
            } catch(mysqli_sql_exception){
                echo "username already taken :(";
            }
            
        }
    }
    mysqli_close($conn);

?>