<script src="https://d3js.org/d3.v7.min.js"></script>


<div id="general_information">
    <h1>Dashboard</h1>
    <div class="grid-container">
        <div class="grid-child col1">
            <div class="information_1">
                <p class="information_text"> Aantal chassis in productie:</p>
                <p class="information_value"><?= $total_in_production ?></p>

            </div>
        </div>
        <div class="grid-child col2">
            <div class="information_2">
                <p class="information_text"> Percentage chassis vertraagd:</p>
            </div>
        </div>
        <div class="grid-child col3">
            <div class="information_3">
                <p class="information_text"> Gemiddeld aantal werkdagen te laat:</p>
                <p class="information_value"><?= $average_delay ?></p>
            </div>
        </div>
        <div class="grid-child col4">
            <div class="information_4">
                <p class="information_text"> Percentage chassis in productielijn:</p>
            </div>
        </div>
        <div class="grid-child col5">
            <div class="information_5">
                <p class="information_text"> TBA</p>
            </div>
        </div>
    </div>

</div>


