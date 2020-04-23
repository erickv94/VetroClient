<?php

use Carbon\Carbon;

function isActive($route){
    return request()->is($route)? 'active':'';
}


function hasTwoMothsToExpire($dateString){
     $expirateDate= Carbon::parse($dateString);
     $todayDate= Carbon::now();
     $isNearExpirated=false;
     if($expirateDate > $todayDate){
        $numMonths=$expirateDate->FloatdiffInMonths($todayDate);
        $numMonths=round($numMonths);
        if($numMonths<=2){
            $isNearExpirated=true;
        }


    return $isNearExpirated;
    }
}
?>
