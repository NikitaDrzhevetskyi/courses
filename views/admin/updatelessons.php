<h2 id="<?php print_r($lessons['lessons_id']); ?>">Редагування уроку</h2>
<span class="upd-msg">

                    </span>
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">

        <label for="courseName" class="col-sm-2 col-form-label">Назва</label>
        <div class="col-sm-10">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="courseName" value="<?= $lessons['lessons_name']; ?>">
        </div>

        <label for="courseLink" class="col-sm-2 col-form-label">Посилання</label>
        <div class="col-sm-10">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="courseLink" value="<?= $lessons['link']; ?>">
        </div>


        <label for="courseType" class="col-sm-2 col-form-label">Тип</label>
        <div class="col-sm-10">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="courseType"  value="<?= $lessons['type']; ?>">
        </div>

        <label for="courseDescription" class="col-sm-2 col-form-label">Опис</label>
        <div class="col-sm-10" >
            <textarea id="courseDescription"><?= $lessons['description']; ?></textarea>
        </div>


        <label for="courseStart" class="col-sm-2 col-form-label">Початок</label>
        <div class="col-sm-10">
            <input type="datetime-local" style="margin-bottom: 10px" class="form-control" id="courseStart"  value="<?= $lessons['start']; ?>">
        </div>

        <label for="courseFinish" class="col-sm-2 col-form-label">Кінець</label>
        <div class="col-sm-10">
            <input type="datetime-local" style="margin-bottom: 10px" class="form-control" id="courseFinish"  value="<?= $lessons['finish']; ?>">
        </div>

        <button class="btn btn-default" id="update-form" type="button">Зберегти зміни</button>
    </div>
</form>



<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {
            var formData = {
                name: $('#courseName').val(),
                link: $('#courseLink').val(),
                type: $('#courseType').val(),
                start: $('#courseStart').val(),
                finish: $('#courseFinish').val(),
                description: $('#courseDescription').val(),
                id: $('h2').attr('id'),
                submit: 'submit',
            };
            console.log(formData);
            $.ajax({
                url: "/admin/UpdateLessonsAjax",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg === true){
                        $('.message-upd').remove();
                        $('.upd-msg').append("<div class='alert alert-success text-center message-upd' role='alert'>" + 'Зміни були успішно збережені' + "</div>");
                    }else{
                        $('.message-upd').remove();
                        $('.upd-msg').append("<div class='alert alert-danger text-center message-upd' role='alert'>" + msg + "</div>");
                    }
                }
            });
        });
    });
</script>