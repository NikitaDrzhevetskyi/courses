<h2 >Створення курсу</h2>
<span class="upd-msg">

                    </span>
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="courseName" class="col-sm-2 col-form-label">Назва</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="courseName" value="">
        </div>

        <label for="courseLevel" class="col-sm-2 col-form-label">Рівень</label>
        <div class="col-sm-12">
       <select  class="form-control courseLevel" id="courseLevel">
            <?php foreach ($params['levels'] as $el) { ?>
                    <option value="<?php echo $el['id']; ?>"><?php echo $el['name']; ?></option>
            <?php } ?>
       </select>
        </div>

        <label for="courseLanguage" class="col-sm-2 col-form-label">Мова</label>
        <div class="col-sm-12">
        <select  class="courseLevel form-control" id="courseLanguage">
            <?php foreach ($params['languages'] as $el) { ?>
                    <option value="<?php echo $el['id']; ?>"><?php echo $el['name']; ?></option>
            <?php } ?>
        </select>
        </div>

        <label for="courseCategory" class="col-sm-2 col-form-label">Категорія</label>
        <div class="col-sm-12">
        <select  class="courseLevel form-control" id="courseCategory">
            <?php foreach ($params['categories'] as $el) { ?>
                    <option value="<?php echo $el['id']; ?>"><?php echo $el['name']; ?></option>
            <?php } ?>
        </select>
        </div>

        <label for="courseLessons" class="col-sm-2 col-form-label">Занять</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="courseLessons"  value="">
        </div>

        <label for="coursePrice" class="col-sm-2 col-form-label">Ціна</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="coursePrice"  value="">
        </div>

        <label for="courseDescription" class="col-sm-2 col-form-label">Опис</label>
        <div class="col-sm-12">
            <textarea class="form-control" id="courseDescription"></textarea>
        </div>

        <label for="courseActive" class="col-sm-2 col-form-label">Етап</label>
        <div class="col-sm-12">
        <select  class=" form-control courseActive" id="courseActive">
            <option value="0">Ще не почався</option>
            <option value="1">Триває</option>
            <option value="2">Завершився</option>
            <option value="3">Приховати</option>
        </select>
        </div>

        <label for="courseStart" class="col-sm-2 col-form-label">Початок</label>
        <div class="col-sm-12">
            <input type="date" style="margin-bottom: 10px" class="form-control" id="courseStart"  value="">
        </div>

        <label for="courseFinish" class="col-sm-2 col-form-label">Кінець</label>
        <div class="col-sm-12">
            <input type="date" style="margin-bottom: 10px" class="form-control" id="courseFinish"  value="">
        </div>

        <div class="col-sm-12">
        <button class="btn btn-default" style="float: right" id="update-form" type="button">Додати</button>
        </div>
    </div>
</form>
<br><br>


<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {
            var formData = {
                name: $('#courseName').val(),
                level: $('#courseLevel').val(),
                language: $('#courseLanguage').val(),
                category: $('#courseCategory').val(),
                lessons: $("#courseLessons").val(),
                is_active: $('#courseActive').val(),
                price: $('#coursePrice').val(),
                start: $('#courseStart').val(),
                finish: $('#courseFinish').val(),
                description: $('#courseDescription').val(),
                submit: 'submit',
            };
            console.log(formData);
            $.ajax({
                url: "/admin/CreateCourseAjax",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg === true){
                        $('.message-upd').remove();
                        $('.upd-msg').append("<div class='alert alert-success text-center message-upd' role='alert'>" + 'Курс було додано' + "</div>");
                    }else{
                        $('.message-upd').remove();
                        $('.upd-msg').append("<div class='alert alert-danger text-center message-upd' role='alert'>" + 'Помилка' + "</div>");
                    }
                }
            });
        });
    });
</script>