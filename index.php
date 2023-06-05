<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: profile.php');
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script
            type="text/javascript"
            src="https://vk.com/js/api/openapi.js?168"
            charset="windows-1251"
    ></script>
    <script type="text/javascript">
        VK.init({ apiId: 51653404 });
    </script>

    <script type="text/javascript">
        VK.Widgets.Auth("vk_auth", {authUrl: "/login_vk.php"});
    </script>
</head>
<body>

<!-- Форма авторизации -->

    <form action="vendor/signin.php" method="post">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="/register.php">зарегистрируйтесь</a>!
        </p>
        <?php
            if (isset ($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
        <!-- Put this script tag to the place, where the Login block will be -->
        <div id="vk_auth"></div>
    </form>



</body>
</html>