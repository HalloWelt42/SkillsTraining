<?php

// https://leetcode.com/problems/decode-string 394
class Solution {

    /**
     * @param String $s
     * @return String
     */
    function decodeString($s) {
        while (preg_match('/(\d+)\[([a-zA-Z]*)\]/', $s, $matches)) {
            $repeatCount = (int)$matches[1];
            $subString = $matches[2];
            $decoded = str_repeat($subString, $repeatCount);
            $s = str_replace($matches[0], $decoded, $s);
        }
        return $s;
    }
}


$test = new Solution();

foreach([
    '3[a]2[bc]',
    '3[a2[c]]',
    '2[abc]3[cd]ef'
] as $data){
    print_r($test->decodeString($data).PHP_EOL);

}
