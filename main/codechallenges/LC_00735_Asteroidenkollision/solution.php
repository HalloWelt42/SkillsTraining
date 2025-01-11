<?php 

class Solution {

    /**
     * @param Integer[] $asteroids
     * @return Integer[]
     */
    function asteroidCollision($asteroids) {
        echo "hallo Helt";
    }
}

$test = new Solution();

foreach([
    [5,10,-5],[8,-8],[10,2,-5]
] as $data){
    $test->asteroidCollision($data);
}
