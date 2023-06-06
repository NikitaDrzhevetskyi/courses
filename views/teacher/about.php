<h1 style="margin-top: 47px; margin-left: 50px; ">Редагування особистих даних</h1>
<!--<span class="upd-msg">-->
<!---->
<!--</span>-->
<br>
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="inputFirstname" class="col-sm-2 col-form-label">Ім'я</label>
        <div class="col-sm-10">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="inputFirstname" value="<?= $user_info['first_name']?>">
        </div>
        <label for="inputLastname" class="col-sm-2 col-form-label">Прізвище</label>
        <div class="col-sm-10">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="inputLastname"  value="<?= $user_info['last_name']?>">
        </div>
        <label for="inputDate" class="col-sm-4 col-form-label">Дата народження</label>
        <div class="col-sm-8">
            <input type="date" style="margin-bottom: 10px" class="form-control" id="inputDate" value="<?= $user_info['date_birth']?>">
        </div>
        <label for="inputGender" class="col-sm-4 col-form-label">Стать</label>
        <div class="col-sm-8">

            <input type="radio" <?php if($user_info['gender'] == "Ч" ) { echo 'checked'; } ?>  name="gender" id="inputGenderM" value="Ч">
            <label style="margin-right: 5px;" for="inputGenderM">Чоловіча</label>
            <input type="radio" name="gender" <?php if($user_info['gender'] == "Ж" ) { echo 'checked'; } ?>  id="inputGenderW" value="Ж">
            <label style="padding-right: 5px;" for="inputGenderW">Жіноча</label>
        </div>
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input style="margin-bottom: 10px" type="email" class="form-control " id="inputEmail"  value="<?= $user_info['email']?>">
        </div>
        <label for="inputPhone" class="col-sm-2 col-form-label">Телефон</label>
        <div class="col-sm-10">
            <input style="margin-bottom: 10px" type="text" class="form-control"  value="<?= $user_info['telephone']?>" id="inputPhone">
        </div>
        <label for="inputPassword" class="col-sm-2 col-form-label">Пароль</label>
        <div class="col-sm-10">
            <input type="password" style="margin-bottom: 10px" class="form-control " id="inputPassword">
        </div>
        <label for="passwordRepeat" class="col-sm-2 col-form-label">Повторіть пароль</label>
        <div class="col-sm-10">
            <input type="password" style="margin-bottom: 10px" class="form-control " id="passwordRepeat">
        </div>
        <label for="inputPassword" class="col-sm-2 col-form-label">Дата та час реєстрації:</label>
        <div class="col-sm-10">
           <p><?= $user_info['date']?></p>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-default" style=" float: right" id="update-form" type="button">Зберегти</button>
        </div>

    </div>
</form>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {

            var formData = {
                name: $('#inputFirstname').val(),
                surname: $('#inputLastname').val(),
                email: $('#inputEmail').val(),
                password: $('#inputPassword').val(),
                passwordRepeat: $('#passwordRepeat').val(),
                telephone: $('#inputPhone').val(),
                gender: $("input[name=gender]:checked").val(),
                date_birth: $('#inputDate').val(),
                submit: 'submit',
            };
            $.ajax({
                url: "/users/update",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg === true){
                        // $('.message-upd').remove();
                        // $('.upd-msg').append("<div class='alert alert-success text-center message-upd' role='alert'>" + 'Зміни були успішно збережені' + "</div>");
                        alert('Зміни були успішно збережені')
                    }else{
                        // $('.message-upd').remove();
                        // $('.upd-msg').append("<div class='alert alert-danger text-center message-upd' role='alert'>" + msg + "</div>");
                        alert(msg)
                    }
                }
            });
        });
    });
</script>