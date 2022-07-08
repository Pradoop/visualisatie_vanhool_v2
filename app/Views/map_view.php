<script> let ChassisInKaliberIV_lines = <?php echo json_encode($ChassisInKaliberIV); ?>;</script>

<div id="map_div">
    <div id="count_chassis">
        <label id="aantalMontage"></label>
        <br>
        <label id="aantalWachtkamer"></label>
    </div>
    <div id="legende_1">
        <span id="legende_wachtkamer" class="dot_wachtkamer" tabindex="0"></span>
        <label>Chassis klaar voor montage</label>
        <input type="image" id="wachtkamer_i" class="info_icon" src="<?= base_url()?>/images/icons8-information-15.png" alt="...">
        <br>
        <span id="legende_kalibers" class="dot_kalibers" tabindex="0"></span>
        <label>Chassis in samenstelkaliber</label>
    </div>
    <div id="legende_2">
        <span id="legende_kalibers_las" class="dot_kalibers_las" tabindex="0"></span>
        <label>Chassis in laskaliber</label>
        <br>
        <span id="legende_buffer" class="dot_buffers" tabindex="0"></span>
        <label>Chassis in bufferzone</label>
    </div>
    <div id="legende_3">
        
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
