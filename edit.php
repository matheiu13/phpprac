<?php 
    include("includes/db.php");
    $id = $_GET['id'];
    $sql = "SELECT * FROM user_data WHERE user_id = {$id}";
    $result;
    try{
        $result = mysqli_query($conn, $sql);
    } catch(mysqli_sql_exception $e){
        echo "cannot get user data";
        echo $e;
    }

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
        <br>
        <h1>Edit</h1>
        <?php
        while($row=mysqli_fetch_assoc($result)){
        ?>
        <?php echo $row['user_id'];?>
        <div class="input-form"><span>username </span><input type="text" name="username" value="<?php echo $row['user_name'];?>"></div>
        <div class="input-form"><span>email </span><input type="text" name="email" value="<?php echo $row['user_email'];?>"></div>
        <?php }?>
        <br>
        <input type="submit" name="login" value="Save changes" class="submit"><br>
        <p style="align-self:center;"><a href="/phpprac/home.php">Or go back to home page.</a></p>
    </div>
    </form>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $new_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);;
        $new_email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);;
        
        if(empty($new_username)){
            echo "Please enter a Username.";
        } else if(empty($new_email)) {
            echo "Please enter an Email.";
        } else {
            $sql_savechanges = "UPDATE user_data SET user_name = '{$new_username}', user_email = '{$new_email}' WHERE user_id = '{$id}'";
            try{
                mysqli_query($conn, $sql_savechanges);
                echo "user " . $row['user_id'] ." successfully updated";
                header("Location: home.php");
                
            } catch(mysqli_sql_exception $e){
                echo "Cannot save changes.";
                echo $e;
            }
        }
    }
    mysqli_close($conn);
?>