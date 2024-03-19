<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Регистрация</h1>
    <form method="POST">
        <p>Фамилия:</p>
        <input type="text" name="fam"><br>
        <p>Имя:</p>
        <input type="text" name="imya"><br>
        <p>Отчество:</p>
        <input type="text" name="otch"><br>
        <p>Возраст:</p>
        <input type="text" name="vozr"><br>
        <p>Логин:</p>
        <input type="text" name="login" placeholder="ваш логин"> <br>
        <p>Пароль:</p>
        <input type="password" name="pass1" placeholder="ваш пароль"> <br>
        <p>Повтор пароля:</p>
        <input type="password" name="pass2" placeholder="повтор пароля"> <br><br>
        <input type="submit">
    </form>
    <br>
    <form action="index.php">
    <input type="submit" value="Авторизация">
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
if(isset($_POST['login']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['fam']) && isset($_POST['imya']) && isset($_POST['vozr']) ){
    if(!preg_match("/^[а-я А-Я]+$/u",$_POST['fam']) || !preg_match("/^[а-я А-Я]+$/u",$_POST['imya']) || !preg_match("/^[а-я А-Я]+$/u",$_POST['otch']) || !preg_match("/^[0-9]{4}$/",$_POST['vozr'])){
        print("Неверные типы данных");
    }
    else{
        $login = $_POST['login'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $fam = $_POST['fam'];
        $imya = $_POST['imya'];
        $otch = $_POST['otch'];
        $vozr = $_POST['vozr'];
        if($pass1 == $pass2){
            $pass = $pass1;
            $check = "Select id_agenta from straxovoi_agent where login='$login' and parol='$pass'";
            $checkres = mysqli_query($con, $check);
            $a = mysqli_fetch_array($checkres);
            if($a==""){
                $query = "Insert into straxovoi_agent (familia, imya, otchestvo, vozrast, login, parol) VALUES ('$fam', '$imya', '$otch', '$vozr', '$login', '$pass')";
                $result = mysqli_query($con, $query);
                if($result!="null"){
                    $a= mysqli_fetch_array($result);
                    if($a!=""){
                        print("все хорошо");
                        header('Location: index.php');
                    }
                    else{
                        print("Ошибка создания пользователя");
                    }
                }
            }
        }
    }
}
else{
    echo("Пустые поля");
}
?>