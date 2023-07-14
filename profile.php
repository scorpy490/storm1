<?session_start();
include 'connect.php';
include 'module1.php';
if (!isset($_SESSION['user'])) {
header('Location: login.php');
}
?>
<!doctype html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <!--    <link rel="stylesheet" href="assets/css/main.css">-->
</head>
<br>

<!-- Профиль -->

<form>
    <h2><?= $_SESSION['user']['id'] ?></h2>
    <!--<img src="<?php /*= $_SESSION['user']['avatar'] */?>" width="200" alt="">-->
    <h2><?= $_SESSION['user']['full_name'] ?></h2>
    <a href="#"><?= $_SESSION['user']['email'] ?></a>
    <a href="vendor/logout.php" class="logout">Выход</a>
</form>

<form action="profile.php" method="post">

    <p Создать таймер></p>
    <label>Название таймера</label>
    <input type="text" name="timer_name" placeholder="" autocomplete="off">
    <label>Назад</label>
    <input type="text" name="interval" placeholder="в часах"  autocomplete="off">
    <button type="submit">Установить</button>

</form>
</br>


<form action="profile.php" method="get">

    <button type="submit">Обновить</button>

</form>

<?php
ini_set('display_errors',1);
setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');
date_default_timezone_set('Asia/Tomsk');
error_reporting(E_ALL);

$userid = $_SESSION['user']['id'];
if (isset($_POST['timer_name'])){
    ins_timer($userid, $_POST['timer_name'], $_POST['interval']);
    //echo "Готово";
}

if (isset($_POST['btn_name'])){
    paused_timer($_POST['btn_name']);
    echo $_POST['btn_name'];
}

$queryStr = "SELECT * from `timers` WHERE `id_user`= '$userid'";
$result = mysqli_query($connect, $queryStr);
//$result = mysqli_fetch_assoc ($list);
//print_r($listtimers);

echo '</br>';

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $txt = trim ($row['txt']);
    $cr_time = $row['cr_time'];
    $continue_time = $row['continue_time'];
    //$dt_cr = gmdate("Y-m-d\TH:i:s\Z", $cr_time);
    //$dt_cr = date("D M j G:i:s T Y",$cr_time);
    $dt_cr = date("D M j G:i:s",$cr_time);
    $btn_str = btn_str($id, $row['active']);
    $link_edit = link_edit ($id, $txt);

    if ($row['active']==1) {

        $delta = time() - $continue_time + $row['value_tm'];
    }
    else {
        $delta=$row['value_tm'];
    }
        $dt = secToArray($delta);
        $dtstr = $dt['days'] . ':' . $dt['hours'] . ':' . str_pad( $dt['minutes'],2, 0, 0) . ':' . str_pad( $dt['secs'], 2, 0, 0);
        //$dtstr = $dt[0].':'.$dt[1].':'.$dt[2].':'.$dt[3];


   // print_r($row);

    //printf("%s (%s)\n", $txt, $row['cr_time']);

    echo "

    <table border=1>   
        <tr> 
        <td width='150px'> $link_edit </td> 
        <td width='160px'>   $dt_cr </td> 
        <td width='100px'> $dtstr </td> 
        <td> $btn_str </td>
        </tr>
 </table>
";
}




function btn_str ($id, $active) {
    if ($active==1) {
        $bt_text = "Паза";
    } else {
        $bt_text = "Старт";
    }
    return $res =  "<form action='profile.php' method='post'><input type='hidden' name='btn_name' value='$id'><button type='submit' id=b$id >$bt_text</button></form>";
}

function link_edit ($id, $txt) {
    return $res =  "<form action='edit_timer.php' method='post'><input type='hidden' name='i' value='$id'><button type='submit'>$txt</button></form>";
}




function ins_timer($userid, $timername, $interval) {
    include 'connect.php';
    $userid = $_SESSION['user']['id'];
    $now = time()-($interval*3600);
    $queryStr= "INSERT INTO `timers` (`id_user`, `txt`, `cr_time`, `begin_tm`,  `continue_time`,`value_tm`, `end_time`, `count_tm`, `active`) VALUES ('$userid','$timername','$now' ,'$now','$now', 0,null,0,1)";
    $check_user = mysqli_query($connect, $queryStr);
    //echo $queryStr;



}

function paused_timer ($id){
    include 'connect.php';
    $now = time();
    $queryStr= "UPDATE `timers` SET `value_tm`= ($now-`continue_time`)*`active` + `value_tm`, `count_tm`= `count_tm`+ `active`, `active`=not `active`, `continue_time`= $now WHERE `id`= $id ";
    $check_user = mysqli_query($connect, $queryStr);
}

?>


</body>
</html>