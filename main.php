
<?php
require_once "db.php";
require "CollectFruitFromGarden.php";
require "InsertTreeToDB.php";
require "weightOfFruits.php";

$connect = new db();
$link = $connect->connectWithDB();

$commands = file_get_contents("autoFillGarden.sql");
do {
    $link->multi_query($commands);
} while ($link->next_result());
    $collectFruits = new CollectFruitFromGarden();
    $amountOfAppleTrees = $collectFruits->collectApple($link);
    $amountOfPearTrees = $collectFruits->collectPear($link);

    echo "Собрано плодов с яблонь: " . $amountOfAppleTrees . "\n";
    echo "Собрано плодов с груш: " . $amountOfPearTrees . "\n";
    $allFruits = $amountOfAppleTrees+$amountOfPearTrees;
    echo "Итого собрано плодов с фруктового сада: " . $allFruits . "\n";

    $weight = new weightOfFruits();
    $weightApple = $weight->totalWeightApple($amountOfAppleTrees)/1000;
    $weightPear = $weight->totalWeightPear($amountOfPearTrees)/1000;
    echo "Собрано плодов с яблонь в килограммах: " . $weightApple . "\n";
    echo "Собрано плодов с груш в килограммах: " . $weightPear . "\n";
    echo "Итого собрано плодов с фруктового сада в килограммах: ". ($weightApple+$weightPear) . "\n";