<?php

class db
{
    public function __construct()
    {
    }

    function connectWithDB(){
        $servername='localhost';
        $username='root';
        $password='';
        $dbname = "fruitgarden";
        $link = new mysqli($servername,$username,$password,"$dbname");
        if(!$link){
            print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
        }
        return $link;
    }
}