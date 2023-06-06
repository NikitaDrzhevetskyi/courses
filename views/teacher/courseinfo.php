<div class="row content">
    <h1>Курс</h1>
    <table style="border-spacing: 10px; width: 500px; text-align: center"  class="table-bordered">
        <tr style="text-align: center">
            <th >Назва</th>
            <td><?php echo $course['name']; ?></td>
        </tr>
            <th>Мова</th>
            <td><?php echo $course['language']; ?></td>
        <tr>
            <th>Рівень</th>
            <td><?php echo $course['level']; ?></td>
        </tr>
            <th>Категорія</th>
            <td><?php echo $course['category']; ?></td>
<!--        <tr>-->
<!--            <th>Занять</th>-->
<!--            <td>--><?php //echo $course['lessons']; ?><!--</td>-->
<!--        </tr>-->
        <tr>
            <th>Ціна</th>
            <td><?php echo $course['price']; ?></td>
        </tr>
        <tr>
            <th>Дата початку</th>
            <td><?php echo $course['start']; ?></td>
        </tr>
        <tr>
            <th>Дата кінця</th>
            <td><?php echo $course['finish']; ?></td>
        </tr>
    </table>
    <h2 id="<?php echo $_SESSION['user']['id']; ?>">Розклад</h2>
    <table class="table-bordered" style="border-spacing: 10px; width: 1000px; text-align: center" >
        <tr>
            <td class="classes"><h3 id="<?php echo $lessons[0]['id_course']; ?>">Дата</h3>
            </td>
            <td class="classes"><select class="courseInfo" id="Date">
                    <option value="" selected></option>
                    <?php foreach ($time as $el) { ?>
                    <option value="<?php echo $el['start']; ?>"><?php echo $el['start']; ?></option>
                <?php } ?></td>
        </tr>
        <tr>
            <td></td>
            <td><h4>Початок</h4></td>
            <td><h4>Кінець</h4></td>
            <td><h4>Тип</h4></td>
            <td><h4>Посилання</h4></td>
            <td><h4>Опис</h4></td>
            <td><h4>Викладач</h4></td>
            <td><h4>Змінити</h4></td>
        </tr>
        <?php if ($lessons != null) { ?>
            <tbody id="tbody">
            <?php foreach ($lessons as $el) { ?>
                <tr class="text-center" style="background-color: <?php if($el['active'] == '1') { echo 'lightblue'; } else if( $el['active'] == '0') { echo 'red';  }; ?>" >
                    <td></td>
                    <td><?php echo $el['start']; ?></td>
                    <td><?php echo $el['finish']; ?></td>
                    <td><?php echo $el['type']; ?></td>
                    <td><?php echo $el['link']; ?></td>
                    <td><?php echo $el['description']; ?></td>
                    <td><?php echo $el['first_name']; ?><?php echo $el['last_name']; ?></td>
                    <td><?php if($el['user_id'] == $_SESSION['user']['id']) {  ?>
                            <a href="\teacher\changeinfolessons?id=<?php echo $el[0]; ?>">Змінити</a>
                        <?php } ?></td>
                </tr>
            <?php } ?>
            </tbody>
        <?php } ?>
        </tbody>
    </table>
</div>

