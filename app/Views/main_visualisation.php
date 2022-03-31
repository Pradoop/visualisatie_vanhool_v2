<div class="flex-container">
    <div id="map_div" class="flex-child map">
        <img id="map" class="site-map" src="<?= base_url()?>/images/map_hal5_hal6.png" alt="...">
    </div>
    <div id="important_div" class="flex-child important">
        <h1>Important</h1>
        <div id="list_important_chassis">
            <?php foreach($important as $i): ?>
                <p id="<?= 'chassis_'.$i?>"> Chassis_nr <?= $i ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div id="all_chassis_div">
    <h1>All chassis</h1>
    <div class="grid-container">
        <div class="grid-child left">
            <?php foreach($total as $t): ?>
                <p id="<?= 'chassis_'.$t?>"> Chassis_nr <?= $t ?></p>
            <?php endforeach; ?>
        </div>
        <div class="grid-child center_left">
            <?php foreach($total as $t): ?>
                <p id="<?= 'chassis_'.$t?>"> Chassis_nr <?= $t ?></p>
            <?php endforeach; ?>
        </div>
        <div class="grid-child center_right">
            <?php foreach($total as $t): ?>
                <p id="<?= 'chassis_'.$t?>"> Chassis_nr <?= $t ?></p>
            <?php endforeach; ?>
        </div>
        <div class="grid-child right">
            <?php foreach($total as $t): ?>
                <p id="<?= 'chassis_'.$t?>"> Chassis_nr <?= $t ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>
