<div id="map_div">
    <img id="map" class="site-map" src="<?= base_url()?>/images/map_hal5_hal6.png" alt="...">
</div>

<div id="important_div">
    <h1>Important Chassis</h1>
    <div class="grid-container">
        <?php $div_counter = 1; ?>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>

            <?php if($div_counter == 1): ?>
                <div class="grid-child left">
                    <p id="<?= 'chassis_'.$chassis_info[$i][1]?>"><?= $chassis_info[$i][1] ?></p>
                </div>
            <?php endif; ?>

            <?php if($div_counter == 2): ?>
                <div class="grid-child center_left">
                    <p id="<?= 'chassis_'.$chassis_info[$i][1]?>"><?= $chassis_info[$i][1] ?></p>
                </div>
            <?php endif; ?>

            <?php if($div_counter == 3): ?>
                <div class="grid-child center_right">
                    <p id="<?= 'chassis_'.$chassis_info[$i][1]?>"><?= $chassis_info[$i][1] ?></p>
                </div>
            <?php endif; ?>

            <?php if($div_counter == 4): ?>
                <div class="grid-child right">
                    <p id="<?= 'chassis_'.$chassis_info[$i][1]?>"><?= $chassis_info[$i][1] ?></p>
                </div>
            <?php endif; ?>

            <?php if($div_counter == 5): ?>
                <div class="grid-child right">
                    <p id="<?= 'chassis_'.$chassis_info[$i][1]?>"><?= $chassis_info[$i][1] ?></p>
                </div>
            <?php endif; ?>

            <?php $i++; ?>
            <?php $div_counter++; ?>
            <?php if($div_counter > 5): ?>
                <?php $div_counter = 1; ?>
            <?php endif; ?>

        <?php endwhile; ?>
    </div>
</div>
