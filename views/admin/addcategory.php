<h2>Додавання категорії</h2>
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="inputFirstname" class="col-sm-2 col-form-label">Назва</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="inputName">
        </div>
        <label for="inputLastname" class="col-sm-2 col-form-label">Опис</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="inputDescription" >
        </div>
        <div class="col-sm-12">
            <button style="float: right" class="btn btn-default" id="update-form" type="button">Додати</button>
        </div>
    </div>
</form>
<h2>Додавання мови</h2>
<form style="margin-top: 50px" method="post" class="create-form" action="">
    <div class="row mb-3">
        <label for="inputFirstname" class="col-sm-2 col-form-label">Назва</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="inputNameLanguage">
        </div>
        <label for="inputLastname" class="col-sm-2 col-form-label">Код</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control" id="inputDescriptionLanguage" >
        </div>
        <div class="col-sm-12">
            <button style="float: right" class="btn btn-default" id="create-form" type="button">Додати</button>
        </div>
    </div>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {

            var formData = {
                name: $('#inputName').val(),
                description: $('#inputDescription').val(),
                submit: 'submit',
            };
            console.log(formData);
            $.ajax({
                url: "/admin/СreateCategory",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg != "Перевірте назву"){
                      alert('Категорію було додано');
                    }else{
                        alert(msg);
                    }
                }
            });
        });
    });

    $(document).ready(function () {
        $('#create-form').click(function (event) {

            var formData = {
                name: $('#inputNameLanguage').val(),
                code: $('#inputDescriptionLanguage').val(),
                submit: 'submit',
            };
            $.ajax({
                url: "/admin/addLanguageAjax",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg != "Перевірте назву" || msg != "Перевірте код"){
                        alert('Мову було додано');
                    }else{
                        alert(msg);
                    }
                }
            });
        });
    });
</script>