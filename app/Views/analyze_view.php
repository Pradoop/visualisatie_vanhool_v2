<div id="general_information">
    <h1>Algemene Planning</h1>
    <div class="grid-container">
        <div class="grid-child col1">
            <div class="card card-1">
                <div class="information_1">
                    <p class="information_value"><?= $total_in_production[0] ?> chassis</p>
                    <p class="information_text">in montage</p>
                </div>
            </div>
            <div class="card card-info">
                <div class="information_4">
                    <p class="information_value"><?= $total_in_production[1] ?>%</p>
                    <p class="information_text">in montage</p>
                </div>
            </div>
            <div class="card card-info">
                <div class="information_5">
                    <p class="information_value"><?= $avg_mont?> Werkdagen</p>
                    <p class="information_text">gemiddeld in montage</p>
                </div>
            </div>
            <div class="card card-info">
                <div class="information_3">
                    <p class="information_value"><?= $planned_today?> chassis</p>
                    <p class="information_text">vandaag gepland</p>
                </div>
            </div>
            <div class="card card-info">
                <div class="information_2">
                    <p class="information_value"><?= $amount_delayed?> chassis</p>
                    <p class="information_text">te laat</p>
                </div>
            </div>
<!--            <div class="chart" id="bar_chart">
                <canvas class="week-chart" id="month_chart"></canvas>
            </div>-->
        </div>
<!--        <div class="grid-child col2">
            <div class="chart" id="bar_chart">
                <canvas class="week-chart" id="week_chart"></canvas>
            </div>
        </div>-->
        <div class="grid-child col-2">
            <div class="grid-graph-child col4">
                <div class="card chart chart-row-1" id="bar_chart">
                    <canvas class="week-chart" id="this_week_chart"></canvas>
                </div>
                <div class="card chart" id="bar_chart">
                    <canvas class="week-chart" id="next_week_chart"></canvas>
                </div>
                <div class="card chart" id="bar_chart">
                    <canvas class="week-chart" id="fortnight_chart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid-child col-3">
            <div class="grid-graph-child col5">
                <div class="card chart chart-row-1" id="multiple_bar_chart">
                    <canvas id="this_week_welding_chart"></canvas>
                </div>
                <div class="card chart chart-row-1" id="multiple_bar_chart">
                    <canvas id="next_week_welding_chart"></canvas>
                </div>
                <div class="card chart" id="multiple_bar_chart">
                    <canvas id="fornight_welding_chart"></canvas>
                </div>
                <div class="card table-container">
                    <p class="table-title" id="chassis-today-table-title"></p>
                    <table class="data-table" id="chassis-today-table"></table>
                </div>
            </div>
        </div>
    </div>

<!--    <div class="all-table-container">
        <div class="table-container">
            <p class="table-title" id="chassis-this-week-table-title"></p>
            <table class="data-table" id="chassis-this-week-table"></table>
        </div>
        <div class="table-container">
            <p class="table-title" id="chassis-next-week-table-title"></p>
            <table class="data-table" id="chassis-next-week-table"></table>
        </div>
        <div class="table-container">
            <p class="table-title" id="chassis-two-weeks-table-title"></p>
            <table class="data-table" id="chassis-two-weeks-table"></table>
        </div>
    </div>-->



<!--
    <div class="chart" id="bar_chart">
        <canvas id="status_chart"></canvas>
    </div>


<div class="chart" id="bar_chart">
    <canvas id="day_chart"></canvas>
</div>
<div class="chart" id="bar_chart">
    <canvas id="stand_las_chart"></canvas>
</div>

<div class="chart" id="bar_chart">
    <canvas class="week-chart" id="year_chart"></canvas>
</div>
-->


</div>


