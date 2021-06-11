<?php 
    $a = array(1,2,3);
    $b = array(4,5,6);
    $c = array(7,8,9);

    echo json_encode(array(
        'a' => $a,
        'b' => $b,
        'c' => $c
    ))
?>