<?php
session_start();
include 'connect.php';
//include 'module1.php';
if (!isset($_SESSION['user'])) {
//header('Location: login.php');
}

file_put_contents('log.txt', print_r($_POST, true), FILE_APPEND);



ini_set('display_errors',1);
setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');
date_default_timezone_set('Asia/Tomsk');
error_reporting(E_ALL);

//$userid = $_SESSION['user']['id'];
if (isset($_POST['txt'])){
    ins_txt($_POST['txt'], $_POST['note']);
    //echo "Готово";
    header('Location: tk_ins.html');
}

if (isset($_POST['btn_name'])){
    paused_timer($_POST['btn_name']);
    echo $_POST['btn_name'];
}

if (isset($_POST['select'])) {
    echo select_txt();
}

function select_txt()
{
    include 'connect.php';
    $queryStr = "SELECT * from `tk1` ";
    $result = mysqli_query($connect, $queryStr);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo(json_encode($data));

}




function ins_txt($txt, $note) {
    include 'connect.php';
    //$userid = $_SESSION['user']['id'];
   // $now = time()-($interval*3600);
    $queryStr= "INSERT INTO `tk1` (`txt`, `note`) VALUES ('$txt','$note')";
    $check_user = mysqli_query($connect, $queryStr);
    //echo $queryStr;



}

function paused_timer ($id){
    include 'connect.php';
    $now = time();
    $queryStr= "UPDATE `timers` SET `value_tm`= ($now-`continue_time`)*`active` + `value_tm`, `count_tm`= `count_tm`+ `active`, `active`=not `active`, `continue_time`= $now WHERE `id`= $id ";
    $check_user = mysqli_query($connect, $queryStr);
}