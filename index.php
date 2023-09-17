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
    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
    <form action="form.php" method="post">
        <h1 title="Форма регистрации">Регистрация<h1>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Имя</label>
            <input type="text" class="form-control" name="firstname" id="exampleFormControlInput1" value="<?php echo $_POST['firstname'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" id="exampleFormControlInput2" value="<?php echo $_POST['password'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Адрес доставки</label>
            <input type="text" class="form-control" name="address" id="exampleFormControlInput3" value="<?php echo $_POST['address'] ?? '' ?>" >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput4" class="form-label">Адрес электронной почты</label>
            <input type="email" class="form-control" name="letter" id="exampleFormControlInput4" value="<?php echo $_POST['letter'] ?? '' ?>" >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput5" class="form-label">Номер телефона</label>
            <input type="text" class="form-control" name="number" id="exampleFormControlInput5" value="<?php echo $_POST['number'] ?? '' ?>" >
        </div>

        <div class="mb-3">
            <center><input type="submit" class="btn btn-primary" value="Регистрация">
        </div>
    </form>
    <?php
    }
    ?>
</div>

<div class="container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo '<b>firstname</b> = ' . ($_POST['firstname'] ?? '') . '<br>';
        echo 'password = ' . ($_POST['password'] ?? '');
        echo 'address = ' . ($_POST['address'] ?? '');
        echo 'letter = ' . ($_POST['letter'] ?? '');
        echo 'number = ' . ($_POST['number'] ?? '');
    }
    ?>
</div>

<div class="box">
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>