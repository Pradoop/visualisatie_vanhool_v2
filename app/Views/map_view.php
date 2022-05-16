<script> let ChassisInKaliberIV_lines = <?php echo json_encode($ChassisInKaliberIV); ?>;</script>

<div id="map_div">
    <div id="afdelingNaam">
        <h1>Industriële Voertuigen: hal 5 en hal 6</h1>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ om te zoeken">
    </div>
</div>

<div id="image_div">
    <img id="map" class="site-map" src="<?= base_url()?>/images/map_hal5_hal6.png" alt="...">
</div>

<?php
    $chassisInMontage_array = array();
    foreach($planningMontage as $chassis) {
        $line_array = preg_split('/\t/', $chassis);
        if(isset($line_array[17]) && $line_array[17] != '  ') {
            array_push($chassisInMontage_array, $chassis);
        }
    }
?>

<div id="important_div">
    <h1>Important Chassis</h1>
    <div class="grid-container">
        <div class="grid-child col1">
            <?php $i = 1; ?>
            <?php while($i < sizeof($chassisInMontage_array)): ?>
                <?php $line_array = preg_split('/\t/', $chassisInMontage_array[$i]); ?>
                    <p id="<?= 'chassis_'.$i?>" onclick="focusDot(<?= $i ?>)"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
        <div class="grid-child col2">
            <?php $i = 2; ?>
            <?php while($i < sizeof($chassisInMontage_array)): ?>
                <?php $line_array = preg_split('/\t/', $chassisInMontage_array[$i]); ?>
                <p id="<?= 'chassis_'.$i?>" onclick="focusDot(<?= $i ?>)"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
        <div class="grid-child col3">
            <?php $i = 3; ?>
            <?php while($i < sizeof($chassisInMontage_array)): ?>
                <?php $line_array = preg_split('/\t/', $chassisInMontage_array[$i]); ?>
                <p id="<?= 'chassis_'.$i?>" onclick="focusDot(<?= $i ?>)"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
        <div class="grid-child col4">
            <?php $i = 4; ?>
            <?php while($i < sizeof($chassisInMontage_array)): ?>
                <?php $line_array = preg_split('/\t/', $chassisInMontage_array[$i]); ?>
                <p id="<?= 'chassis_'.$i?>" onclick="focusDot(<?= $i ?>)"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
        <div class="grid-child col5">
            <?php $i = 5; ?>
            <?php while($i < sizeof($chassisInMontage_array)): ?>
                <?php $line_array = preg_split('/\t/', $chassisInMontage_array[$i]); ?>
                <p id="<?= 'chassis_'.$i?>" onclick="focusDot(<?= $i ?>)"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>
