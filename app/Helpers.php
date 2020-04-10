<?php
function isActive($route){
    return request()->is($route)? 'active':'';
}
?>