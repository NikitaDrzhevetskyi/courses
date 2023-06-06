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
            <td>Роль</td>
            <td>Зареєстрований</td>
            <td>Змінити</td>
            <td>Видалити</td>
        </tr>
        <tr>
            <td>
                <select  class="userInfo" id="Page">
                    <?php for ($i = 0; $i < $user_info['count']['count']/10; $i++){ ?>
                        <?php if ($i === 0){ ?>
                    <option value="1" selected><?php echo $i+1; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
                    <?php } ?>
                    <?php } ?>
            </td>
            <td><input type="text" class="userInfo" id="userName"></td>
            <td><input type="text" class="userInfo" id="userSurname"></td>
            <td>
                <select  class="userInfo" id="userGender">
                    <option value="" selected></option>
                    <option value="Ж">Ж</option>
                    <option value="Ч">Ч</option>
            </td>
            <td><input type="date" class="userInfo" id="userBirthday" ></td>
            <td><input type="text" class="userInfo" id="userTelephone" value="+380"></td>
            <td><input type="text" class="userInfo" id="userEmail"></td>
            <td>
                <select  class="userInfo" id="userRole">
                    <option value="" selected></option>
                    <option value="1">Адміністатор</option>
                    <option value="2">Викладач</option>
                    <option value="3">Студент</option>
            </td>
            <td><input type="date" class="userInfo" id="userCreate"></td>
            <td></td>
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
                    <td><?php if($el['role'] == '3'){ echo 'Студент'; } else {
                        } if ($el['role'] == '2') {
                            echo 'Викладач';
                        } else if ($el['role'] == '1'){
                            echo 'Admin';
                        }?></td>
                    <td><?php echo $el['create_at']; ?></td>
                    <td><a href="/admin/updateuser?user=<?php echo $el['id']; ?>">?</td>
                    <td><a href="/admin/deluser?user=<?php echo $el['id']; ?>">X</td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>


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
            if($('#userGender').val() !== ""){
                formData['gender'] =  $('#userGender').val()
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
            if($('#userRole').val() !== ""){
                formData['role'] =  $('#userRole').val()
            }
            if($('#userCreate').val() !== ""){
                formData['create'] =  $('#userCreate').val()
            }
            if($('#Page').val() !== ""){
                formData['page'] =  $('#Page').val()
            }
            if(formData['page'] == null){
                formData['page'] = '1';
            }


            formData['submit'] =  'submit'
            console.log(formData);
            $.ajax({
                url: "/admin/ajaxusers",
                method: "POST",
                data: formData,
                success: function (item) {
                    console.log(item);
                    var user = JSON.parse(item);
                    console.log(user);
                    $("#tbodyStud").children().remove();
                    console.log(Object.keys(user['users']).length);
                    for (var i = 0; i < Object.keys(user['users']).length; i++) {

                        if(user['users'][i]['role'] == '1'){
                            user['users'][i]['role'] = 'Admin'
                        } else if(user['users'][i]['role'] == '2'){
                            user['users'][i]['role'] = 'Викладач'
                        } else if(user['users'][i]['role'] == '3'){
                            user['users'][i]['role'] = 'Студент'
                        }
                        console.log(user['users'][i]['role']);
                        $("#tbodyStud").append("<tr class='tr text-center'><td></td><td>" + user['users'][i]['first_name'] + "</td><td>" + user['users'][i]['last_name'] + "</td><td>" + user['users'][i]['gender'] + "</td><td>" + user['users'][i]['date_birth']
                            + "</td><td>" + user['users'][i]['telephone'] + "</td><td>" + user['users'][i]['email'] +  "</td><td>" + user['users'][i]['role'] + "</td><td>" + user['users'][i]['create_at'] + "</td><td><a href='/admin/updateuser?user=" + user['users'][i]['id'] + "'>?</td><td><a href='/admin/deluser?user=" + user['users'][i]['id'] + "'>X</td></tr>")
                    }
                    $("#Page").children().remove();
                    for (var j = 0; j < user['count']['count']/10; j++) {
                        var tmp = j + 1;
                        if(tmp == user['page']){
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