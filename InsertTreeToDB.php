<?php

class InsertTreeToDB
{
    var $tree_id;
    var $type_tree;
    var $min_thing;
    var $max_thing;

    /**
     * @param $tree_id
     * @param $type_tree
     * @param $min_thing
     * @param $max_thing
     * @param $thing_name
     */
    public function __construct($tree_id, $type_tree, $min_thing, $max_thing)
    {
        $this->tree_id = $tree_id;
        $this->type_tree = $type_tree;
        $this->min_thing = $min_thing;
        $this->max_thing = $max_thing;
    }

    function addTreeToDB($connect){
        $requestInsertTreeToDB = "INSERT INTO trees (tree_id, type_tree, min_thing, max_thing) VALUES(
                        '$this->tree_id', '$this->type_tree', '$this->min_thing', '$this->max_thing')";
        if (mysqli_query($connect, $requestInsertTreeToDB)){
            echo "Дерево успешно добавлено";
        } else "Дерево не добавлено";
    }

    //написать проверку на ID в БД
}