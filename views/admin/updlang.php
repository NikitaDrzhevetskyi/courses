<h2 id="<?php echo $language['id'] ?>">Оновлення мови</h2>
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="inputFirstname" class="col-sm-2 col-form-label">Назва</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="inputName" value="<?php echo $language['name'] ?>">
        </div>
        <label for="inputLastname" class="col-sm-2 col-form-label">Код</label>
        <div class="col-sm-12">
            <input type="text" value="<?php echo $language['code']  ?>" id="inputСode" class="form-control">
        </div>
        <div class="col-sm-12">
            <button style="float: right" class="btn btn-default" id="update-form" type="button">Оновити</button>
        </div>
    </div>
</form>

<br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {

            var formData = {
                id: $('h2').attr('id'),
                name: $('#inputName').val(),
                code: $('#inputСode').val(),
                submit: 'submit',
            };
            console.log(formData);
            $.ajax({
                url: "/admin/UpdLangAjax",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg != 'Перевірте код' && msg != 'Перевірте назву'){
                      alert('Категорію було оновлено');
                    }else{
                      alert(msg);
                    }
                }
            });
        });
    });


</script>