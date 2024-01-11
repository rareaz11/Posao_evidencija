<?php

require('../DB/veza.php');

$sql="SELECT korisnickoIme FROM korisnici";

$rez= $conn->query($sql);


$items = [];
while ($row = $rez->fetch_array(MYSQLI_ASSOC)) {
    $items[] = $row;
}

$sql1="SELECT kontakt FROM korisnici";

$rez1= $conn->query($sql1);


$mails = [];
while ($row = $rez1->fetch_array(MYSQLI_ASSOC)) {
    $mails[] = $row;}

    $data=
    [
        'korisnicko'=>$items,
        'email'=>$mails
    ];
print json_encode($data);











/*
$sqlTvrtke="SELECT *From jobs";

$rez1=$conn->query($sqlTvrtke);

$jobsCompany=[];

foreach($rez1 as $r)
{
    $jobsCompany[]=$r;
}


print json_encode($jobsCompany);
*/


?>