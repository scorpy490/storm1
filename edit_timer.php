<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
if (isset($_POST['i'])){
    echo "Готово";
}
echo '
<button>Удалить</button>
';
