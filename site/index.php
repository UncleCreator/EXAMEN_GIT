<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Авторизация</h1>
    <form method="POST">
        <p>Ваш логин</p><input type="text" name="login" placeholder="ваш логин"> <br>
        <p>Ваш пароль</p><input type="password" name="password" placeholder="ваш пароль"> <br><br>
        <input type="submit">
    </form>
    <br>
    <form action="registration.php">
    <input type="submit" value="Регистрация">
    </form>
</body>
</html>

<?php 
ini_set('display_errors', '0');

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "straxovaya";

$con = mysqli_connect($hostname, $username, $password, $dbname);
if(isset($_POST['login']) && isset($_POST['password'])){
    $login = $_POST['login'];
    $pass = $_POST['password'];

    $query = "Select id_agenta from straxovoi_agent Where login = '$login' and parol = '$pass'";
    $result = mysqli_query($con, $query);
    if($result!="null"){
        $a= mysqli_fetch_array($result);
        if($a!=""){
            header('Location: page.php');
        }
        else{
            print("Неверный логин или пароль");
        }

    }
}
else{
    echo("Пустые поля");
}
?>