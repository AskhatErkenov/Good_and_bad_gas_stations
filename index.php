<?php
require("connection.php");
require("session.php");

if (empty($session_user)) {
    $welcoming = '<div>
                        <a href = "login.php">  
                            <button class="floating-button"> 
                                Авторизация
                            </button>
                        </a>
                    </div>';
} else {
    $welcoming = '<div>
                        <a href = "quit.php">  
                            <button class="floating-button"> 
                                Выход
                            </button>
                        </a>
                    </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G&B Gas station</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic&amp;subset=cyrillic">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css?ver=5.0.3' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='art_net_theme-material-icons-css'
          href='https://fonts.googleapis.com/icon?family=Material+Icons&#038;ver=5.0.3' type='text/css' media='all'/>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
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
                        <li class="menu-item"><?php echo $welcoming ?></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<body>
<script src="https://api-maps.yandex.ru/2.1/?apikey=5020e9dc-69af-4f53-bb8b-24921928601a&lang=ru_RU&coordorder=longlat"></script>
<script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
<form action="index.php" method="POST" name="my">
    <?php
    if (empty($session_user)) { ?>
        <?php
        include("main.php");
        ?>
        </div>
        <?php
    } else {
        ?>
        <div class="wrapper">
            <input type="radio" id="option-1" name="myratio"
                   value="all_gas_stations"
                   checked="checked" <?php if (isset($_POST['myratio']) && $_POST['myratio'] == 'all_gas_stations') {
                echo ' checked="checked"';
                include("main.php");
            }
            ?>
            >
            <input type="radio" id="option-2" name="myratio"
                   value="qualitative" <?php if (isset($_POST['myratio']) && $_POST['myratio'] == 'qualitative') {
                echo ' checked="checked"';
                require("good_gas_station.php");
            }
            ?>
            >
            <input type="radio" id="option-3" name="myratio"
                   value="not_qualitative"<?php if (isset($_POST['myratio']) && $_POST['myratio'] == 'not_qualitative') {
                echo ' checked="checked"';
                require("bad_gas_station.php");
            }
            ?>
            >
            <label for="option-1" class="option option-1">
                <div class="dot"></div>
                <span>Все заправки</span>
            </label>
            <label for="option-2" class="option option-2">
                <div class="dot"></div>
                <span>Качественные</span>
            </label>
            <label for="option-3" class="option option-3">
                <div class="dot"></div>
                <span>Не качественные</span>
            </label>
        </div>
        <input class="floating-button" id='buttonfind' type="submit" name="submit" value="Подтвердить">
        <?php
    }
    ?>
</form>
<div class="map" id="map"></div>
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