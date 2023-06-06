<div class="container-fluid" style="margin-left: 100px; margin-top: 100px; margin-right: 100px">
    <div class="row">
        <div class="col-sm-2">
            <form action="" method="get">

                <?php if ($params['levels'] != null) { ?>

                    <p><strong>Рівні:</strong></p>
                    <?php foreach ($params['levels'] as $el) { ?>
                    <?php if ($filter['levels_check'] != null) { ?>
                        <?php if (in_array($el['id'], $filter['levels_check'])) { ?>
                            <div class="checkbox">
                                <label><input type="checkbox" checked name="levels_check[]"
                                              value="<?php echo $el['id']; ?>"
                                              style="margin-top: 3px"><?php echo $el['code']; ?></label>
                            </div>
                        <?php } else { ?>
                            <div class="checkbox">
                                <label><input type="checkbox" name="levels_check[]" value="<?php echo $el['id']; ?>"
                                              style="margin-top: 3px"><?php echo $el['code']; ?></label>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="checkbox">
                            <label><input type="checkbox" name="levels_check[]" value="<?php echo $el['id']; ?>"
                                          style="margin-top: 3px"><?php echo $el['code']; ?></label>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php } ?>

                <?php if ($params['categories'] != null) { ?>
                    <p><strong>Категорії:</strong></p>
                    <?php foreach ($params['categories'] as $el) { ?>
                    <?php if ($filter['categories_check'] != null) { ?>
                        <?php if (in_array($el['id'], $filter['categories_check'])) { ?>
                            <div class="checkbox">
                                <label><input type="checkbox" checked name="categories_check[]"
                                              value="<?php echo $el['id']; ?>"
                                              style="margin-top: 3px"><?php echo $el['name']; ?></label>
                            </div>
                        <?php } else { ?>
                            <div class="checkbox">
                                <label><input type="checkbox" name="categories_check[]" value="<?php echo $el['id']; ?>"
                                              style="margin-top: 3px"><?php echo $el['name']; ?></label>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="checkbox">
                            <label><input type="checkbox"  name="categories_check[]"
                                          value="<?php echo $el['id']; ?>"
                                          style="margin-top: 3px"><?php echo $el['name']; ?></label>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php } ?>

                <?php if ($params['languages'] != null) { ?>

                    <p><strong>Мави:</strong></p>
                    <?php foreach ($params['languages'] as $el) {?>
                    <?php if ($filter['languages_check'] != null) { ?>
                <?php if (in_array($el['id'], $filter['languages_check'])) { ?>
                        <div class="checkbox">
                        <label><input type="checkbox" checked name="languages_check[]" value="<?php echo $el['id']; ?>"
                    style="margin-top: 3px"><?php echo $el['code']; ?></label>
                    </div>
                        <?php } else { ?>
                            <div class="checkbox">
                                <label><input type="checkbox" name="languages_check[]" value="<?php echo $el['id']; ?>"
                                              style="margin-top: 3px"><?php echo $el['code']; ?></label>
                            </div>
                    <?php } ?>
                <?php } else { ?>
                        <div class="checkbox">
                            <label><input type="checkbox" name="languages_check[]" value="<?php echo $el['id']; ?>"
                                          style="margin-top: 3px"><?php echo $el['code']; ?></label>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php } ?>


                <div class="checkbox">
                    <p><strong>Дата початку:</strong></p>
                    <input type="date" name="date" value="<?php echo $_GET['date']; ?>"
                                  style="margin-top: 3px">
                </div>


                <div class="checkbox">
                    <p><strong>Макс. к-сть занять:</strong></p>
                   <input type="range" id="my_range" name="lessons_range" min="0" max="<?php echo $lessons; ?>" step="1" value="<?php echo $_GET['lessons_range']; ?>">  <label id="value_range"></label>
                </div>


                <div class="checkbox">
                    <div class="row">
                        <label for="min_price"><p style="white-space: pre;" ><strong>Ціна:   min:</strong></p></label> <label for="max_price"><p style="white-space: pre;"><strong>           max:</strong></p></label><br>
                        <label><input type="number" min="0" max="<?php echo $_GET['max_price']; ?>" id="min_price" name="min_price" value="<?php echo $_GET['min_price']; ?>"
                                      style="margin-top: 3px"></label>
                        <label style="padding-left: 60px"><input type="number" id ='max_price' min="0" max="<?php echo $_GET['max_price']; ?>" name="max_price" value="<?php echo $_GET['max_price']; ?>"
                                      style="margin-top: 3px"></label>
                    </div>
                </div>

                <button type="submit"   id="filter_btn" class="btn  my_btn" style="width: 244px;">Сортувати</button>
            </form>
        </div>
        <div class="col-sm-10">

            <?php if ($courses != null) { ?>
                <?php foreach ($courses as $el) { ?>
                    <div class="col-sm-3" style="background-color: #1c222a; color: #fff; margin-bottom: 20px; ">
                        <h1 class="text-center"><?php echo $el['name']; ?></h1>
                        <div class="text-left">
                            <span>Категорія: <?php echo $el['category']; ?><br> </span><span>
                            <span>Мова: <?php echo $el['language']; ?></span><br><span>Рівень: <?php echo $el['lvl']; ?></span><br>
                            <span>К-сть занять: <?php echo $el['lessons']; ?><br> </span><span>Ціна: <?php echo $el['price']; ?>$</span><br>
                            <span>Дата початку: <?php echo $el['start']; ?><br> </span><span>

                        </div>
                        <div style="text-align: right; margin-bottom: 10px">
                          <button class="btn btn-lg register"  value="<?php echo $el['course_id']; ?>" style="background-color: #edb021; color: #f2f2f2; border-color: #edb021">Зарахувати мене</button>
                        </div>
                    </div>

                    <div class="col-sm-1 text-center">
                    </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <nav class="d-flex justify-content-centero wow fadeIn mb-5" style="text-align: center;">
            <ul class="pagination">
                <?php for($i = 0; $i < $count/9; $i++): ?>
                    <li class="page-item">
                        <a href="<?php echo $link.($i+1) ?>" class="page-link">
                            <span aria-hidden="true"><?php echo $i+1 ?></span>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>



<script>
    var slider = document.getElementById("my_range");
    var value_range = document.getElementById("value_range");
    value_range.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
        value_range.innerHTML = this.value;
    }

    var min = document.getElementById("min_price");
    var max = document.getElementById("max_price");
    var btn = document.getElementById("filter_btn");



    min.onchange = function (){
        console.log(min.value)
        console.log(typeof(min.value))
        console.log(max.value)
        console.log(typeof(max.value))
        if(+min.value > +max.value || min.value < 0 ){
            btn.setAttribute('disabled', "disabled");
        }else {
            btn.removeAttribute('disabled');
        }
    }
    max.onchange = function (){
        console.log(min.value)
        console.log(typeof(min.value))
        console.log(max.value)
        console.log(typeof(max.value))
        if(+min.value > +max.value || min.value < 0 ){
            btn.setAttribute('disabled', "disabled");
        }else {
            btn.removeAttribute('disabled');
        }
    }


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