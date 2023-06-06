
<span class="upd-msg">
</span>
<h2 id="<?= $enrollment['id_student']?>"><?= $enrollment['first_name']?> <?= $enrollment['last_name']?> </h2>
<form id="<?= $enrollment['id_course']?>" style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="inputPaymente" class="col-sm-2 col-form-label">Сума оплати</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="inputPayment" value="<?= $enrollment['payment']?>">
        </div>

        <label for="inputDate" class="col-sm-4 col-form-label">Дата оплати</label>
        <div class="col-sm-12">
            <input type="datetime-local" style="margin-bottom: 10px" class="form-control" id="inputDate" value="<?= $enrollment['date_payment']?>">
        </div>
        <label for="inputTypePayment" class="col-sm-4 col-form-label">Тип оплати</label>
        <div class="col-sm-12">
            <input type="radio" <?php if($enrollment['type_payment'] == "0" ) { echo 'checked'; } ?>  name="type" id="inputTypePayment1" value="0">
            <label style="margin-right: 5px;" for="inputTypePayment1">Готівкою</label>
            <input type="radio" name="type" <?php if($enrollment['type_payment'] == "1" ) { echo 'checked'; } ?>  id="inputTypePayment2" value="1">
            <label style="padding-right: 5px;" for="inputTypePayment2">Карткою</label>
        </div>
        <label for="courseSuccess" class="col-sm-2 col-form-label">Зарахування</label>
        <div class="col-sm-12">
            <select  class="courseSuccess form-control" id="courseSuccess">
                <option value="0" <?php if($enrollment['success'] == 0) { echo "selected";}?> >Відраховано</option>
                <option value="1" <?php if($enrollment['success'] == 1) { echo "selected";}?> >Зараховано</option>
                <option value="2" <?php if($enrollment['success'] == 2) { echo "selected";}?> >Чекає підтвердження</option>
            </select>
        </div>
        <div class="col-sm-12">
        <button class="btn btn-default" style="float: right"  id="update-form" type="button">Зареєструватися</button>
        </div>
    </div>
</form>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script>

    $(document).ready(function () {
        $('#update-form').click(function (event) {

            var formData = {
                user_id: $('h2').attr('id'),
                success: $('#courseSuccess').val(),
                date_payment: $('#inputDate').val(),
                payment: $('#inputPayment').val(),
                type_payment: $("input[name=type]:checked").val(),
                id_course: $('form').attr('id'),
                submit: 'submit',
            };
            console.log(formData);
            $.ajax({
                url: "/admin/Ajaxupdateenrollment",
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