<?php
class CollectFruitFromGarden
{

    function collectApple($conn){
        $result = $conn->query("SELECT min_thing, max_thing FROM trees WHERE type_tree = 'яблоня'");
        $collectFromAppleTrees = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $collectFromAppleTrees += rand($row['min_thing'], $row['max_thing']);
        }
        return $collectFromAppleTrees;
    }

    function collectPear($conn){
        $result = $conn->query("SELECT min_thing, max_thing FROM trees WHERE type_tree = 'груша'");
        $collectFromPearTrees = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $collectFromPearTrees += rand($row['min_thing'], $row['max_thing']);
        }
        return $collectFromPearTrees;
    }
}