<!DOCTYPE HTML>
<html lang="en">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <script src="/assets/js/jq331.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>ШКОЛА ВОЛЕЙБОЛА КАЗАНЬ</title>
</head>

<body>
    <div class="adminbutton"><input type="button" class="btn btn-link" value="Клиентская часть" onclick="history.back()"></div>
    <div id="exTab2" class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="trainers-tab" data-toggle="tab" href="#trainers" role="tab" aria-controls="trainers" aria-selected="true">Тренера</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="training_details-tab" data-toggle="tab" href="#training_details" role="tab" aria-controls="training_details" aria-selected="false">Детализация тренировок</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="#volley_rooms-tab" data-toggle="tab" href="#volley_rooms" role="tab" aria-controls="volley_rooms" aria-selected="false">Спортивные залы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="trainings-tab" data-toggle="tab" href="#trainings" role="tab" aria-controls="trainings" aria-selected="false">Тренировки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="messages_list-tab" data-toggle="tab" href="#messages_list" role="tab" aria-controls="messages_list" aria-selected="false">Список рассылок</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="analitik-tab" data-toggle="tab" href="#analitik" role="tab" aria-controls="analitik" aria-selected="false">Аналитика</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="news" aria-selected="false">Новости</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="admins-tab" data-toggle="tab" href="#admins" role="tab" aria-controls="admins" aria-selected="false">Администраторы</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="trainers" role="tabpanel" aria-labelledby="trainers-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Имя</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {TABLETRAINERS}
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="training_details" role="tabpanel" aria-labelledby="training_details-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {TABLELEVEL}
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="volley_rooms" role="tabpanel" aria-labelledby="volley_rooms-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {TABROOM}
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="trainings" role="tabpanel" aria-labelledby="trainings-tab">
                <table class="table table-striped">
                    <thead>
                        <tr><th scope="col">День недели</th>
                            <th scope="col">Название</th>
                            <th scope="col">Адресс</th>
                            <th scope="col">Время</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Кол. участников</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {TABTRAINING}
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="messages_list" role="tabpanel" aria-labelledby="messages_list-tab"></div>
            <div class="tab-pane fade" id="analitik" role="tabpanel" aria-labelledby="analitik-tab"></div>
            <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="mews-tab">
                <thead>
                    <tr>
                        <th scope="col">Новость</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <div class="row">
                        {NEWS}
                    </div>
                </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="admins" role="tabpanel" aria-labelledby="admins-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Имя</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {TABROOT}
                    </tbody>
                </table>
            </div>
            <hr>
            </hr>
            {TRAINERMODALS}
            {LEVELMODALS}
            {ROOMMODALS}
            {ROOOTMODALS}
            {NEWSMODALS}
            {TRAININGSMODAL}
            <script src="/assets/js/adm.js" type="text/javascript"></script>
</body>

</html>