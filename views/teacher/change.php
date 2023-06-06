<h1>Редагування уроку</h1>
<!--<span class="upd-msg">-->
<!---->
<!--                    </span>-->
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="inputDateStart" class="col-sm-4 col-form-label">Початок</label>
        <div class="col-sm-8">
            <input type="datetime-local" style="margin-bottom: 10px" class="form-control" id="inputDateStart" value="<?= $lessons['start']?>">
        </div>
        <label for="inputDateFinish" class="col-sm-4 col-form-label">Кінець</label>
        <div class="col-sm-8">
            <input type="datetime-local" style="margin-bottom: 10px" class="form-control" id="inputDateFinish" value="<?= $lessons['finish']?>">
        </div>

        <label for="inputType" class="col-sm-2 col-form-label">Тип</label>
        <div class="col-sm-10">
            <input style="margin-bottom: 10px" type="text" class="form-control " id="inputType"  value="<?= $lessons['type']?>">
        </div>

        <label for="inputLink" class="col-sm-2 col-form-label">Посилання</label>
        <div class="col-sm-10">
            <input style="margin-bottom: 10px" type="text" class="form-control " id="inputLink"  value="<?= $lessons['link']?>">
        </div>

        <label for="inputDescription" class="col-sm-2 col-form-label">Опис</label>
        <div class="col-sm-10">
            <textarea  id="inputDescription" class="form-control"><?= $lessons['description'] ?></textarea>
        </div>
        <div class="col-sm-12">
        <button class="btn btn-default" style="float: right" id="update-form" value="<?= $lessons['id'] ?>" type="button">Зберегти зміни</button>
        </div>
    </div>
</form>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {

            var formData = {
                id: $('#update-form').val(),
                start: $('#inputDateStart').val(),
                finish: $('#inputDateFinish').val(),
                type: $('#inputType').val(),
                link: $('#inputLink').val(),
                description: $('#inputDescription').val(),
                submit: 'submit',
            };
            $.ajax({
                url: "/teacher/updatelesson",
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