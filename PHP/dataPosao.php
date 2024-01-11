<?php

require('../DB/veza.php');

$sql="SELECT* FROM jobs";

$rez= $conn->query($sql);


$naziv = [];
while ($row = $rez->fetch_array(MYSQLI_ASSOC)) {
    $naziv[] = $row;
}









    $jobs=
    [
        'naziv'=>$naziv,
        
    ];
print json_encode($jobs);