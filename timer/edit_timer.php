<?php
session_start();
include 'connect.php';
include 'module1.php';
date_default_timezone_set('Asia/Tomsk');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}



if (!isset($_POST['i'])){
    echo "неГотово";
    return;
}
$i = $_POST['i'];
if (isset($_POST['del'])){
    del_timer($i);
    header('Location: profile.php');
    return;
}
$userid = $_SESSION['user']['id'];
$queryStr = "SELECT * from `timers` WHERE `id`= '$i' ";
$result = mysqli_query($connect, $queryStr);
$count_tm='';

while ($row = $result->fetch_assoc()) {
    $txt = trim($row['txt']);
    $cr_time = $row['cr_time'];
    $continue_time = $row['continue_time'];
    //$dt_cr = gmdate("Y-m-d\TH:i:s\Z", $cr_time);
    //$dt_cr = date("D M j G:i:s T Y",$cr_time);
    $dt_cr = date("D M j G:i:s", $cr_time);
    //$btn_str = btn_str($id, $row['active']);
    //$link_edit = link_edit($id, $txt);
    $count_tm = $row['count_tm'];
    //$last_tm = secToArray( time() - $continue_time);

    if ($row['active'] == 1) {
        $last_tm = secToArray( time() - $continue_time);

        $delta = time() - $continue_time + $row['value_tm'];
    } else {
        $delta = $row['value_tm'];
        $last_tm = 0;
    }
    $lasttm = $last_tm['days'] . ' дн.' . $last_tm['hours'] . 'час.' . str_pad($last_tm['minutes'], 2, 0, 0) . 'мин.' . str_pad($last_tm['secs'], 2, 0, 0) . "`";
    $dt = secToArray($delta);
    $dtstr = $dt['days'] . ' дн.' . $dt['hours'] . 'час.' . str_pad($dt['minutes'], 2, 0, 0) . 'мин.' . str_pad($dt['secs'], 2, 0, 0) . "`";
    echo "
<p>Пауз: $count_tm</p>
<p>$i</p>
<p>$txt</p>   
<p>Создан : $dt_cr</p>
<p>$dtstr</p>
<p>$lasttm</p>
<p></p>
<p></p>

<form action='edit_timer.php' method='post'><input type='hidden' name='i' value='$i'><input type='hidden' name='del' value='true'><button type='submit'>Удалить</button></form>

<p><a href='profile.php'>Назад</p>

";
}
function del_timer ($i) {
    include 'connect.php';
    $queryStr = "DELETE from `timers` WHERE `id`= '$i' ";
    $result = mysqli_query($connect, $queryStr);
}
