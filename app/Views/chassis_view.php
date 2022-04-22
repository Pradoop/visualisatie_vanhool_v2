<script > let chassis_info = <?php echo json_encode($chassis_info); ?>;</script>

<div class="grid-container">
    <?php $kolom_nr = 0; ?>
    <div class="grid-child">
        <!-- Wagen !-->
        <h2><?= $chassis_info[0][0] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- EW !-->
        <h2><?= $chassis_info[0][1] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <?php if($chassis_info[$lijn_nr][$kolom_nr] != ' '): ?>
                <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php else: ?>
                <p>&nbsp;</p>
            <?php endif; ?>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- Aantal !-->
        <h2><?= $chassis_info[0][2] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- dtmGepland !-->
        <h2><?= $chassis_info[0][3] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- WagTyp !-->
        <h2><?= $chassis_info[0][4] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- naamWagTyp !-->
        <h2><?= $chassis_info[0][5] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- KlantNr !-->
        <h2><?= $chassis_info[0][6] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- naamKlant !-->
        <h2><?= $chassis_info[0][7] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- Land !-->
        <h2><?= $chassis_info[0][8] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- LijnNr !-->
        <h2><?= $chassis_info[0][9] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- ReeksVan !-->
        <h2><?= $chassis_info[0][10] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- Afdeling !-->
        <h2><?= $chassis_info[0][11] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- Galva !-->
        <h2><?= $chassis_info[0][12] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <?php if($chassis_info[$lijn_nr][$kolom_nr] != ' '): ?>
                <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php else: ?>
                <p>&nbsp;</p>
            <?php endif; ?>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- DLNR !-->
        <h2><?= $chassis_info[0][13] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- Status !-->
        <h2><?= $chassis_info[0][14] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- CntrDtm !-->
        <h2><?= $chassis_info[0][15] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- wdTeLaat !-->
        <h2><?= $chassis_info[0][16] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- wdInMont !-->
        <h2><?= $chassis_info[0][17] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <?php if(is_numeric($chassis_info[$lijn_nr][$kolom_nr])): ?>
                <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php else: ?>
                <p>&nbsp;</p>
            <?php endif; ?>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
    <?php $kolom_nr++; ?>
    <div class="grid-child">
        <!-- standLas !-->
        <h2><?= $chassis_info[0][18] ?></h2>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <?php if(str_starts_with($chassis_info[$lijn_nr][$kolom_nr], 'L')): ?>
                <p><?= $chassis_info[$lijn_nr][$kolom_nr] ?></p>
            <?php else: ?>
                <p>&nbsp;</p>
            <?php endif; ?>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>
    </div>
</div>
