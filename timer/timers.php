<?php
session_start();
include 'connect.php';
include 'module1.php';
if (!isset($_SESSION['user'])) {
header('Location: login.php');
}



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
$data = $result->fetch_all(MYSQLI_ASSOC);
echo (json_encode ($data));
//return json_encode ($data);




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