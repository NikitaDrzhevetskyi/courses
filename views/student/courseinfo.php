<div class="row content">
    <h1>Курс</h1>
    <table style="border-spacing: 10px; width: 500px; text-align: center"  class="table-bordered">
        <tr style="text-align: center">
            <td><h4>Назва</h4></td>
            <td><h4><?php echo $course['name']; ?></h4></td>
        </tr>
            <td><h4>Мова</h4></td>
            <td><h4><?php echo $course['language']; ?></h4></td>
        <tr>
            <td><h4>Рівень</td>
            <td><h4><?php echo $course['level']; ?></td>
        </tr>
            <td><h4>Категорія</h4></td>
            <td><h4><?php echo $course['category']; ?></h4></td>
<!--        <tr>-->
<!--            <td><h4>Занять</h4></td>-->
<!--            <td><h4>--><?php //echo $course['lessons']; ?><!--</h4></td>-->
<!--        </tr>-->
        <tr>
            <td><h4>Ціна</h4></td>
            <td><h4><?php echo $course['price']; ?></h4></td>
        </tr>
        <tr>
            <td><h4>Дата початку</h4></td>
            <td><h4><?php echo $course['start']; ?></h4></td>
        </tr>
        <tr>
            <td><h4>Дата кінця</h4></td>
            <td><h4><?php echo $course['finish']; ?></h4></td>
        </tr>
    </table>

    <h2 id="<?php echo $lessons[0]['id_course']; ?>">Розклад</h2>

    <table class="table-bordered" style="border-spacing: 10px; width: 1000px; text-align: center" >
        <tr>
            <td><h4>Початок</h4></td>
            <td><h4>Кінець</h4></td>
            <td><h4>Тип</h4></td>
            <td><h4>Посилання</h4></td>
            <td><h4>Опис</h4></td>
            <td><h4>Викладач</h4></td>
        </tr>
        <tr>
            <td><select class="classes teacher" id="Teacher">
            <option value="" selected></option>
            <?php foreach ($teachers as $el) { ?>
                <option value="<?php echo $el['id']; ?>"><?php echo $el['first_name']; ?> <?php echo $el['last_name']; ?></option>
            <?php } ?>
                    </select>
            </td>
            <td class="classes"><select class="courseInfo" id="Date">
                    <option value="" selected></option>
                    <?php foreach ($time as $el) { ?>
                        <option value="<?php echo $el['start']; ?>"><?php echo $el['start']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
        <?php if ($lessons != null) { ?>
            <tbody id="tbody">
            <?php foreach ($lessons as $el) { ?>
                <tr class="text-center" style="background-color: <?php if($el['active'] == '1') { echo 'lightblue'; } else if( $el['active'] == '0') { echo 'red';  }; ?>" >
                    <td><?php echo $el['start']; ?></td>
                    <td><?php echo $el['finish']; ?></td>
                    <td><?php echo $el['type']; ?></td>
                    <td><?php echo $el['link']; ?></td>
                    <td><?php echo $el['description']; ?></td>
                    <td><?php echo $el['first_name']; ?> <?php echo $el['last_name']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        <?php } ?>
            </tbody>
        </tr>
    </table>
</div>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<script>
    $(document).ready(function () {
        $('.classes').change(function (event) {
            var formData = {}

            if($('.teacher').val() !== ""){
                formData['teacher'] = $('.teacher').val()
            }
            if($('h2').attr('id') !== ""){
                formData['id'] = $('h2').attr('id')
            }
            if($('#Date').val() !== ""){
                formData['start'] = $('#Date').val()
            }


            console.log(formData);

            $.ajax({
                url: "/student/teachersdatelessons",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    $("#tbody").children().remove();
                    var lessons = JSON.parse(item);
                    for (var i = 0; i < Object.keys(lessons).length; i++) {

                    $("#tbody").append("<tr><td>" + lessons[i]['start'] + "</td>" +
                        "<td>" + lessons[i]['finish'] + "</td>" +
                        "<td>" + lessons[i]['type'] + "</td>" +
                        "<td>" + lessons[i]['link'] + "</td>" +
                        "<td>" + lessons[i]['description'] + "</td>"+
                        "<td>" + lessons[i]['first_name'] + ' ' + lessons[i]['last_name'] + "</td>" )
                }
                }


            });
        });
    });
</script>