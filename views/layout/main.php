<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="/layout.css" type="text/css" rel="stylesheet">
    <title><?= $Title; ?></title>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<header>
    <nav class="navbar navbar-default navbar-fixed-top my_navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#myPage">ГОЛОВНА</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="\site\courses">КУРСИ</a></li>
                    <?php if ($_SESSION['user'] == null) { ?>
                    <li><a href="#" data-toggle="modal" data-target="#myAuthorization">АВТОРИЗАЦІЯ</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myRegister">РЕЄСТРАЦІЯ</a></li>
                    <?php } else { ?>
                        <?php if ($_SESSION['user']['role'] == '3') { ?>
                        <li><a href="\student\" >КАБІНЕТ</a></li>
                        <?php } ?>
                        <?php if ($_SESSION['user']['role'] == '2') { ?>
                            <li><a href="\teacher\" >КАБІНЕТ</a></li>
                        <?php } ?>
                        <?php if ($_SESSION['user']['role'] == '1') { ?>
                            <li><a href="\admin\" >КАБІНЕТ</a></li>
                        <?php } ?>
                        <li><a href="\users\logout"  >ВИХІД</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

<!-- Зареєструватись   ------------->
    <div id="myRegister" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Реєстрація</h4>
                </div>
                <div class="modal-body">
                    <span class="error-message-sign">

                    </span>
                    <form method="post" class="login-form" action="">
                    <div class="row mb-3" >
                        <label for="inputFirstname" class="col-sm-2 col-form-label">Ім'я</label>
                        <div class="col-sm-10">
                            <input type="text" style="margin-bottom: 10px" class="form-control " id="inputFirstname">
                        </div>
                        <label for="inputLastname" class="col-sm-2 col-form-label">Прізвище</label>
                        <div class="col-sm-10">
                            <input type="text" style="margin-bottom: 10px" class="form-control" id="inputLastname">
                        </div>
                        <label for="inputDate" class="col-sm-4 col-form-label">Дата народження</label>
                        <div class="col-sm-8">
                            <input type="date" style="margin-bottom: 10px" class="form-control" id="inputDate">
                        </div>
                        <label for="inputGender" class="col-sm-4 col-form-label">Стать</label>
                        <div class="col-sm-8">
                            <input type="radio" checked name="gender" id="inputGenderM" value="Ч">
                            <label style="margin-right: 5px;" for="inputGenderM" >Чоловіча</label>
                            <input type="radio" name="gender" id="inputGenderW" value="Ж">
                            <label style="padding-right: 5px;" for="inputGenderW">Жіноча</label>
                        </div>
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input style="margin-bottom: 10px" type="email" class="form-control " id="inputEmail">
                        </div>
                        <label for="inputPhone" class="col-sm-2 col-form-label">Телефон</label>
                        <div class="col-sm-10">
                            <input style="margin-bottom: 10px" type="text" class="form-control" value="+380" id="inputPhone">
                        </div>
                        <label for="inputGender" class="col-sm-4 col-form-label">Зареєструватися як:</label>
                        <div class="col-sm-8">
                            <input type="radio" checked name="role" id="inputTeacher" value="2">
                            <label style="margin-right: 5px;"  for="inputTeacher" >Викладач</label>
                            <input type="radio" name="role" id="inputStudent" value="3">
                            <label style="padding-right: 5px;" for="inputStudent">Студент</label>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="password" style="margin-bottom: 10px" class="form-control " id="inputPassword">
                        </div>
                        <label for="passwordRepeat" class="col-sm-4 col-form-label">Повторіть пароль</label>
                        <div class="col-sm-8">
                            <input type="password" style="margin-bottom: 10px" class="form-control " id="passwordRepeat">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" id="login-form" type="button">Зареєструватися</button>
                </div>
                </form>

            </div>
        </div>
    </div>


<!-- Авторизація   ------------->
    <div id="myAuthorization" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Вхід</h4>
                </div>
                <span class="error-message-auth">

                </span>
                <div class="modal-body">
                    <form method="post" class="auth-form" action="">
                        <div class="row mb-3" >
                            <label for="AuthEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input style="margin-bottom: 10px" type="email" class="form-control" id="AuthEmail">
                            </div>

                            <label for="AuthPassword" class="col-sm-2 col-form-label">Пароль</label>
                            <div class="col-sm-10">
                                <input type="password" style="margin-bottom: 10px" class="form-control " id="AuthPassword">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" id="auth-form" type="button">Вхід</button>
                </div>
                </form>

            </div>
        </div>
    </div>

</header>

<main>
    <?= $Content ?>
</main>


<footer class="container-fluid text-center my_navbar">
    <p style="margin-top: 10px">IPZ-19-1</p>
</footer>

</body>

</html>


<script>
    $(document).ready(function () {
        $('#login-form').click(function (event) {
            $('.message-sign').remove();
            var formData = {
                name: $('#inputFirstname').val(),
                surname: $('#inputLastname').val(),
                email: $('#inputEmail').val(),
                password: $('#inputPassword').val(),
                passwordRepeat: $('#passwordRepeat').val(),
                telephone: $('#inputPhone').val(),
                gender: $("input[name=gender]:checked").val(),
                date_birth: $('#inputDate').val(),
                role: $("input[name=role]:checked").val(),
                submit: 'submit',
            };
            console.log(formData)
            $.ajax({
                url: "/users/registration",
                method: "POST",
                data: formData,
                success: function (item) {
                    var msg = JSON.parse(item);
                    console.log(msg);
                    if(msg['message'] === 'true'){
                        $('.login-form')[0].reset()
                        $('.error-message-sign').append("<div class='alert alert-success text-center message-sign' role='alert'>" + msg['error'] + "</div>");
                    }else if(msg['message'] === 'false' || msg['message'] === 'error'){
                        $('.error-message-sign').append("<div class='alert alert-danger text-center message-sign' role='alert'>" + msg['error'] + "</div>");
                    }
                }
            });
        });
    });


    $(document).ready(function () {
        $('#auth-form').click(function (event){
            $('.message-sign-auth').remove();
            var formData = {
                email:  $('#AuthEmail').val(),
                password:  $('#AuthPassword').val()
            };
            console.log(formData);
            $.ajax({
                url:"/users/auth",
                method: "POST",
                data: formData,
                success: function (item){
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg['message'] === 'false' || msg['message'] === 'error'){
                        $('.error-message-auth').append("<div class='alert alert-danger text-center message-sign-auth' role='alert'>" + "Перевірте логін та пароль" + "</div>");
                    } else {
                        location.reload();
                    }
                }
            });
        });
    });





</script>




