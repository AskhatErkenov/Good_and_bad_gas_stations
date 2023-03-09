<?php
require("connection.php");
require("session.php");
$user = "users";
$emai = "email";
$password = "password";
if (!empty($_POST)) {
    $pass = $_POST['pass'];
    $email = $_POST['email'];

    $result = mysqli_query($connect, "SELECT * FROM " . $user . " WHERE
    `" . $emai . "`='$email' AND
    `" . $password . "`= '$pass'
");


    if (!$result || mysqli_num_rows($result) == 0) {
        echo "Такой пользователь не найден в базе данных.";
    } else {
        session_start();
        $_SESSION["user"] = mysqli_fetch_assoc($result);
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>G&B Gas station</title>
    <link rel="shortcut icon" href="images/gas_station.svg" type="image/x-icon">
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic&amp;subset=cyrillic'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css?ver=5.0.3' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='art_net_theme-material-icons-css'
          href='https://fonts.googleapis.com/icon?family=Material+Icons&#038;ver=5.0.3' type='text/css' media='all'/>
    <link rel='stylesheet' type='text/css' href='css/header.css'>
    <link rel='stylesheet' type='text/css' href='css/footer.css'>
    <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='css/style.css'>
    <link rel='stylesheet' type='text/css' href='css/style1.css'>
    <link rel='stylesheet' type='text/css' href='vendor/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='fonts/font-awesome-4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' type='text/css' href='fonts/iconic/css/material-design-iconic-font.min.css'>
    <link rel='stylesheet' type='text/css' href='vendor/animate/animate.css'>
    <link rel='stylesheet' type='text/css' href='vendor/css-hamburgers/hamburgers.min.css'>
    <link rel='stylesheet' type='text/css' href='vendor/animsition/css/animsition.min.css'>
    <link rel='stylesheet' type='text/css' href='vendor/select2/select2.min.css'>
    <link rel='stylesheet' type='text/css' href='vendor/daterangepicker/daterangepicker.css'>
    <link rel='stylesheet' type='text/css' href='css/util.css'>
    <link rel='stylesheet' type='text/css' href='css/main.css'>
</head>
<header id="ant-section__ant006_header">
    <div class="container">
        <div class="row">
            <div class="ant006_header-logo">
                <a href="index.php">
                    <div><img src='images/gas_station.svg' width="100" alt='G&B Gas station'></div>
                    G&B Gas station</a>
            </div>
            <div class="col-lg-9 col-sm-6 col-md-12 col-6">
                <nav class="ant006_header-container">
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="index.php">
                                <button class="floating-button">
                                    Главная
                                </button>
                            </a></li>
                        <li class="menu-item"><a href="login.php">
                                <button class="floating-button">
                                    Авторизация
                                </button>
                            </a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<body>
<?php include('connection.php'); ?>

<form method='POST'>
    <div class='limiter'>
        <div class='container-login100'>
            <div class='wrap-login100'>
                <form class='login100-form validate-form'>

                <span class='login100-form-title p-b-34 p-t-27'>
						Вход
					</span>

                    <div class='wrap-input100 validate-input' data-validate='Введите email'>
                        <input class='input100' type='email' name='email' placeholder='Email'>
                        <span class='focus-input100' data-placeholder='&#xf207;'></span>
                    </div>

                    <div class='wrap-input100 validate-input' data-validate='Введите пароль'>
                        <input class='input100' type='password' name='pass' placeholder='Пароль'>
                        <span class='focus-input100' data-placeholder='&#xf191;'></span>
                    </div>

                    <div class='contact100-form-checkbox'>
                        <input class='input-checkbox100' id='ckb1' type='checkbox' name='remember-me'>
                        <label class='label-checkbox100' for='ckb1'>
                            Запомнить меня
                        </label>
                    </div>

                    <div class='container-login100-form-btn'>
                        <button class='login100-form-btn'>
                            Войти
                        </button>
                        <a class='login100-form-btn' href='reg.php'>Регистрация</a>
                    </div>


                    <div class='text-center p-t-90'>
                        <a class='txt1' href='#'>
                            Забыли пароль?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
<footer id="ant-section__ant007_footer" class="">
    <div class="row">
        <div class="col-lg-5 ant007_footer__footer-item-wrap">
            <div class="footer-item">
                <p><a>Эркенов Асхат 211-362.</a></p>
                <p>
                    <a href="https://data.mos.ru/opendata/7704221753-avtozapravochnye-stantsii-realizuyushchie-toplivo-sootvetstvuyushchee-ustanovlennym-ekologicheskim-trebovaniyam/data/table?versionNumber=5&releaseNumber=25">Автозаправочные
                        станции, реализующие топливо, соответствующее установленным экологическим требованиям</a></p>
                <p>
                    <a href="https://data.mos.ru/opendata/7704221753-avtozapravochnye-stantsii-realizuyushchie-toplivo-nesootvetstvuyushchee-ustanovlennym-ekologicheskim-trebovaniyam">Автозаправочные
                        станции, реализующие топливо, несоответствующее установленным экологическим требованиям</a></p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>