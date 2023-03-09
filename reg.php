<?php
require("connection.php");
$user = "users";
$emai = "email";
$usernam = "username";
$pass = "password";
if(isset($_POST)){

    if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['pass'])) {
        $username=htmlspecialchars($_POST['username']);
        $email=htmlspecialchars($_POST['email']);
        $password=htmlspecialchars($_POST['pass']);
        $query=mysqli_query($connect,"SELECT * FROM ".$user." WHERE ".$emai." = '". $email ."' AND ".$usernam."='".$username."'");
        $numrows=mysqli_num_rows($query);
        if($numrows==0)
        {
            $sql = "INSERT INTO `".$user."` (`username`, `email`, `password`) VALUES ('$username','$email', '$password')";
            $result=mysqli_query($connect, $sql);
            if($result){
                $message = "Аккаунт успешно создан";
            } else {
                $message = "Не удалось вставить информацию о данных!";
            }
        } else {
            $message = "Такой пользователь уже существует в базе данных!";
        }
    } else {
        $message = "Все поля обязательны для заполнения!";
    }
}
?>

<?php if (!empty($message)) {echo "<p class='error'>" . $message . "</p>";} ?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>G&B Gas station</title>

    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic&amp;subset=cyrillic'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css?ver=5.0.3' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='art_net_theme-material-icons-css'
          href='https://fonts.googleapis.com/icon?family=Material+Icons&#038;ver=5.0.3' type='text/css' media='all'/>
    <link rel='stylesheet' type='text/css' href='css/header.css'>
    <link rel='stylesheet' type='text/css' href='css/footer.css'>
    <link rel='stylesheet' type='text/css' href='css/auto_reg.css'>
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
                <a href="index.php"><div><img src='images/gas_station.svg' width="100" alt='G&B Gas station'></div>G&B Gas station</a>
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
                        <li class="menu-item"><a href = "login.php">
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
						Регистрация
					</span>

                    <div class='wrap-input100 validate-input' data-validate = 'Введите логин'>
                        <input class='input100' type='text' name='username' placeholder='Логин'>
                        <span class='focus-input100' data-placeholder='&#xf207;'></span>
                    </div>

                    <div class='wrap-input100 validate-input' data-validate = 'Введите email'>
                        <input class='input100' type='text' name='email' placeholder='Email'>
                        <span class='focus-input100' data-placeholder='&#xf207;'></span>
                    </div>

                    <div class='wrap-input100 validate-input' data-validate='Введите пароль'>
                        <input class='input100' type='password' name='pass' placeholder='Пароль'>
                        <span class='focus-input100' data-placeholder='&#xf191;'></span>
                    </div>

                    <div class='wrap-input100 validate-input' data-validate='Ваши пароли не совподают'>
                        <input class='input100' type='password' name='сonf_pass' placeholder='Подтвердите пароль'>
                        <span class='focus-input100' data-placeholder='&#xf191;'></span>
                    </div>

                    <div class='container-login100-form-btn'>
                        <button class='login100-form-btn'>
                            Зарегестрироваться
                        </button>
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
                <p><a href="https://data.mos.ru/opendata/7704221753-avtozapravochnye-stantsii-realizuyushchie-toplivo-sootvetstvuyushchee-ustanovlennym-ekologicheskim-trebovaniyam/data/table?versionNumber=5&releaseNumber=25">Автозаправочные станции, реализующие топливо, соответствующее установленным экологическим требованиям</a></p>
                <p><a href="https://data.mos.ru/opendata/7704221753-avtozapravochnye-stantsii-realizuyushchie-toplivo-nesootvetstvuyushchee-ustanovlennym-ekologicheskim-trebovaniyam">Автозаправочные станции, реализующие топливо, несоответствующее установленным экологическим требованиям</a></p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>