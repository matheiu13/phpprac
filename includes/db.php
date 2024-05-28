<?php
$serverName = "localhost:4306";
$userName = "root";
$password = "";
$dbName = "businessdb";
$conn;

try {
    $conn=mysqli_connect($serverName, $userName, $password, $dbName);
    // echo "connected successfully!";
} catch (mysqli_sql_exception){
    echo "cannot connect to the server.";
}

// if($conn){
//     $query= "select * from user_data";
//     $result = mysqli_query($conn, $query);
//     echo "<br>";
//     while($row = mysqli_fetch_assoc($result)){
//         echo $row['user_id'] . " " . $row['user_name'] . " " . $row['user_email'] . "<br>";
//     }
// }
?>