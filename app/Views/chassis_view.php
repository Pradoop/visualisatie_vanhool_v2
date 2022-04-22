<div id="table_title">
    <h1>Industriële Voertuigen: hal 5 en hal 6</h1>
</div>
<div class="grid-container">
    <table>
        <thead>
        <tr>
            <th><?= $chassis_info[0][0] ?></th>
            <th><?= $chassis_info[0][2] ?></th>
            <th><?= $chassis_info[0][3] ?></th>
            <th><?= $chassis_info[0][5] ?></th>
            <th><?= $chassis_info[0][7] ?></th>
            <th><?= $chassis_info[0][9] ?></th>
            <th><?= $chassis_info[0][10] ?></th>
            <th><?= $chassis_info[0][14] ?></th>
            <th><?= $chassis_info[0][16] ?></th>
            <th><?= $chassis_info[0][17] ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <tr>
                <td><?= $chassis_info[$lijn_nr][0] ?></td>
                <td><?= $chassis_info[$lijn_nr][2] ?></td>
                <td><?= $chassis_info[$lijn_nr][3] ?></td>
                <td><?= $chassis_info[$lijn_nr][5] ?></td>
                <td><?= $chassis_info[$lijn_nr][7] ?></td>
                <td><?= $chassis_info[$lijn_nr][9] ?></td>
                <td><?= $chassis_info[$lijn_nr][10] ?></td>
                <td><?= $chassis_info[$lijn_nr][14] ?></td>
                <td><?= $chassis_info[$lijn_nr][16] ?></td>
                <td><?= $chassis_info[$lijn_nr][17] ?></td>
            </tr>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>

        </tbody>
    </table>
</div>
