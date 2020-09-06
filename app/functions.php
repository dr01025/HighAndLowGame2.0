<?php

function cardSet(){
    $marks = ['club','diamond','heart','spade'];
    $numbers = [1,2,3,4,5,6,7,8,9,10,11,12,13];
    $id = 0;

    foreach($marks as $mark){
        foreach($numbers as $number){
            $cards[$id]=['mark'=>$mark,'number'=>$number];
            $id ++;
        }
    }
    shuffle($cards);
    return $cards;
}

function battle(int $before,int $after){
    if($before < $after){
        return "High";
    }else if ($before > $after){
        return "Low";
    }else{
        return "Dlow";
    }
}

function judge(string $answer,string $judge){

    if($answer === $judge){
        return "Win";
    }else{
        return "Loss";
    }
}

function translation($array){

    $code;
    switch($array['mark']){
        case 'club':
            $code = '♣︎';
        break;
        case 'heart':
            $code = '❤︎';
        break;
        case 'diamond':
            $code = '♦︎';
        break;
        case 'spade':
            $code = '♠︎';
        break;
    }
    
    $number = $array['number'];

    return $code.$number;
    
}

function translationUrl($array){
    $mark=$array['mark'];
    $number = $array['number'];
    return $mark.'-'.$number;
}


function makeCards($mark,$number){
    $c;
    for($i=0;$i <= count($mark);$i++){
        $c[$i]=['mark'=>$mark[$i],'number'=>$number[$i]];
    }
    return $c;
}

