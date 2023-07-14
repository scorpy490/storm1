<?php
session_start();
include 'connect.php';
include 'module1.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
if (!isset($_POST['i'])){
    echo "неГотово";
    return;
}
$i = $_POST['i'];
$userid = $_SESSION['user']['id'];
$queryStr = "SELECT * from `timers` WHERE `id`= '$i' ";
$result = mysqli_query($connect, $queryStr);

while ($row = $result->fetch_assoc()) {
    $txt = trim($row['txt']);
    $cr_time = $row['cr_time'];
    $continue_time = $row['continue_time'];
    //$dt_cr = gmdate("Y-m-d\TH:i:s\Z", $cr_time);
    //$dt_cr = date("D M j G:i:s T Y",$cr_time);
    $dt_cr = date("D M j G:i:s", $cr_time);
    //$btn_str = btn_str($id, $row['active']);
    //$link_edit = link_edit($id, $txt);
}
$delta = time() - $continue_time + $row['value_tm'];
$dt = secToArray($delta);
$dtstr = $dt['days'] . ' дн.' . $dt['hours'] . 'час.' . str_pad( $dt['minutes'],2, 0, 0) . 'мин.' . str_pad( $dt['secs'], 2, 0, 0)."`";
echo "
<p>$txt</p>   
<p>$cr_time</p>
<p>$dtstr</p>
<p></p>
<p></p>

<p><a href='profile.php'>Выйти</p>

";