<h3>Студенти</h3>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Ім'я</td>
            <td>Прізвище</td>
            <td>Стать</td>
            <td>Дата народження</td>
            <td>Телефон</td>
            <td>Email</td>
        </tr>
        <tr>
            <td><input type="text" class="userInfo" id="userName"></td>
            <td><input type="text" class="userInfo" id="userSurname"></td>
            <td>
                <select  class="userInfo" id="CourseGender">
                    <option value="" selected></option>
                    <option value="Ж">Ж</option>
                    <option value="Ч">Ч</option>
            </td>
            <td><input type="date" class="userInfo" id="userBirthday" ></td>
            <td><input type="text" class="userInfo" id="userTelephone" value="+380"></td>
            <td><input type="text" class="userInfo" id="userEmail"></td>
        </tr>
        <tbody id="tbodyStud">
        <?php if ($students != null) { ?>
            <?php foreach ($students as $el) { ?>
                <tr class="text-center" style="background-color: <?php if($el['active'] == '1') { echo 'lightblue'; } else if( $el['active'] == '0') { echo 'red';  }; ?>" >
                    <td><?php echo $el['first_name']; ?></td>
                    <td><?php echo $el['last_name']; ?></td>
                    <td><?php echo $el['gender']; ?></td>
                    <td><?php echo $el['date_birth']; ?></td>
                    <td><?php echo $el['telephone']; ?></td>
                    <td><?php echo $el['email']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>

        </tbody>
    </table>
</div>
<br> <br> <br> <br> <br>

<script>
    $(document).ready(function () {
        $('.userInfo').change(function (event) {
            var formData = {}

            if($('#userName').val() !== ""){
                formData['first_name'] = $('#userName').val()
            }
            if($('#userSurname').val() !== ""){
                formData['last_name'] = $('#userSurname').val()
            }
            if($('#CourseGender').val() !== ""){
                formData['gender'] =  $('#CourseGender').val()
            }
            if($('#userBirthday').val() !== ""){
                formData['date_birth'] =  $('#userBirthday').val()
            }
            if($('#userTelephone').val() !== ""){
                formData['telephone'] =  $('#userTelephone').val()
            }
            if($('#userEmail').val() !== ""){
                formData['email'] =  $('#userEmail').val()
            }

            if($('h3').attr('id') !== ""){
                formData['id_course'] = $('h3').attr('id')
            }

            formData['role'] = '3'
            formData['is_active'] = '1'

            console.log(formData);

            $.ajax({
                url: "/teacher/sortstudents",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var user = JSON.parse(item);
                    console.log(user);
                    $("#tbodyStud").children().remove();

                    for (var i = 0; i < Object.keys(user).length; i++) {

                            $("#tbodyStud").append("<tr class='tr text-center'><td>" + user[i]['first_name'] + "</td><td>" + user[i]['last_name'] + "</td><td>" + user[i]['gender'] + "</td><td>" + user[i]['date_birth']
                                + "</td><td>" + user[i]['telephone'] + "</td><td>" + user[i]['email'] +  "</td><tr>")

                    }
                }
            });
        });
    });
</script>



























<script>
    $(document).ready(function () {
        $('.classes').change(function (event) {
            var formData = {}

            if($('#Date').val() !== ""){
                formData['start'] = $('#Date').val()
            }

            if($('h2').attr('id') !== ""){
                var user = $('h2').attr('id')
            }

            if($('h3').attr('id') !== ""){
                formData['id'] = $('h3').attr('id')
            }

            console.log(formData);

            $.ajax({
                url: "/teacher/datelessons",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    $("#tbody").children().remove();
                    var lessons = JSON.parse(item);
                    for (var i = 0; i < Object.keys(lessons).length; i++) {
                        if (lessons[i]['user_id'] !== user) {
                            $("#tbody").append("<tr><td></td><td>" + lessons[i]['start'] + "</td>" +
                                "<td>" + lessons[i]['finish'] + "</td>" +
                                "<td>" + lessons[i]['type'] + "</td>" +
                                "<td>" + lessons[i]['link'] + "</td>" +
                                "<td>" + lessons[i]['first_name'] + ' ' + lessons[i]['last_name'] + "</td>" +
                                "<td>" + lessons[i]['description'] + "</td>")
                        } else {
                            $("#tbody").append("<tr><td></td><td>" + lessons[i]['start'] + "</td>" +
                                "<td>" + lessons[i]['finish'] + "</td>" +
                                "<td>" + lessons[i]['type'] + "</td>" +
                                "<td>" + lessons[i]['link'] + "</td>" +
                                "<td>" + lessons[i]['description'] + "</td>" +
                                "<td>" + lessons[i]['first_name'] + ' ' + lessons[i]['last_name'] + "</td>" +
                                "<td>" + "<a href='\changeinfolessons?id=" + lessons[i][0] + "'>Змінити</a>" + "</td>" +
                            )
                        }
                    }
                }
            });
        });
    });
</script>