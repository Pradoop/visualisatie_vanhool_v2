<?php
$file = fopen("","r");

while(! feof($file))
{
    echo fgets($file). "<br />";
}
fclose($file);
?>

