<div id="table_title">
    <div id="afdelingNaam">
        <h1>Industriële Voertuigen: hal 5 en hal 6</h1>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ om te zoeken">
    </div>
    <div id="filter">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
            Filters
        </button>
    </div>
</div>

<div class="grid-container">
    <table>
        <?php $title_array = preg_split('/\t/', $chassis_info[0]); ?>
        <thead>
            <tr>
                <th><?= $title_array[0] ?></th>
                <th><?= $title_array[2] ?></th>
                <th><?= $title_array[3] ?></th>
                <th><?= $title_array[5] ?></th>
                <th><?= $title_array[7] ?></th>
                <th><?= $title_array[9] ?></th>
                <th><?= $title_array[10] ?></th>
                <th><?= $title_array[14] ?></th>
                <th><?= $title_array[16] ?></th>
                <th><?= $title_array[17] ?></th>
            </tr>
        </thead>

        <?php
        $chassis_array = array();
        $index = 1;
        while($index < sizeof($chassis_info) - 1) {
            $array = preg_split('/\t/', $chassis_info[$index]);
            unset($array[1],$array[4],$array[6],$array[8],$array[11],$array[12],$array[13],$array[15],$array[18],$array[19]);
            array_push($chassis_array, $array);
            $index++;
        }
        ?>

        <tbody>
            <?php
            foreach ($chassis_array as $row) {
                echo '<tr>';
                foreach ($row as $item) {
                    echo "<td>{$item}</td>";
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
