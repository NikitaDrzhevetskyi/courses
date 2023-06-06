<h2 id="<?= $course['id']?>">Редагування</h2>

<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="courseName" class="col-sm-2 col-form-label">Назва</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="courseName" value="<?= $course['name']?>">
        </div>

        <label for="courseLevel" class="col-sm-2 col-form-label">Рівень</label>
        <div class="col-sm-12">
        <select  class="courseLevel form-control" id="courseLevel">
            <?php foreach ($params['levels'] as $el) { ?>
                <?php if($el['name'] == $course['level']) { ?>
                    <option value="<?php echo $el['id']; ?>" selected ><?php echo $el['name']; ?></option>
                <?php } else {?>
                    <option value="<?php echo $el['id']; ?>"><?php echo $el['name']; ?></option>
                <?php } ?>
            <?php } ?>
       </select>
        </div>

        <label for="courseLanguage" class="col-sm-2 col-form-label">Мова</label>
        <div class="col-sm-12">
        <select  class="courseLevel form-control" id="courseLanguage">
            <?php foreach ($params['languages'] as $el) { ?>
                <?php if($el['name'] == $course['language']) { ?>
                    <option value="<?php echo $el['id']; ?>" selected ><?php echo $el['name']; ?></option>
                <?php } else {?>
                    <option value="<?php echo $el['id']; ?>"><?php echo $el['name']; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
        </div>

        <label for="courseCategory" class="col-sm-2 col-form-label">Категорія</label>
        <div class="col-sm-12">
        <select  class="courseLevel form-control" id="courseCategory">
            <?php foreach ($params['categories'] as $el) { ?>
                <?php if($el['name'] === $course['category']) { ?>
                    <option value="<?php echo $el['id']; ?>" selected ><?php echo $el['name']; ?></option>
                <?php } else {?>
                    <option value="<?php echo $el['id']; ?>"><?php echo $el['name']; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
        </div>

        <label for="courseLessons" class="col-sm-2 col-form-label">Занять</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="courseLessons"  value="<?= $course['lessons']?>">
        </div>

        <label for="coursePrice" class="col-sm-2 col-form-label">Ціна</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="coursePrice"  value="<?= $course['price']?>">
        </div>

        <label for="courseDescription" class="col-sm-2 col-form-label">Опис</label>
        <div class="col-sm-12" >
            <textarea class="form-control" id="courseDescription"><?= $course['description']?></textarea>
        </div>


        <label for="courseActive" class="col-sm-2 col-form-label">Етап</label>
        <div class="col-sm-12">
        <select   class="courseActive form-control" id="courseActive">
            <option value="0" <?php if($course['active'] == 0) { echo "selected";}?> >Ще не почався</option>
            <option value="1" <?php if($course['active'] == 1) { echo "selected";}?> >Триває</option>
            <option value="2" <?php if($course['active'] == 2) { echo "selected";}?> >Завершився</option>
            <option value="3" <?php if($course['active'] == 3) { echo "selected";}?> >Приховати</option>
        </select>
        </div>

        <label for="courseStart" class="col-sm-2 col-form-label">Початок</label>
        <div class="col-sm-12">
            <input type="date" style="margin-bottom: 10px" class="form-control" id="courseStart"  value="<?= $course['start']?>">
        </div>

        <label for="courseFinish" class="col-sm-2 col-form-label">Кінець</label>
        <div class="col-sm-12">
            <input type="date" style="margin-bottom: 10px" class="form-control" id="courseFinish"  value="<?= $course['finish']?>">
        </div>
        <div class="col-sm-12">
        <button class="btn btn-default" style="float: right" id="update-form" type="button">Зберегти зміни</button>
        </div>
    </div>
</form>



<h3>Студенти</h3>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Cторінка</td>
            <td>Ім'я</td>
            <td>Прізвище</td>
            <td>Стать</td>
            <td>Дата народження</td>
            <td>Телефон</td>
            <td>Email</td>
            <td>Змінити</td>
        </tr>
        <tr>
            <td>
                <select  class="userInfo form-control" id="Page">
                    <?php for ($i = 0; $i < $user_info['count']['count']/5; $i++){ ?>
                        <?php if ($i === 0){ ?>
                            <option value="1" selected><?php echo $i+1; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
                        <?php } ?>
                    <?php } ?>
            </td>
            <td><input type="text" class="userInfo form-control" id="userName"></td>
            <td><input type="text" class="userInfo form-control" id="userSurname"></td>
            <td>
                <select  class="userInfo form-control" id="userGender">
                    <option value="" selected></option>
                    <option value="Ж">Ж</option>
                    <option value="Ч">Ч</option>
            </td>
            <td><input type="date" class="userInfo form-control" id="userBirthday" ></td>
            <td><input type="text" class="userInfo form-control" id="userTelephone" value="+380"></td>
            <td><input type="text" class="userInfo form-control" id="userEmail"></td>
            <td></td>
        </tr>
        <tbody id="tbodyStud">

        <?php if ($user_info['users'] != null) { ?>
            <?php foreach ($user_info['users'] as $el) { ?>
                <tr class="text-center" style="background-color: <?php if($el['active'] == '1') { echo 'lightblue'; } else if( $el['active'] == '0') { echo 'red';  }; ?>" >
                    <td></td>
                    <td><?php echo $el['first_name']; ?></td>
                    <td><?php echo $el['last_name']; ?></td>
                    <td><?php echo $el['gender']; ?></td>
                    <td><?php echo $el['date_birth']; ?></td>
                    <td><?php echo $el['telephone']; ?></td>
                    <td><?php echo $el['email']; ?></td>
                    <td><a href="/admin/updateenrl?stud=<?php echo $el['id_student']; ?>&course=<?php echo $course['id']; ?>">?</td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>


<h3>Заняття</h3><a href="/admin/addlessons?course_id=<?php echo $course['id']; ?>&name=<?= $course['name']?>">Додати заняття</a>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Cторінка</td>
            <td>Назва</td>
            <td>Ім'я</td>
            <td>Прізвище</td>
            <td>Початок</td>
            <td>Кінець</td>
            <td>Тип</td>
            <td>Змінити</td>
            <td>Видалити</td>
        </tr>
        <tr>
            <td>
                <select  class="lessonsInfo form-control" id="Page">
                    <?php for ($i = 0; $i < $lessons['count']['count']/5; $i++){ ?>
                        <?php if ($i === 0){ ?>
                            <option value="1" selected><?php echo $i+1; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
                        <?php } ?>
                    <?php } ?>
            </td>
            <td></td>
            <td><input type="text" class="lessonsInfo form-control" id="lessonsFirstname"></td>
            <td><input type="text" class="lessonsInfo form-control" id="lessonsSurname"></td>
            <td><input type="date" class="lessonsInfo form-control" id="lessonsStart" ></td>
            <td><input type="date" class="lessonsInfo form-control" id="lessonsFinish" ></td>
            <td><input type="text" class="lessonsInfo form-control" id="lessonsType"></td>
            <td></td>
            <td></td>
        </tr>
        <tbody id="tLessons">
        <?php if ($lessons['users'] != null) { ?>
            <?php foreach ($lessons['users'] as $el) { ?>
                <tr class="text-center" style="background-color: <?php if($el['active'] == '1') { echo 'lightblue'; } else if( $el['active'] == '0') { echo 'red';  }; ?>" >
                    <td></td>
                    <td><?php echo $el['lessons_name']; ?></td>
                    <td><?php echo $el['first_name']; ?></td>
                    <td><?php echo $el['last_name']; ?></td>
                    <td><?php echo $el['start']; ?></td>
                    <td><?php echo $el['finish']; ?></td>
                    <td><?php echo $el['type']; ?></td>
                    <td><a href="/admin/updatelessons?id=<?php echo $el['lessons_id']; ?>">?</td>
                    <td><a href="/admin/deletelessons?lesson=<?php echo $el['lessons_id']; ?>&course=<?= $course['id']?>">x</td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>


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
                id: $('h2').attr('id'),
                submit: 'submit',
            };
            console.log(formData);
            $.ajax({
                url: "/admin/updatecourse",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if (msg === true) {
                        // $('.message-upd').remove();
                        // $('.upd-msg').append("<div class='alert alert-success text-center message-upd' role='alert'>" + 'Зміни були успішно збережені' + "</div>");
                        alert('Зміни були успішно збережені')
                    } else {
                        // $('.message-upd').remove();
                        // $('.upd-msg').append("<div class='alert alert-danger text-center message-upd' role='alert'>" + msg + "</div>");
                        alert(msg)
                    }
                }
            });
        });
    });

    $(document).ready(function () {
        $('.userInfo').change(function (event) {
            var formData = {}

            if ($('#userName').val() !== "") {
                formData['first_name'] = $('#userName').val()
            }
            if ($('#userSurname').val() !== "") {
                formData['last_name'] = $('#userSurname').val()
            }
            if ($('#userGender').val() !== "") {
                formData['gender'] = $('#userGender').val()
            }
            if ($('#userBirthday').val() !== "") {
                formData['date_birth'] = $('#userBirthday').val()
            }
            if ($('#userTelephone').val() !== "") {
                formData['telephone'] = $('#userTelephone').val()
            }
            if ($('#userEmail').val() !== "") {
                formData['email'] = $('#userEmail').val()
            }
            if ($('#userRole').val() !== "") {
                formData['role'] = $('#userRole').val()
            }
            if ($('#userCreate').val() !== "") {
                formData['create'] = $('#userCreate').val()
            }
            if ($('#Page').val() !== "") {
                formData['page'] = $('#Page').val()
            }
            if (formData['page'] == null) {
                formData['page'] = '1';
            }

            formData['id_course'] = $('h2').attr('id')

            formData['submit'] = 'submit'

            console.log(formData);
            $.ajax({
                url: "/admin/AjaxUsersStudents",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var user = JSON.parse(item);
                    console.log(user);
                    $("#tbodyStud").children().remove();
                    console.log(Object.keys(user['users']).length);

                    var id_course = $('h2').attr('id');

                    for (var i = 0; i < Object.keys(user['users']).length; i++) {

                        if (user['users'][i]['role'] == '1') {
                            user['users'][i]['role'] = 'Admin'
                        } else if (user['users'][i]['role'] == '2') {
                            user['users'][i]['role'] = 'Викладач'
                        } else if (user['users'][i]['role'] == '3') {
                            user['users'][i]['role'] = 'Студент'
                        }
                        console.log(user['users'][i]['role']);
                        $("#tbodyStud").append("<tr class='tr text-center'><td></td><td>" + user['users'][i]['first_name'] + "</td><td>" + user['users'][i]['last_name'] + "</td><td>" + user['users'][i]['gender'] + "</td><td>" + user['users'][i]['date_birth']
                            + "</td><td>" + user['users'][i]['telephone'] + "</td><td>" + user['users'][i]['email'] + "</td><td>" + user['users'][i]['role'] + "</td><td>" + user['users'][i]['create_at'] + "</td><td><a href='/admin/updateuser?user=" + user['users'][i]['id_stud'] + "&course=" + id_course + "'>?</td></tr>")
                    }
                    $("#Page").children().remove();
                    for (var j = 0; j < user['count']['count'] / 5; j++) {
                        var tmp = j + 1;
                        if (tmp == user['page']) {
                            var id = 'page' + formData['page'];
                            $("#Page").append("<option selected id='" + id + "' value='" + tmp + "'>" + tmp + "</option>")
                        } else {
                            $("#Page").append("<option value='" + tmp + "'>" + tmp + "</option>")
                        }
                    }

                }

            });
        });
    });


    $(document).ready(function () {
        $('.lessonsInfo').change(function (event) {
            var formData = {}

            if ($('#lessonsFirstname').val() !== "") {
                formData['first_name'] = $('#lessonsFirstname').val()
            }
            if ($('#lessonsSurname').val() !== "") {
                formData['last_name'] = $('#lessonsSurname').val()
            }
            if ($('#lessonsStart').val() !== "") {
                formData['start'] = $('#lessonsStart').val()
            }
            if ($('#lessonsFinish').val() !== "") {
                formData['finish'] = $('#lessonsFinish').val()
            }
            if ($('#lessonsType').val() !== "") {
                formData['type'] = $('#lessonsType').val()
            }

            if ($('#Page').val() !== "") {
                formData['page'] = $('#Page').val()
            }
            if (formData['page'] == null) {
                formData['page'] = '1';
            }

            formData['id_course_lessons'] = $('h2').attr('id')

            formData['submit'] = 'submit'

            console.log(formData);

            $.ajax({
                url: "/admin/ajaxLessons",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var lessons = JSON.parse(item);
                    console.log(lessons);

                    $('#tLessons').children().remove();

                    var id_course = $('h2').attr('id');

                    for (var i = 0; i < Object.keys(lessons['users']).length; i++) {
                        console.log(lessons['users']);
                        $("#tLessons").append("<tr class='tr text-center'><td></td><td>" + lessons['users'][i]['lessons_name'] + "</td><td>" + lessons['users'][i]['first_name'] + "</td><td>" + lessons['users'][i]['last_name'] + "</td><td>" + lessons['users'][i]['start'] + "</td><td>" + lessons['users'][i]['finish']
                            + "</td><td>" + lessons['users'][i]['type'] + "</td><td> <a href='/admin/updatelessons?id=" + lessons['users'][i]['lessons_id'] + "&course=" + id_course + "'>" + "?" +  "</a></td></tr>")
                    }
                    $("#Page").children().remove();
                    for (var j = 0; j < lessons['count']['count'] / 5; j++) {
                        var tmp = j + 1;
                        if (tmp == lessons['page']) {
                            var id = 'page' + formData['page'];
                            $("#Page").append("<option selected id='" + id + "' value='" + tmp + "'>" + tmp + "</option>")
                        } else {
                            $("#Page").append("<option value='" + tmp + "'>" + tmp + "</option>")
                        }
                    }

                }

            });
        });
    });
</script>
