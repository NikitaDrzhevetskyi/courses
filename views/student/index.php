<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3">
            <ul class="nav nav-pills nav-stacked" style="margin-top: 50px">
                <li><a class="btn btn-primary" href="/student/courses">Мої курси</a></li>
                <li><a class="btn btn-primary" href="/student/about">Мої дані</a></li>
                <li><a class="btn btn-primary" href="/student/index">Головна</a></li>
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



<!--<div class="container">-->
<!--        <div class="col-md-6">-->
<!--            <div class="my-chart">-->
<!--                <canvas id="myChart"></canvas>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-md-6">-->
<!--            <div class="row">-->
<!--                <div class="col-md-6">-->
<!--                    <div class="my-chart">-->
<!--                        <canvas id="myChart"></canvas>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col-md-12">-->
<!--                    <div class="my-chart">-->
<!--                        <canvas id="myChart2"></canvas>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--</div>-->


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

    console.log(<?= json_encode($info['label2']); ?>)
    console.log(<?= json_encode($info['count2']); ?>)
    const data2 = {
        labels: ["Тривають","Завершені", "Ще не почалися"],
        datasets: [{
            label: 'Мої курси',
            backgroundColor: [
                'rgba(245,201,5,0.84)',
                'rgba(35,243,3,0.82)',
                'rgba(238,4,23,0.84)'
            ],
            data: <?= json_encode($info['count2']); ?>,
        }]
    };

    const config2 = {
        type: 'polarArea',
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
