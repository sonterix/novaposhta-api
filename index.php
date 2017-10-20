<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Website CSS style -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/select2.min.css">    

    <!-- Website Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <title>Create TTN</title>
</head>
<body>
    <div class="container">
        <div class="row main">
            <div class="main-login main-center">
                <div id="ttn">
                    <img src="img/logo.png" class="img-responsive" alt="Новая Почта">
                    <h1>CОЗДАТЬ ТТН</h1>
                </div>

                <form method="post" action="src/create.php" id="formNp">
                    
                    <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">ФИО</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="name" id="name"  placeholder="Введите ФИО">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="cols-sm-2 control-label">Номер Телефон</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="phone" id="phone"  placeholder="Введите Номер Телефона">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Order[city]" class="cols-sm-2 control-label">Город</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" aria-hidden="true"></i></span>
                                <select id="select-city" name="Order[city]">
                                    <option value="null" disable>Выберите Город</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Order[secession]" class="cols-sm-2 control-label">Номер Отделения</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
                                <select id="select-secession" name="Order[secession]">
                                    <option value="null" disable>Выберите Отделение</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weight" class="cols-sm-2 control-label">Вес Посылки</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-saved" aria-hidden="true"></i></span>
                                <input type="number" class="form-control" name="weight" id="weight" step="any" placeholder="Введите Вес Посылки">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cost" class="cols-sm-2 control-label">Цена</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-eur" aria-hidden="true"></i></span>
                                <input type="number" class="form-control" name="cost" id="cost" step="any" placeholder="Введите Цену">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group ">
                        <input type="submit" class="btn btn-light btn-lg btn-block login-button" name="submit" id="submit" value="Создать">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Website JS script -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>         
    <script src="js/script.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/select2_ru.js"></script>
    <script src="js/np.js"></script>


</body>
</html>