<script src="https://d3js.org/d3.v7.min.js"></script>
<script > let BASE_URL = "<?=base_url();?>";</script>


<div id="general_information">
    <h1>Dashboard</h1>
    <div class="grid-container">
        <div class="grid-child col1">
            <div class="information_1">
                <p class="information_text"> Aantal chassis in productie:</p>
                <p class="information_value"><?= $total_in_production[0] ?> chassis</p>
            </div>
            <div class="chart" id="bar_chart">

            </div>
        </div>
        <div class="grid-child col2">
            <div class="information_2">
                <p class="information_text"> Percentage chassis vertraagd T.O.V. contractdatum:</p>
                <p class="information_value"><?= $percentage_delayed ?> %</p>
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
                <p class="information_text"> Gemiddelde tijd om één chassis in productie af te werken:</p>
                <table>
                    <?php foreach($welding_percentages as $key=>$value): ?>
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


