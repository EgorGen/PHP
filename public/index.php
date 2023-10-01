<?php

require_once 'User.php';
require_once 'FileUserPersist.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $filepersister = new FileUserPersist();

    if (isset($_GET['action']) && 'login' === $_GET['action']){
        $user = $filepersister ->get(strtolower($_POST['login']));
        if (!$user) {
            die('Неверный логин или пароль');
        }

        if ($user->getPassword() === sha1($_POST['password'])){
            session_start();

            $_SESSION['user']  =$user->getLogin();
        }

        header('location: index.php');
        die();
    }

    $user = new User((string) $_POST['login'], (string) $_POST['password'],(string) $_POST['password2'], (string) $_POST['address'], (string) $_POST['email'], (string) $_POST['number']);
    echo $user->getCreatedAt()->format( 'd.m.Y H:i:s') . '<br>'; 
    echo ($user->isPasswordsEquals() ? 'Одинаковые' : 'Разные') . 'Пароли';

    if (!$user->isPasswordsEquals()) {
        echo 'Ошибка: пароли не совпадают';
        die();
    }

    if ($filepersister->get($_POST['login']) instanceof User){
        echo 'Ошибка: пользователь с таким логином уже существует';
        die();
    }

    $filepersister ->save($user);

    header('location: index.php?registration=success');
    die();
}

if (isset($_GET['action']) && 'logout' === $_GET['action']){
    session_unset();
    header('location: index.php');
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Заголовок страницы в браузере</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonds.css">
</head>
<body>
<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link">Тарифы</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Новости</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Техническая поддержка</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Документы</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Справка</a></li>
        </ul>
    </header>
</div>
<div class="container">
    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { 
        if (isset($_SESSION['user'])){
           echo sprintf('Привет, %s', $_SESSION['user']). '<a class="btn btn-success" href="index.php?action=logout">Выход</a><br />';
        }
        ?>
    <form action="index.php" method="post">
        <h1 title="Форма регистрации">Регистрация<h1>
        <div class="mb-3">
            <label for="LoginInput" class="form-label">Логин</label>
            <input type="text" class="form-control" name="login" id="LoginInput" placeholder="Логин">
        </div>

        <div class="mb-3">
            <label for="password-field1" class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" id="password-field1" placeholder="Пароль">
        </div>

        <div class="mb-3">
            <label for="password-field2" class="form-label">Повторите Пароль</label>
            <input type="password" class="form-control" name="password2" id="password-field2" placeholder="Повторите Пароль">
        </div>

        <div class="mb-3">
            <label for="address-field1" class="form-label">Адрес доставки</label>
            <input type="text" class="form-control" name="address" id="address-field1" placeholder="Адрес доставки">
        </div>

        <div class="mb-3">
            <label for="mailInput" class="form-label">Адрес электронной почты</label>
            <input type="email" class="form-control" name="email" id="mailInput" placeholder="Адрес электронной почты" >
        </div>

        <div class="mb-3">
            <label for="number-phone" class="form-label">Номер телефона</label>
            <input type="text" class="form-control" name="number" id="nuber-phone"  placeholder="Номер телефона" >
        </div>

        <div class="mb-3">
            <center><input type="submit" class="btn btn-primary" value="Регистрация"></center>
        </div>
    </form>
    <?php
    }
    ?>
</div>

<div class="container">
    <?php

    if (isset($_GET['registration']) && 'success' === $_GET['registration']) {
        ?>
        <form action="index.php?action=login" method="post">
        <h1 title="Форма регистрации">Регистрация<h1>
            <div class="mb-3">
                <label for="Login" class="form-label">Логин</label>
                <input type="text" class="form-control" name="login" id="Login" placeholder="Логин">
            </div>

            <div class="mb-3">
                <label for="password-field1" class="form-label">Пароль</label>
                <input type="password" class="form-control" name="password" id="password-field1" placeholder="Пароль">
            </div>

            <div class="mb-3">
            <center><input type="submit" class="btn btn-primary" value="Войти"></center>
            </div>
        </form>
    <?php
    }

    ?>
</div>

<div class="box">
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>