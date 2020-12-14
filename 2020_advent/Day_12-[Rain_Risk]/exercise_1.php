<?php
require 'class/ship.php';
$input = file_get_contents("input_data.txt");

$ship = new Ship($input);
echo $ship->getDistance();

// Result 1645