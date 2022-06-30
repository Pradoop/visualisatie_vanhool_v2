<div id="general_information">
    <div class="dash-title">
        <div class="tab-div">
            <h1>Dashboard</h1>
        </div>
        <div class="tab">
            <button class="tablinks active" onclick="showDashboard(event, 'general-info-dash')">Planning</button>
            <button class="tablinks" onclick="showDashboard(event, 'historical-rendement-info-dash')">Historische Rendementen</button>
            <button class="tablinks" onclick="showDashboard(event, 'rendement-info-dash')">Huidige Rendementen</button>
        </div>
    </div>

    <div class="dashboard-options" id="general-info-dash">
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
            </div>
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
                        <canvas id="fortnight_welding_chart"></canvas>
                    </div>
                    <div class="card table-container">
                        <p class="table-title" id="chassis-today-table-title"></p>
                        <table class="data-table" id="chassis-today-table"></table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals for large charts -->
        <div id="modal_this_week" class="modal">
            <div class="modal-content">
                <span class="close this_week">&times;</span>
                <canvas id="this_week_chart_modal"></canvas>
            </div>
        </div>

        <div id="modal_next_week" class="modal">
            <div class="modal-content">
                <span class="close next_week">&times;</span>
                <canvas id="next_week_chart_modal"></canvas>
            </div>
        </div>

        <div id="modal_fortnight" class="modal">
            <div class="modal-content">
                <span class="close fortnight">&times;</span>
                <canvas id="fortnight_chart_modal"></canvas>
            </div>
        </div>

        <div id="modal_this_week_weld" class="modal">
            <div class="modal-content">
                <span class="close this_week_weld">&times;</span>
                <canvas id="this_week_welding_chart_modal"></canvas>
            </div>
        </div>

        <div id="modal_next_week_weld" class="modal">
            <div class="modal-content">
                <span class="close next_week_weld">&times;</span>
                <canvas id="next_week_welding_chart_modal"></canvas>
            </div>
        </div>

        <div id="modal_fortnight_weld" class="modal">
            <div class="modal-content">
                <span class="close fortnight_weld">&times;</span>
                <canvas id="fortnight_welding_chart_modal"></canvas>
            </div>
        </div>
    </div>

    <div class="dashboard-options" id="historical-rendement-info-dash" style="display: none">
        <div class="historical-rendement-grid-container">
            <div class="grid-child col1">
                <div class="card card-1">
                    <div class="information_2">
                        <p class="information_value"><?= $amount_montage[0]?> chassis</p>
                        <p class="information_text">af laatste 20 werkdagen</p>
                    </div>
                </div>
                <div class="card rendement-card-info">
                    <div class="information_2">
                        <p class="information_value"><?= $amount_overtime[0]?> chassis</p>
                        <p class="information_text">geplande uren overschreden laatste 20 werkdagen</p>
                    </div>

                </div>
                <div class="card rendement-card-info">
                    <div class="information_5">
                        <p class="information_value"><?= $average_worked_hours[0]?> uren </p>
                        <p class="information_text">gemiddeld gewerkt laatste 20 werkdagen</p>
                    </div>
                </div>
                <div class="card rendement-card-info">
                    <div class="information_1">
                        <p class="information_value"><?= $average_planned_hours[0] ?> uren </p>
                        <p class="information_text">gemiddeld gepland laatste 20 werkdagen</p>
                    </div>
                </div>
            </div>
            <div class="grid-child col-2">
                <div class="grid-graph-child col4">
                    <div class="card chart chart-row-1" id="bar_chart">
                        <canvas class="week-chart" id="three_weeks_ago_rendement_chart"></canvas>
                    </div>
                    <div class="card chart" id="bar_chart">
                        <canvas class="week-chart" id="two_weeks_ago_rendement_chart"></canvas>
                    </div>
                    <div class="card chart" id="bar_chart">
                        <canvas class="week-chart" id="last_week_rendement_chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="grid-child col-3">
                <div class="grid-graph-child col5">
                    <div class="card chart chart-row-1" id="bar_chart">
                        <canvas class="week-chart" id="this_week_rendement_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-options" id="rendement-info-dash"  style="display: none">
        <div class="rendement-grid-container">
            <div class="grid-child col1">
                <div class="card card-1">
                    <div class="information_4">
                        <p class="information_value"><?= $average_planned_hours[1] ?> uren </p>
                        <p class="information_text">gemiddeld gepland</p>
                    </div>
                </div>
                <div class="card rendement-card-info">
                    <div class="information_3">
                        <p class="information_value"><?=$average_worked_hours[1]?> uren </p>
                        <p class="information_text">gemiddeld gewerkt</p>
                    </div>
                </div>
                <div class="card rendement-card-info">
                    <div class="information_2">
                        <p class="information_value"><?= $amount_overtime[1]?> chassis </p>
                        <p class="information_text">in montage geplande uren overschreden</p>
                    </div>
                </div>
                <div class="card rendement-card-info">
                    <div class="information_2">
                        <p class="information_value"><?= $amount_montage[1]?> chassis </p>
                        <p class="information_text">in montage</p>
                    </div>
                </div>
            </div>
            <div class = "card-rendement-table">
                <p class="table-title" id="current-rendement-table-title"></p>
                <div class="rendement-table-container">
                    <table class="data-table" id="current-rendement-table"></table>
                </div>
            </div>
        </div>
    </div>
</div>


