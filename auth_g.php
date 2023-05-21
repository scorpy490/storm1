<?php
$params = array(
    'client_id'     => '49351103791-i830d6ofuku6akjmu1kr9epf9rh1bko9.apps.googleusercontent.com',
    'redirect_uri'  => 'https://nt32.ru/login_google.php',
    'response_type' => 'code',
    'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
    'state'         => '123'
);

$url = 'https://accounts.google.com/o/oauth2/auth?' . urldecode(http_build_query($params));
echo '<a href="' . $url . '">Авторизация через Google</a>';

$params = array(
    'client_id'     => '1cfaeeb37143478d95d62fe4d63b9d96',
    'redirect_uri'  => 'http://nt32.ru/login_ya.php',
    'response_type' => 'code',
    'state'         => '123'
);

$url = 'https://oauth.yandex.ru/authorize?' . urldecode(http_build_query($params));
echo '<p></p><a href="' . $url . '">Авторизация через Яндекс</a>';
