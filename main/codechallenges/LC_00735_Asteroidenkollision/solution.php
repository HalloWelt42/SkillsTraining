<?php 

// https://leetcode.com/problems/asteroid-collision
class Solution {

    /**
     * @param Integer[] $asteroids
     * @return Integer[]
     */
    function asteroidCollision($asteroids) {
        
    }
}

$test = new Solution();

foreach([
    [5,10,-5],[8,-8],[10,2,-5]
] as $data){
    $test->asteroidCollision($data);
}
