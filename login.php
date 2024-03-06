<?php
$servername = "localhost";
$username = "Username";
$password = "Password";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// retrieve login input
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    //secure input
    $username = mysqli_real_escape_string($conn,$username);
    $password = mysqli_real_escape_string($conn,$password);

    //hash the password (use a strong hashing algorithm)
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    //check details agains database
    $sql = "SELECT * FROM details WHERE Username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password,$row['Password'])) {
            //successful login, redirect to other page
        echo "Login successful!";
    } else {
        echo "Invalid password";
    }
} else {
    //user not found
    echo "username not found";
}

$conn->close();
?>
