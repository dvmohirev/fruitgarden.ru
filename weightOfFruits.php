<?php
class weightOfFruits
{
    function totalWeightApple($amountApple){
        return $amountApple * rand(150, 180);
    }

    function totalWeightPear($amountPear){
        return $amountPear * rand(130, 170);
    }
}