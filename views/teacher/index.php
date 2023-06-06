<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3">
            <ul class="nav nav-pills nav-stacked" style="margin-top: 50px">
                <li><a class="btn btn-primary" href="/teacher/courses">Мої курси</a></li>
                <li><a class="btn btn-primary" href="/teacher/about">Мої дані</a></li>
                <li><a class="btn btn-primary" href="/teacher/index">Головна</a></li>
            </ul><br>
        </div>

        <div class="col-sm-9">
            <div class="row">
                <div class="col-md-10">
                    <div class="my-chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="my-chart" >
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <script>
        console.log(<?= json_encode($info['count2']); ?>)
        const data = {
            labels: <?= json_encode($info['label1']); ?>,
            datasets: [{
                label: 'Кількість занять на курсах',
                backgroundColor: 'rgba(252,68,68,0.72)',
                data: <?= json_encode($info['count1']); ?>,
            }]
        };

        const config = {
            type: 'bar',
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

    </script>