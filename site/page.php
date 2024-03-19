<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Все договора</h1>

    <?php 
    ini_set('display_errors', '0');

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "straxovaya";
    
    $con = mysqli_connect($hostname, $username, $password, $dbname);
    $query = "Select client.familia as familia_clienta, straxovoi_sluchai.nazvanie as nazvanie_sluchaya, 
    vid_straxovania.naimenovanie as naimenovanie_vida, srok_v_mesecax as srok, stoimost_v_rublyax as stoimost, data_podpisania as data from straxovoi_dogovor
    INNER JOIN client on client.id_clienta = straxovoi_dogovor.id_clienta
    INNER JOIN straxovoi_sluchai on straxovoi_sluchai.id_sluchaya = straxovoi_dogovor.id_sluchaya
    INNER JOIN vid_straxovania on vid_straxovania.id_vida = straxovoi_dogovor.id_vida";
    $result = mysqli_query($con, $query);
        while($a = mysqli_fetch_array($result)){
            $familia = $a['familia_clienta'];
            $sluch = $a['nazvanie_sluchaya'];
            $vid = $a['naimenovanie_vida'];
            $sto = $a['stoimost'];
            $srok = $a['srok'];
            $data = $a['data'];
            print("
            <div>
            <p>Фамлия клиента: $familia</p> 
            <p>Страховой случай: $sluch</p>
            <p>Вид страхования: $vid</p>
            <p>Стоимость: $sto</p>
            <p>Срок: $srok</p>
            <p>Дата: $data</p>
            </div> <br>
            ");
        }
    ?>
</body>
</html>