<h2 id="<?= $user_info['id']?>">Оновлення даних про користувача</h2>
<span class="upd-msg">

                    </span>
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="inputFirstname" class="col-sm-2 col-form-label">Ім'я</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="inputFirstname" value="<?= $user_info['first_name']?>">
        </div>
        <label for="inputLastname" class="col-sm-2 col-form-label">Прізвище</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="inputLastname"  value="<?= $user_info['last_name']?>">
        </div>
        <label for="inputDate" class="col-sm-4 col-form-label">Дата народження</label>
        <div class="col-sm-12">
            <input type="date" style="margin-bottom: 10px" class="form-control" id="inputDate" value="<?= $user_info['date_birth']?>">
        </div>
        <label for="inputGender" class="col-sm-4 col-form-label">Стать</label>
        <div class="col-sm-12">

            <input type="radio" <?php if($user_info['gender'] == "Ч" ) { echo 'checked'; } ?>  name="gender" id="inputGenderM" value="Ч">
            <label style="margin-right: 5px;" for="inputGenderM">Чоловіча</label>
            <input type="radio" name="gender" <?php if($user_info['gender'] == "Ж" ) { echo 'checked'; } ?>  id="inputGenderW" value="Ж">
            <label style="padding-right: 5px;" for="inputGenderW">Жіноча</label>
        </div>
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-12">
            <input style="margin-bottom: 10px" type="email" class="form-control " id="inputEmail"  value="<?= $user_info['email']?>">
        </div>
        <label for="inputPhone" class="col-sm-2 col-form-label">Телефон</label>
        <div class="col-sm-12">
            <input style="margin-bottom: 10px" type="text" class="form-control"  value="<?= $user_info['telephone']?>" id="inputPhone">
        </div>
        <label for="inputRole" class="col-sm-2 col-form-label">Роль</label>
        <div class="col-sm-12">
        <select  class="userInfo form-control" id="userRole">
        <option value="1" <?php if($user_info['role'] == '1') { echo 'selected';} ?>>Адміністатор</option>
        <option value="2" <?php if($user_info['role'] == '2') { echo 'selected';} ?>>Викладач</option>
        <option value="3" <?php if($user_info['role'] == '3') { echo 'selected';} ?>>Студент</option>
        </select>
        </div>
        <div class="col-sm-12">
        <button class="btn btn-default" id="update-form" style="float: right" type="button">Зберегти зміни</button>
        </div>
    </div>
</form>
<br><br><br><br><br><br><br><br><br>
<br><br>
<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {

            var formData = {
                name: $('#inputFirstname').val(),
                surname: $('#inputLastname').val(),
                email: $('#inputEmail').val(),
                telephone: $('#inputPhone').val(),
                gender: $("input[name=gender]:checked").val(),
                date_birth: $('#inputDate').val(),
                role: $('#userRole').val(),
                id: $('h2').attr('id'),
                submit: 'submit',
            };

            console.log(formData);
            $.ajax({
                url: "/users/updatewithrole",
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