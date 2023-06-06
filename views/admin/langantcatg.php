<h3>Мови</h3>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Cторінка</td>
            <td>Назва</td>
            <td>Код</td>
        </tr>
        <tr>
            <td>
                <select  class="userInfo form-control" id="Page">
                    <?php for ($i = 0; $i < $languages['count']['count']/5; $i++){ ?>
                        <?php if ($i === 0){ ?>
                            <option value="1" selected><?php echo $i+1; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
                        <?php } ?>
                    <?php } ?>
            </td>
            <td><input type="text" class="userInfo form-control" id="NameLang"></td>
            <td><input type="text" class="userInfo form-control" id="codeLang"></td>
            <td></td>
            <td></td>
        </tr>
        <tbody id="tbodyStud">

        <?php if ($languages['languages'] != null) { ?>
            <?php foreach ($languages['languages'] as $el) { ?>
                <tr class="text-center" style="background-color: <?php if($el['active'] == '1') { echo 'lightblue'; } else if( $el['active'] == '0') { echo 'red';  }; ?>" >
                    <td></td>
                    <td><?php echo $el['name']; ?></td>
                    <td><?php echo $el['code']; ?></td>
                    <td><a href="/admin/UpdLang?id=<?php echo $el['id']; ?>">?</td>
                    <td><a href="/admin/DelLang?id=<?php echo $el['id']; ?>">X</td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>

<h3>Категорії</h3>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Cторінка</td>
            <td>Назва</td>
            <td>Опис</td>
        </tr>
        <tr>
            <td>
                <select  class="userCategory form-control" id="PageCat">
                    <?php for ($i = 0; $i < $category['count']['count']/5; $i++){ ?>
                        <?php if ($i === 0){ ?>
                            <option value="1" selected><?php echo $i+1; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
                        <?php } ?>
                    <?php } ?>
            </td>
            <td><input type="text" class="userCategory form-control" id="NameCategory"></td>
            <td><input type="text" class="userCategory form-control" id="CategoryDescription"></td>
            <td></td>
            <td></td>
        </tr>
        <tbody id="tbodycat">


        <?php if ($category['category'] != null) { ?>
            <?php foreach ($category['category'] as $el) { ?>
                <tr class="text-center" style="background-color: <?php if($el['active'] == '1') { echo 'lightblue'; } else if( $el['active'] == '0') { echo 'red';  }; ?>" >
                    <td></td>
                    <td><?php echo $el['name']; ?></td>
                    <td><?php echo $el['description']; ?></td>
                    <td><a href="/admin/updcategory?id=<?php echo $el['id']; ?>">?</td>
                    <td><a href="/admin/DelCategory?id=<?php echo $el['id']; ?>">X</td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
<br>
<br>
<br><br><br><br><br>

<script>
    $(document).ready(function () {
        $('.userInfo').change(function (event) {
            var formData = {}

            if ($('#NameLang').val() !== "") {
                formData['name'] = $('#NameLang').val()
            }
            if ($('#codeLang').val() !== "") {
                formData['code'] = $('#codeLang').val()
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
                url: "/admin/AjaxLanguages",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var language = JSON.parse(item);
                    console.log(language);
                    $("#tbodyStud").children().remove();
                    console.log(Object.keys(language['languages']).length);


                    for (var i = 0; i < Object.keys(language['languages']).length; i++) {

                        $("#tbodyStud").append("<tr class='tr text-center'><td></td><td>" + language['languages'][i]['name'] + "</td><td>" + language['languages'][i]['code'] + "</td><td><a href='/admin/updLang?id=" + language['languages'][i]['id'] + "'>?<td><a href='/admin/DelLang?id=" + language['languages'][i]['id'] + "'>X</td></tr>")
                    }
                    $("#Page").children().remove();
                    for (var j = 0; j < language['count']['count'] / 5; j++) {
                        var tmp = j + 1;
                        if (tmp == language['page']) {
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
        $('.userCategory').change(function (event) {
            var formData = {}

            if ($('#NameCategory').val() !== "") {
                formData['name'] = $('#NameCategory').val()
            }
            if ($('#CategoryDescription').val() !== "") {
                formData['description'] = $('#CategoryDescription').val()
            }
            if ($('#PageCat').val() !== "") {
                formData['page'] = $('#PageCat').val()
            }
            if (formData['page'] == null) {
                formData['page'] = '1';
            }

            formData['submit'] = 'submit'

            console.log(formData);
            $.ajax({
                url: "/admin/AjaxCategory",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var category = JSON.parse(item);
                    console.log(category);
                    $("#tbodycat").children().remove();
                    console.log(Object.keys(category['category']).length);


                    for (var i = 0; i < Object.keys(category['category']).length; i++) {

                        $("#tbodycat").append("<tr class='tr text-center'><td></td><td>" + category['category'][i]['name'] + "</td><td>" + category['category'][i]['code'] + "</td><td><a href='/admin/updcategory?id=" + category['category'][i]['id'] + "'>?<td><a href='/admin/DelCategory?id=" + category['category'][i]['id'] + "'>X</td></tr>")
                    }
                    $("#PageCat").children().remove();
                    for (var j = 0; j < category['count']['count'] / 5; j++) {
                        var tmp = j + 1;
                        if (tmp == category['page']) {
                            var id = 'page' + formData['page'];
                            $("#PageCat").append("<option selected id='" + id + "' value='" + tmp + "'>" + tmp + "</option>")
                        } else {
                            $("#PageCat").append("<option value='" + tmp + "'>" + tmp + "</option>")
                        }
                    }

                }

            });
        });
    });


</script>
