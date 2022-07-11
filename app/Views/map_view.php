<script> let ChassisInKaliberIV_lines = <?php echo json_encode($ChassisInKaliberIV); ?>;</script>

<div id="map_div">
    <div id="legende_1">
        <label id="aantalWachtkamer"></label>
        <br>
        <span id="legende_wachtkamer" class="dot_wachtkamer" tabindex="0"></span>
        <label>Wagens klaar voor montage</label>
        <input type="image" id="wachtkamer_i" class="info_icon" src="<?= base_url()?>/images/icons8-information-15.png" alt="...">
    </div>
    <div id="legende_2">
        <label id="aantalBuffer"></label>
        <br>
        <span id="legende_buffer" class="dot_buffer" tabindex="0"></span>
        <label>Wagens in bufferzone</label>
        <input type="image" id="buffer_i" class="info_icon" src="<?= base_url()?>/images/icons8-information-15.png" alt="...">
    </div>
    <div id="legende_3">
        <span id="legende_kalibers" class="dot_K_kaliber" tabindex="0"></span>
        <label>Wagens in K-kaliber</label>
        <br>
        <span id="legende_kalibers_las" class="dot_L_kaliber" tabindex="0"></span>
        <label>Wagens in L-kaliber</label>
    </div>
    <div id="legende_4">
        <label id="aantalMontage"></label>
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
    <div id="list_chassis">
    </div>
</div>
