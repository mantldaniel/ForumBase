<?php
session_start();
include('database.php');
$dbConnection = new DatabaseConnection("forumname");
$sql = $dbConnection->sqlConnection;
$errors = array();

if(!isset($_POST['name'], $_POST['password'], $_POST['passwordconfirm'], $_POST['email']))
{
    exit("Please fill in all the required information in the fields.");
}

$name = $_POST['name'];
$passwd = $_POST['password'];
$passwdconfrim = $_POST['passwordconfirm'];
$email = $_POST['email'];

if(empty($name)) {array_push($errors, "A name is required");}
if(empty($email)) {array_push($errors, "A email is required");}
if(empty($passwd)) {array_push($errors, "A password is required");}
$checkIfUserExists = "SELECT * FROM users WHERE name='$name' OR email='$email'";
$res = $sql->query($checkIfUserExists);
$user = mysqli_fetch_assoc($res);

if($user['email'] === $email)
{
    array_push($errors, "User with that Email has already Registered!");
}

if(count($errors) == 0)
{
    $passwordHash = password_hash($passwd, PASSWORD_DEFAULT);
    if($stmt = $sql->prepare("INSERT INTO users (name, email, password) VALUES('$name', '$email', '$passwordHash')"))
    {
        $stmt->execute();
        $stmt->close();
        header('location: http://127.0.0.1/index.html');
    }
}

?>