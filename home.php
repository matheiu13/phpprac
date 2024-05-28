<?php 
    include("includes/db.php");
    session_start();
    if(!$_SESSION){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/table.css">
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="contact.php">Contact</a>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <input type="submit" name="logout" value="logout">
        </form>
    </div>
    <h1>Welcome to home page!! <?php echo $_SESSION["username"]?></h1>
    <br>
    <table>
        <tr class="theader">
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th></th>
        </tr>
    <?php 
    if($conn){
        $sql = "SELECT * FROM user_data";
        $user_data = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($user_data)){
            ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['user_email']; ?></td>
                <td><div style="display: flex; gap: 5px; width: min-content;">
                    <?php echo "<a href='edit.php?id={$row['user_id']}'><button>Edit</button></a>"?>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                        <input type="hidden" name="delete_id" value="<?php echo $row['user_id']; ?>">
                        <input type="submit" name="delete" value="delete">
                    </form>
                </div>
                </td>
            </tr>
            <?php
        }
    }
    ?>
    </table>
</body>
</html>
<?php
    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        try {
            $delete_id = $_POST['delete_id'];
            $sql = "DELETE FROM user_data WHERE user_id = '$delete_id'";
            if (mysqli_query($conn, $sql)) {
                echo "Record deleted successfully";
                header("Location: home.php");
            } 
            mysqli_close($conn);
        } catch(mysqli_sql_exception $e) {
            echo "User ID not set for deletion";
            echo $e;
        }
    }
?>