<script> let ChassisInKaliberIV_lines = <?php echo json_encode($ChassisInKaliberIV); ?>;</script>

<div id="map_div">
    <div id="count_chassis">
        <label id="aantalMontage"></label>
        <br>
        <label id="aantalWachtkamer"></label>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ wagennummer om te zoeken">
    </div>
</div>

<div id="search_failure_div">
    <label>Chassis niet gevonden, check Mapper voor meer informatie.</label>
</div>

<div id="image_div">
    <img id="map" class="site-map" src="<?= base_url()?>/images/plattegrond_v3.png" alt="...">
</div>


<div id="important_div">
    <h1>Belangrijke Chassis</h1>
    <div class="grid-container">
        <div id="column_0" class="grid-child col1"></div>
        <div id="column_1" class="grid-child col2"></div>
        <div id="column_2" class="grid-child col3"></div>
        <div id="column_3" class="grid-child col4"></div>
        <div id="column_4" class="grid-child col5"></div>
    </div>
</div>
