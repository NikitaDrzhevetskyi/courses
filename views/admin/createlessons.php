<h2 id="<?php echo $course['course_id']; ?>">Додавання уроку</h2>
<span class="upd-msg">

                    </span>
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">

        <label for="courseName" class="col-sm-2 col-form-label">Назва</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="courseName" value="">
        </div>

        <label for="course" class="col-sm-2 col-form-label">Курс</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " disabled id="courseName" value="<?php echo $course['name']; ?>">
        </div>
        <label for="course" class="col-sm-2 col-form-label">Викладач</label>
        <div class="col-sm-12">
        <select class="courseTeacher form-control" id="courseTeacher">
            <?php foreach ($teachers as $el) { ?>
                <option value="<?php echo $el['user_id']; ?>"><?php echo $el['first_name']; ?> <?php echo $el['last_name'];?></option>
            <?php } ?>
        </select>
        </div>

        <label for="courseLink" class="col-sm-2 col-form-label">Посилання</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="courseLink" value="">
        </div>


        <label for="courseType" class="col-sm-2 col-form-label">Тип</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="courseType"  value="">
        </div>

        <label for="courseDescription" class="col-sm-2 col-form-label">Опис</label>
        <div class="col-sm-12" >
            <textarea class="form-control" id="courseDescription"></textarea>
        </div>


        <label for="courseStart" class="col-sm-2 col-form-label ">Початок</label>
        <div class="col-sm-12">
            <input type="datetime-local" style="margin-bottom: 10px" class="form-control" id="courseStart"  value="">
        </div>

        <label for="courseFinish" class="col-sm-2 col-form-label ">Кінець</label>
        <div class="col-sm-12">
            <input type="datetime-local" style="margin-bottom: 10px" class="form-control form-control" id="courseFinish"  value="">
        </div>
        <div class="col-sm-12">
        <button class="btn btn-default" id="update-form" style="float: right" type="button">Зберегти зміни</button>
        </div>
    </div>
</form>

<br><br><br><br><br><br>


<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {
            var formData = {
                name: $('#courseName').val(),
                link: $('#courseLink').val(),
                type: $('#courseType').val(),
                start: $('#courseStart').val(),
                finish: $('#courseFinish').val(),
                id_course: $('h2').attr('id'),
                id_teacher: $('#courseTeacher').val(),
                description: $('#courseDescription').val(),
                submit: 'submit',
            };
            console.log(formData);
            $.ajax({
                url: "/admin/createLessonsAjax",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg){
                        // $('.message-upd').remove();
                        // $('.upd-msg').append("<div class='alert alert-success text-center message-upd' role='alert'>" + 'Зміни були успішно збережені' + "</div>");
                        alert('Успіх')
                    }else{
                        // $('.message-upd').remove();
                        // $('.upd-msg').append("<div class='alert alert-danger text-center message-upd' role='alert'>" + msg + "</div>");
                        alert('Помилка')
                    }
                }
            });
        });
    });
</script>