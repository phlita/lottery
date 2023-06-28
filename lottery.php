<?php 
function ssq($num) {//双色球
            $result = array();
            for ($i = 0; $i < $num; $i++) {
                $redBalls = range(1, 33);
                $blueBalls = range(1, 16);
                $red = array();
                for ($j = 0; $j < 6; $j++) {
                    $index = array_rand($redBalls);
                    $red[] = $redBalls[$index];
                    unset($redBalls[$index]);
                }   //sort($red);
                $index = array_rand($blueBalls);
                $blue = array($blueBalls[$index]);
                $result[] = array_merge($red, $blue);
            } return $result; }

function dlt($num) {//大乐透
    $result = array();
    for ($i = 0; $i < $num; $i++) {
        $redBalls = range(1, 35);
        $blueBalls = range(1, 12);
        $red = array();
        for ($j = 0; $j < 5; $j++) {
            $index = array_rand($redBalls);
            $red[] = $redBalls[$index];
            unset($redBalls[$index]);
        }        //sort($red);
        $index = array_rand($blueBalls);
        $blue1 = array($blueBalls[$index]);
        unset($blueBalls[$index]);
        $index = array_rand($blueBalls);
        $blue2 = array($blueBalls[$index]);
        $result[] = array_merge($red, $blue1, $blue2);
    }    return $result;}
	
	function powerball($num) {
    $result = array();
    for ($i = 0; $i < $num; $i++) {
        $whiteBalls = range(1, 69);
        $redBalls = range(1, 26);
        $white = array();
        for ($j = 0; $j < 5; $j++) {
            $index = array_rand($whiteBalls);
            $white[] = $whiteBalls[$index];
            unset($whiteBalls[$index]);
        }
        sort($white);
        $index = array_rand($redBalls);
        $red = array($redBalls[$index]);
        $result[] = array_merge($white, $red);
    }
    return $result;
}