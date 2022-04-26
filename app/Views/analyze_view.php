<div id="general_information">
    <h1>Dashboard</h1>
    <div class="grid-container">
        <div class="grid-child col1">
            <div class="information_1">
                <p class="information_text"> Aantal chassis in productie:</p>
                <p class="information_value"><?= $total_in_production[0] ?> chassis</p>
            </div>
            <div class="chart" id="bar_chart">
                <canvas id="stand_las_chart"></canvas>
            </div>
        </div>
        <div class="grid-child col2">
            <div class="information_2">
                <p class="information_text"> Percentage chassis vertraagd T.O.V. contractdatum:</p>
                <p class="information_value"><?= $percentage_delayed ?> %</p>
            </div>
            <div class="chart" id="bar_chart">
                <canvas id="status_chart"></canvas>
            </div>
        </div>
        <div class="grid-child col3">
            <div class="information_3">
                <p class="information_text"> Gemiddeld aantal werkdagen te laat T.O.V. contractdatum:</p>
                <p class="information_value"><?= $average_delay ?> dagen</p>
            </div>

        </div>
        <div class="grid-child col4">
            <div class="information_4">
                <p class="information_text"> Percentage chassis in productielijn:</p>
                <p class="information_value"><?= $total_in_production[1] ?> %</p>
            </div>
        </div>
        <div class="grid-child col5">
            <div class="information_5">
                <p class="information_text"> DATA TESTZONE:</p>
                <table>
                    <?php foreach(json_decode($chassis_phase) as $key=>$value): ?>
                        <tr>
                            <td><?= $key; ?></td>
                            <td><?= $value; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </div>
</div>


