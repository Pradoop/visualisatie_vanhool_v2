<script > let chassis_info = <?php echo json_encode($chassis_info); ?>;</script>

<div id="map_div">
    <h1>Hal 5 & Hal 6</h1>
    <img id="map" class="site-map" src="<?= base_url()?>/images/map_hal5_hal6.png" alt="...">
</div>

<div id="important_div">
    <h1>Important</h1>
    <?php $i = 1; ?>
    <?php while($i < sizeof($chassis_info)): ?>
        <p id="<?= 'chassis_'.$i?>"><?= $chassis_info[$i][1] ?></p>
        <?php $i++; ?>
    <?php endwhile; ?>
</div>
