
<?php
require "db.php";
require "CollectFruitFromGarden.php";
require "InsertTreeToDB.php";
require "weightOfFruits.php";
include "templates/header.php";

$connect = new db();
$link = $connect->connectWithDB();

?>
    <body>
    <div class="container">
        <h1>Фруктовый сад ООП</h1>
        <br>
        <h3>Добавьте дерево в фруктовый сад</h3>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <div>
                    <input type="text" id="tree_id" name="tree_id" placeholder="Уникальный регистрационный номер дерева">
                    <input type="text" name="type_tree" placeholder="Разновидность дерева">
                    <input type="text" name="min_thing" placeholder="Минимальное количество плодов">
                    <input type="text" name="max_thing" placeholder="Максимальное количество плодов">
                </div>
                <br>
                <div>
                    <input type="submit" name="submit_to_insert_tree" value="Добавить" class="btn btn-primary">
                </div>
            </div>
        </form>
        <?
        if (isset($_POST['submit_to_insert_tree'])) {
            $newTree = new InsertTreeToDB($_POST['tree_id'], $_POST['type_tree'],
                $_POST['min_thing'], $_POST['max_thing']);
            $newTree->addTreeToDB($link);
        } ?>
    </div>
    <br>
    <div class="container">
        <h3>Добавить в фруктовый сад деревья (10 яблонь и 15 груш)</h3>
        <br>
        <form method="POST">
            <input type="submit" name="fill_fruit_garden" value="Добавить в фруктовый сад деревья" />
        </form>
        <?php
        if(isset( $_POST['fill_fruit_garden'] )){
            $commands = file_get_contents("autoFillGarden.sql");
            do {
                $link->multi_query($commands);
            } while ($link->next_result());
        } ?>
    </div>
    <br>
    <div class="container">
        <h3>Соберите урожай с фруктового сада</h3>
        <br>
        <form method="POST">
            <input type="submit" name="collect_fruits" value="Собрать урожай" />
        </form>
        <?php
        if(isset( $_POST['collect_fruits'] )){
            $collectFruits = new CollectFruitFromGarden();
            $amountOfAppleTrees = $collectFruits->collectApple($link);
            $amountOfPearTrees = $collectFruits->collectPear($link);

            echo "Собрано плодов с яблонь: " . $amountOfAppleTrees . "<br>";
            echo "Собрано плодов с груш: " . $amountOfPearTrees . "<br>";
            $allFruits = $amountOfAppleTrees+$amountOfPearTrees;
            echo "Итого собрано плодов с фруктового сада: " . $allFruits ."<br>";
            $weight = new weightOfFruits();
            $weightApple = $weight->totalWeightApple($amountOfAppleTrees)/1000;
            $weightPear = $weight->totalWeightPear($amountOfPearTrees)/1000;
            echo "Собрано плодов с яблонь в килограммах: " . $weightApple . "<br>";
            echo "Собрано плодов с груш в килограммах: " . $weightPear . "<br>";
            echo "Итого собрано плодов с фруктового сада в килограммах: ". ($weightApple+$weightPear) . "<br>";
        } ?>
    </div>

<?php
$link->close();
include "templates/footer.php";?>