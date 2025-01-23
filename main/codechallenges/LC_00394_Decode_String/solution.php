<?php

// https://leetcode.com/problems/decode-string 394
class Solution {

    /**
     * @param String $s
     * @return String
     */
    function decodeString($s) {
            
    }
}


$test = new Solution();

foreach([
    '3[a]2[bc]',
    '3[a2[c]]',
    '2[abc]3[cd]ef'
] as $data){
    print_r($test->decodeString($data));
}
