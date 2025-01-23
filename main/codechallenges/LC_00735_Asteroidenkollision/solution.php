<?php 

// https://leetcode.com/problems/asteroid-collision 735
class Solution {

    /**
     * @param Integer[] $asteroids
     * @return Integer[]
     */
    function asteroidCollision($asteroids) {
        $collision = true;
        while($collision){
            $asteroids = array_values($asteroids);
            $collision = false;
            $count = count($asteroids);
            if($count < 2){
                break;
            }
            for($i=0;$i<$count-1;$i++){
                $dir_a = $asteroids[$i] > 0 ? '->' : '<-';
                $dir_b = $asteroids[$i+1] > 0 ? '->' : '<-';
                if(
                    ($dir_a === '<-') || 
                    ($dir_a === '->' && $dir_b === '->')
                ){
                    continue;
                }

                if($dir_a === '->' && $dir_b === '<-'){
                    $collision = true;
                    $chk = $asteroids[$i] <=> abs($asteroids[$i+1]);
                    switch($chk){
                        case -1:
                            unset($asteroids[$i]);
                            $i++;
                            break;
                        case 1: 
                            unset($asteroids[$i+1]);
                            break;
                        case 0: 
                            unset($asteroids[$i],$asteroids[$i+1]);
                            $i++;
                            break;
                    }
                    continue;
                }
            }
        }
        return $asteroids;
    }
}

$test = new Solution();

foreach([
#    [5,10,-5],
#    [8,-8],
#    [10,2,-5],
#    [5,10,-5],
#    [8,-8],
#    [10,2,-5],
#    [-1,-2,2,1],
#    [-1,1,-2,2,-3,4],
#    [-1,-1,1,-1,5],
#    [1,-2,-2,-2],
    [46, -36, 3, 39, 20, -33, 35, 4, -26, -37, 27, -50, -23, 48, 5, -1, 29, -34, 34, 11 , 22, 8, 41, -20, -10, 17, 35, -14, -9, 3, 12, -13, -47, 23, -39, 25, -43, -2, 26, -26, -42, -5, -4, 34, 3, 25, 20, 27, -6],
#     [46, -36, 3, 39, 20, -33, 35, 4, -26, -37, 27, -50] # [-50]
] as $data){
    print_r($test->asteroidCollision($data));
}
