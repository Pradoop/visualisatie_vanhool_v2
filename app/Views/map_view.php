<script > let file_lines = <?php echo json_encode($file_lines); ?>;</script>

<div id="map_div">
    <h1>Hal 5 & Hal 6</h1>
    <img id="map" class="site-map" src="<?= base_url()?>/images/map_hal5_hal6.png" alt="...">
</div>

<div id="important_div">
    <h1>Important Chassis</h1>
    <div class="grid-container">
        <div class="grid-child col1">
            <?php $i = 1; ?>
            <?php while($i < sizeof($file_lines)): ?>
                <?php $line_array = preg_split('/\t/', $file_lines[$i]); ?>
                <p id="<?= 'chassis_'.$i?>"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
        <div class="grid-child col2">
            <?php $i = 2; ?>
            <?php while($i < sizeof($file_lines)): ?>
                <?php $line_array = preg_split('/\t/', $file_lines[$i]); ?>
                <p id="<?= 'chassis_'.$i?>"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
        <div class="grid-child col3">
            <?php $i = 3; ?>
            <?php while($i < sizeof($file_lines)): ?>
                <?php $line_array = preg_split('/\t/', $file_lines[$i]); ?>
                <p id="<?= 'chassis_'.$i?>"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
        <div class="grid-child col4">
            <?php $i = 4; ?>
            <?php while($i < sizeof($file_lines)): ?>
                <?php $line_array = preg_split('/\t/', $file_lines[$i]); ?>
                <p id="<?= 'chassis_'.$i?>"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
        <div class="grid-child col5">
            <?php $i = 5; ?>
            <?php while($i < sizeof($file_lines)): ?>
                <?php $line_array = preg_split('/\t/', $file_lines[$i]); ?>
                <p id="<?= 'chassis_'.$i?>"><?= $line_array[0] ?></p>
                <?php $i = $i + 5; ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>
