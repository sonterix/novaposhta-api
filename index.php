<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Website CSS style -->
    <link rel="stylesheet" href="css/select2.min.css">    
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- Website Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <title>Create TTN</title>
</head>
<body>

    <section id="cteate-ttn-wrapper">
        <div id="cteate-ttn">

            <div id="ttn">
                <div class="logo-np"></div>
                <h1>CОЗДАТЬ ТТН</h1>
            </div>

            <form method="post" action="src/create.php" id="np-form">
                <div class="input-wrapper">
                    <label for="name">ФИО</label>
                    <span class="icon-wrapper"><i class="fas fa-user"></i></span>
                    <input type="text" id="name" name="Order[name]" placeholder="Введите ФИО">
                </div>

                <div class="input-wrapper">
                    <label for="phone">Номер Телефон</label>
                    <span class="icon-wrapper"><i class="fas fa-phone"></i></span>
                    <input type="text" id="phone" name="Order[phone]" placeholder="Введите Номер Телефона">
                </div>

                <div class="input-wrapper">
                    <label for="Order[city]">Город</label>
                    <span class="icon-wrapper"><i class="fas fa-building"></i></span>
                    <select id="select-city" name="Order[city]"></select>
                </div>

                <div class="input-wrapper">
                    <label for="Order[department]">Номер Отделения</label>
                    <span class="icon-wrapper"><i class="fas fa-arrows-alt"></i></span>
                    <select id="select-department" name="Order[department]"></select>
                </div>

                <div class="input-wrapper">
                    <label for="weight">Вес Посылки <small>(кг.)</small></label>
                    <span class="icon-wrapper"><i class="fas fa-archive"></i></span>
                    <input type="number" id="weight" name="Order[weight]" step="0.001" placeholder="Введите Вес Посылки">
                </div>

                <div class="input-wrapper">
                    <label for="cost">Цена <small>(грн.)</small></label>
                    <span class="icon-wrapper"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="cost" name="Order[cost]" step="0.01" placeholder="Введите Цену">
                </div>

                <input type="submit" class="submit-btn" name="submit" value="Создать">
            </form>

        </div>
    </section>

    <!-- Website JS script -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>      
    <script src="js/select2.min.js"></script>
    <script src="js/select2_ru.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/main.js"></script>


</body>
</html>