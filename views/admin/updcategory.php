<h2 id="<?php echo $category['id'] ?>">Оновлення категорії</h2>
<form style="margin-top: 50px" method="post" class="update-form" action="">
    <div class="row mb-3">
        <label for="inputFirstname" class="col-sm-2 col-form-label">Назва</label>
        <div class="col-sm-12">
            <input type="text" style="margin-bottom: 10px" class="form-control " id="inputName" value="<?php echo $category['name'] ?>">
        </div>
        <label for="inputLastname" class="col-sm-2 col-form-label">Опис</label>
        <div class="col-sm-12">
            <textarea style="margin-bottom: 10px" id="inputDescription" class="form-control"><?php echo $category['description']  ?></textarea>
        </div>
        <div class="col-sm-12">
            <button style="float: right" class="btn btn-default" id="update-form" type="button">Додати</button>
        </div>
    </div>
</form>

<br><br><br><br><br><br><br><br><br><br><br><br><br>
<script>
    $(document).ready(function () {
        $('#update-form').click(function (event) {

            var formData = {
                id: $('h2').attr('id'),
                name: $('#inputName').val(),
                description: $('#inputDescription').val(),
                submit: 'submit',
            };
            console.log(formData);
            $.ajax({
                url: "/admin/UpdCategoryAjax",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var msg = JSON.parse(item);
                    if(msg == null){
                      alert('Категорію було оновлено');
                    }else{
                        alert('Категорію було оновлено');
                    }
                }
            });
        });
    });


</script>