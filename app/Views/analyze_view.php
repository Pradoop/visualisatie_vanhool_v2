<div id="general_information">
    <h1>Algemene Planning</h1>
    <div class="grid-container">
        <div class="grid-child col1">
            <div class="card">
                <div class="information_1">
                    <p class="information_value"><?= $total_in_production[0] ?></p>
                    <p class="information_text"> chassis in productie</p>
                </div>
            </div>
            <div class="chart" id="bar_chart">
                <canvas class="week-chart" id="month_chart"></canvas>
            </div>
        </div>
        <div class="grid-child col2">
            <div class="card">
                <div class="information_4">
                    <p class="information_value"><?= $total_in_production[1] ?>%</p>
                    <p class="information_text"> in productie</p>
                </div>
            </div>
            <div class="chart" id="bar_chart">
                <canvas class="week-chart" id="week_chart"></canvas>
            </div>
        </div>
        <div class="grid-child col3">
            <div class="card">
                <div class="information_5">
                    <p class="information_value"><?= $avg_mont?> Werkdagen</p>
                    <p class="information_text"> gemiddeld in montage</p>
                </div>
            </div>
            <div class="chart" id="bar_chart">
                <canvas class="week-chart" id="this_week_chart"></canvas>
            </div>
        </div>
        <div class="grid-child col4">
            <div class="card">
                <div class="information_3">
                    <p class="information_value"><?= $average_delay ?> Werkdagen</p>
                    <p class="information_text"> laat tov contractdatum</p>
                </div>

            </div>
            <div class="chart" id="bar_chart">
                <canvas class="week-chart" id="next_week_chart"></canvas>
            </div>
        </div>
        <div class="grid-child col5">
            <div class="card">
                <div class="information_2">
                    <p class="information_value"><?= $percentage_delayed ?>%</p>
                    <p class="information_text"> vertraagd tov contractdatum</p>
                </div>
            </div>
            <div class="chart" id="bar_chart">
                <canvas class="week-chart" id="fortnight_chart"></canvas>
            </div>
        </div>
    </div>
    <div class="grid-container-2">
        <div id="bar_chart">
            <canvas class="chart-2" id="this_week_welding_chart"></canvas>
        </div>
        <div id="bar_chart">
            <canvas id="next_week_welding_chart"></canvas>
        </div>
    </div>

    <div class="chart" id="bar_chart">
        <canvas id="status_chart"></canvas>
    </div>
    <div class="chart" id="bar_chart">
        <canvas id="day_chart"></canvas>
    </div>
    <div class="somediv">
        <table id="chassis-today-table">
        </table>
        <p class="information_text">Chassis voor vandaag gepland</p>
    </div>
    <div class="chart" id="bar_chart">
        <canvas id="stand_las_chart"></canvas>
    </div>
    <div class="chart" id="bar_chart">
        <canvas class="week-chart" id="year_chart"></canvas>
    </div>


</div>


