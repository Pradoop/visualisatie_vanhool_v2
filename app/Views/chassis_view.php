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
