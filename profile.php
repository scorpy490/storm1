<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
<!--    <link rel="stylesheet" href="assets/css/main.css">-->
</head>
<body>

    <!-- Профиль -->

    <form>
        <img src="<?= $_SESSION['user']['avatar'] ?>" width="200" alt="">
        <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
        <a href="#"><?= $_SESSION['user']['email'] ?></a>
        <a href="vendor/logout.php" class="logout">Выход</a>
    </form>

    <form action="vendor/timer_add.php" method="post">

        <h2 Создать таймер</h2>
        <label>Название таймера</label>
        <input type="text" name="timer_mame" placeholder="">
        <label>Продолжительность</label>
        <input type="text" name="interval" placeholder="Дни">
        <button type="submit">Установить</button>

    </form>

   


</body>
</html>