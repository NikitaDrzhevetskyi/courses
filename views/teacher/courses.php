<h1>Курси</h1>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Cторінка</td>
            <td>Назва</td>
            <td>Мова</td>
            <td>Рівень</td>
            <td>Категорія</td>
            <td>К-сть занять</td>
            <td>Ціна</td>
            <td>Дата початку</td>
            <td>Дата кінця</td>
            <td>Етап</td>
        </tr>
      <tr>
          <td>
              <select  class="courseInfo" id="Page">
                  <?php for ($i = 0; $i < $courses['count']['count']/10; $i++){ ?>
                      <?php if ($i === 0){ ?>
                          <option value="1" selected><?php echo $i+1; ?></option>
                      <?php } else { ?>
                          <option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
                      <?php } ?>
                  <?php } ?>
          </td>
          <td><input type="text" class="courseInfo" id="CourseName"></td>
          <td>
              <select  class="courseInfo" id="CourseLanguage">
              <option value="" selected></option>
              <?php foreach ($params['languages'] as $el) { ?>
                  <option value="<?php echo $el['id']; ?>"><?php echo $el['name']; ?></option>
          <?php } ?>
          </td>
          <td><select class="courseInfo" id="CourseLevel">
                  <option value="" selected></option>
                  <?php foreach ($params['levels'] as $el) { ?>
                  <option value="<?php echo $el['id']; ?>"><?php echo $el['code']; ?></option>
              <?php } ?>
          </td>
          <td><select class="courseInfo" id="CourseCategory">
                  <option value="" selected></option>
                  <?php foreach ($params['categories'] as $el) { ?>
                  <option value="<?php echo $el['id']; ?>"><?php echo $el['name']; ?></option>
              <?php } ?>
          </td>
          <td><input type="text" class="courseInfo" id="CourseLessons"></td>
          <td><input type="text" class="courseInfo" id="CoursePrice"></td>
          <td><input type="date" class="courseInfo" id="CourseStart"></td>
          <td><input type="date" class="courseInfo" id="CourseFinish"></td>

          <td><select class="courseInfo" id="CourseTypeActive" name="course" >
                  <option value="" selected></option>
                  <option value="0">Ще не почалися</option>
                  <option value="1" >Вже тривають</option>
                  <option value="2" >Завершені</option>
          </td>
      </tr>
        <tbody id="tbody">

        <?php if ($courses['course'] != null) { ?>
            <?php foreach ($courses['course'] as $el) { ?>
        <tr class="text-center" >
                <td></td>
                <td><?php echo $el['name']; ?></td>
                <td><?php echo $el['language']; ?></td>
                <td><?php echo $el['level']; ?></td>
                <td><?php echo $el['category']; ?></td>
                <td><?php echo $el['lessons']; ?></td>
                <td><?php echo $el['price']; ?></td>
                <td><?php echo $el['start']; ?></td>
                <td><?php echo $el['finish']; ?></td>

                <td><?php if($el['active'] == '0') { echo "Ще не почався"; } else if( $el['active'] == '1') { echo "Триває"; } else if( $el['active'] == '3') { echo "Завершився";  } ?></td>

                <td><a href="/teacher/courseinfo?id=<?php echo $el['id']; ?>">Info</a></td>

        </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br><br> <br> <br><br> <br> <br> <br> <br> <br> <br> <br><br> <br> <br> <br><br> <br> <br> <br>
<script>
    $(document).ready(function () {
        $('.courseInfo').change(function (event) {
            var formData = {}

            if($('#CourseName').val() !== ""){
                formData['courses.name'] = $('#CourseName').val()
            }
            if($('#CourseLanguage').val() !== ""){
                formData['courses.language'] = $('#CourseLanguage').val()
            }
            if($('#CourseCategory').val() !== ""){
                formData['courses.category'] =  $('#CourseCategory').val()
            }
            if($('#CourseLevel').val() !== ""){
                formData['courses.level'] =  $('#CourseLevel').val()
            }
            if($('#CoursePrice').val() !== ""){
                formData['courses.price'] =  $('#CoursePrice').val()
            }
            if($('#CourseLessons').val() !== ""){
                formData['courses.lessons'] =  $('#CourseLessons').val()
            }
            if($('#CourseStart').val() !== ""){
                formData['courses.start'] =  $('#CourseStart').val()
            }
            if($('#CourseFinish').val() !== ""){
                formData['courses.finish'] =  $('#CourseFinish').val()
            }
            if($('#CourseTypeActive').val() !== ""){
                formData['courses.active'] =  $('#CourseTypeActive').val()
            }
            if ($('#Page').val() !== "") {
                formData['page'] = $('#Page').val()
            }
            if (formData['page'] == null) {
                formData['page'] = '1';
            }

            formData['submit'] = 'submit'

            console.log(formData);

            $.ajax({
                url: "/teacher/sortcourses",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var courses = JSON.parse(item);
                    console.log(courses);
                $("#tbody").children().remove();

                    var etap = ''

                for (var i = 0; i < Object.keys(courses['course']).length; i++) {

                    if(courses['course'][i]['active'] === '1'){
                        etap = 'Триває';
                    }else if(courses['course'][i]['active'] === '0'){
                        etap = 'Ще не почався';
                    }else if(courses['course'][i]['active'] === '3'){
                        etap = 'Завершився';
                    }

                    console.log(courses['course'][i]['success']);
                        $("#tbody").append("<tr " +  " class='tr text-center' id='" + courses['course'][i]['id'] + "'><td></td><td>" + courses['course'][i]['name'] + "</td><td>"
                            + courses['course'][i]['language'] + "</td><td>" + courses['course'][i]['level']
                            + "</td><td>" + courses['course'][i]['category'] + "</td><td>" + courses['course'][i]['lessons'] + "" +
                            "</td><td> " + courses['course'][i]['price'] +
                            "</td><td>" + courses['course'][i]['start'] +  "</td><td>" + courses['course'][i]['finish']
                            + "</td><td>" + etap  +
                            "</td><td><a href='/teacher/courseinfo?id=" + courses['course'][i]['id'] + "'>Info</a></td><tr>")
                    }
                    $("#Page").children().remove();
                    for (var j = 0; j < courses['count']['count'] / 10; j++) {
                        var tmp = j + 1;
                        if (tmp == courses['page']) {
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