<div id="table_title">
    <div id="afdelingNaam_div">
        <div id="afdelingNaam">
            <h1>
                Industriële Voertuigen: hal 5 en hal 6
            </h1>
        </div>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Filters
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li>
                <input class="form-check-input" type="checkbox" id="gegalvaniseerd-filter">
                <label class="form-check-label" for="gegalvaniseerd-filter">Gegalvaniseerde wagens</label>
            </li>
        </ul>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ om te zoeken">
    </div>
</div>

<h2 class="inspect-data-loading">
    Bezig met laden...
</h2>

<div id="table_content">
    <table id="chassis_table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th id="th0">Wagennummer</th>
            <th id="th1">Datum in Montage</th>
            <th id="th2">Datum uit Montage</th>
            <th id="th3">Kaliber</th>
            <th id="th4">Gewerkte uren</th>
            <th id="th5">Geplande uren</th>
            <th id="th6">Klantnaam</th>
            <th id="th7">Naamtype</th>
            <th id="th8">Land</th>
            <th id="th9">Reekshoofd</th>
            <th id="th10">Reekseinde</th>
        </tr>
        </thead>
        <tbody id="myTable">
        <?php $row_id = 1; ?>
        <?php while($row_id < sizeof($data_lines)): ?>
            <tr id="<?= 'primary_'.$row_id ?>">
                <?php
                $array = preg_split('/!/', $data_lines[$row_id]);
                echo "<td>{$array[0]}</td>";
                echo "<td>{$array[1]}</td>";
                echo "<td>{$array[2]}</td>";
                echo "<td>{$array[3]}</td>";
                echo "<td>{$array[4]}</td>";
                echo "<td>{$array[5]}</td>";
                echo "<td>{$array[6]}</td>";
                echo "<td>{$array[7]}</td>";
                echo "<td>{$array[8]}</td>";
                echo "<td>{$array[9]}</td>";
                echo "<td>{$array[10]}</td>";
                ?>
            </tr>
            <?php $row_id++; ?>
        <?php endwhile; ?>
        </tbody>
    </table>
    <div id="count_div">
        <p id="count_div_text">1 tot <?= sizeof($data_lines) ?> van <?= sizeof($data_lines) ?> resultaten</p>
    </div>
</div>
