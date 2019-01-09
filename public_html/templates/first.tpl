<!DOCTYPE HTML>
<html lang="en">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- shrink-to-fit=no">    -->
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <script src="/assets/js/jq331.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://vk.com/js/api/xd_connection.js?2" type="text/javascript"></script>
    <script src="/assets/js/main.js" type="text/javascript"></script>
    <title>ШКОЛА ВОЛЕЙБОЛА КАЗАНЬ</title>
</head>

<body>
    <div class="adminbutton">{ADMINBUTTON}</div>
    <div id="exTab2" class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Тренировки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Новости</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Аренда</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="height: 800px; overflow-y: scroll">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                {TRAINING_ROOM_TABLE}
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">{NEWS}</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">{rent}</div>
            <hr>
            </hr>
            {MODAL}
            {FINDFRIENDS}
</body>

</html>