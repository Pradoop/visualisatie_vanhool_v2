<script > let chassis_info = <?php echo json_encode($chassis_info); ?>;</script>

<div class="grid-container">
    <div class="grid-child">
        <h2><?= $chassis_info[0][0] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][1] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][1] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][2] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][2] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][3] ?> <?= $chassis_info[$i][4] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][3] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][5] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][4] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][6] ?> <?= $chassis_info[$i][7] ?> <?= $chassis_info[$i][8] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][5] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][9] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][6] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][10] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][7] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][11] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][8] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][12] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
    <div class="grid-child">
        <h2><?= $chassis_info[0][9] ?></h2>
        <?php $i = 1; ?>
        <?php while($i < sizeof($chassis_info)): ?>
            <p><?= $chassis_info[$i][13] ?></p>
            <?php $i++; ?>
        <?php endwhile; ?>
    </div>
</div>
