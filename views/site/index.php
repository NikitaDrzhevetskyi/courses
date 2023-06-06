<div class="jumbotron text-center" >
    <h1>Language Courses</h1>
    <p style="margin-top: 30px">Don’t be an alien in a foreign country.</p>
    <form class="form-inline">
        <div class="input-group">

        </div>
    </form>
</div>
<div id="pricing" class="container-fluid">
    <p>   </p>
</div>
<?php if($courses != null) { ?>
<div id="pricing" class="container-fluid">
    <div style="margin-bottom: 50px" class="text-center">
        <h2>Пропозиція для вас</h2>
    </div>
    <div class="row slideanim">
        <div class="col-sm-3 col-xs-12"> </div>
    <?php foreach ($courses as $el) { ?>
        <div class="col-sm-2 col-xs-12">
            <div class="panel panel-default text-center " style="border-color: #1c222a;">
                <div class="panel-heading mypanel" style="background-color: #1c222a; border-color: #1c222a">
                    <h1 style="color: #f2f2f2"><?php echo $el['name']; ?></h1>
                </div>
                <div class="panel-body " style="border-color: #edb021;">
                    <p>Мова: <strong><?php echo $el['language']; ?></strong> </p>
                    <p>Категорія: <strong><?php echo $el['category']; ?></strong></p>
                    <p>Рівень: <strong><?php echo $el['lvl']; ?></strong> </p>
                    <p><strong><?php echo number_format($el['price'], 2, ".", ""); ?></strong>₴</p>
                </div>
                <div class="panel-footer" style="background-color: #1c222a">
                    <button class="btn btn-lg register"  value="<?php echo $el['id']; ?>" style="background-color: #edb021; color: #f2f2f2; border-color: #edb021">Зарахувати мене</button>
                </div>
            </div>
        </div>
    <?php } ?>
        <?php } ?>
        <div class="col-sm-3 col-xs-12"> </div>
    </div>
</div>
<div id="pricing" class="container-fluid" style="margin-bottom: 30px">
    <p>   </p>
</div>

<script>
    $(document).ready(function () {
        $('.register').click(function (event){
            var id = $(this).attr('value');
            var formData = {}
            formData['id'] = id
            $.ajax({
                url:"/site/Register",
                method: "POST",
                data: formData,
                success: function (item){
                    var msg = JSON.parse(item);
                    alert(msg)
                }
            });
        });
    });
</script>










