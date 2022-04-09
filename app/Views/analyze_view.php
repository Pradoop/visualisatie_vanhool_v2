<h1>Efficiency</h1>

<?php
$file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)\TestFile.txt","r");

while(! feof($file))
{
    echo fgets($file). "<br />";
}

fclose($file);
?>
