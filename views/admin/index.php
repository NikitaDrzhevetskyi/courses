<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3">
            <ul class="nav nav-pills nav-stacked" style="margin-top: 50px">
                <li><a class="btn btn-primary" href="/admin/courses">Курси</a></li>
                <li><a class="btn btn-primary" href="/admin/users">Користувачі</a></li>
                <li><a class="btn btn-primary" href="/admin/about">Мої дані</a></li>
                <li><a class="btn btn-primary" href="/admin/index">Статистика</a></li>
                <li><a class="btn btn-primary" href="/admin/addcategory">Додати Мову або Категорію</a></li>
                <li><a class="btn btn-primary" href="/admin/LangAndCatg">Мови та Категорії</a></li>
                <li><a class="btn btn-primary" href="/admin/CreateCourse">Додати курс</a></li>
                <li><a class="btn btn-primary" href="/admin/Backup">Бекап</a></li>
            </ul><br>
        </div>

        <div class="col-sm-9">
            <div class="row">
                <h3>Реєстрації</h3>
                <div class="col-md-10">
                    <div class="my-chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3>Оплати</h3>
                <div class="col-md-10">
                    <div class="my-chart">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
       var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        console.log(<?= json_encode($info['label_admin']); ?>)
       console.log(<?= json_encode($info['count_money']); ?>)

        const data = {
            labels: month,
            datasets: [{
                label: 'Адміністраторів',
                backgroundColor: 'rgba(252,68,68,0.72)',
                data: <?= json_encode($info['count_admin']); ?>,
            },{
                label: 'Викладачів',
                backgroundColor: 'rgba(114,252,68,0.72)',
                data: <?= json_encode($info['count_teacher']); ?>,
            },{
                    label: 'Студентів',
                    backgroundColor: 'rgba(10,21,236,0.72)',
                    data: <?= json_encode($info['count_student']); ?>,
            }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {scales: {
                    y: {
                        beginAtZero: true
                    }
                }}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );




        console.log(<?= json_encode($info['count_money']); ?>)
        const data2 = {
            datasets: [{
                label: month,
                backgroundColor: [
                    'rgba(245,201,5,0.84)',
                    'rgba(35,243,3,0.82)',
                    'rgba(238,4,23,0.84)',
                    'rgba(4,23,238,0.84)',
                    'rgba(124,9,9,0.84)',
                    'rgba(187,4,238,0.84)',
                    'rgba(230,4,238,0.84)',
                    'rgba(199,108,201,0.84)',
                    'rgba(108,198,201,0.84)',
                    'rgba(243,36,141,0.84)',
                    'rgba(108,155,201,0.84)',
                    'rgba(51,36,51,0.84)'
                ],
                data: <?= json_encode($info['count_money']); ?>,
            }]
        };

        const config2 = {
            type: 'bar',
            data: data2,
            options: {scales: {
                    y: {
                        beginAtZero: true
                    }
                }}
        };

        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );
</script>