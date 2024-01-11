<?php
function PodesiStranice($conn,$brUkupno)
{

    $offset=0;
    $sqlBr="SELECT brPrikaza FROM stranice LIMIT 1";
    $rezBr=$conn->query($sqlBr);
    $limit=0;
    foreach($rezBr as $br)
    {
        $limit= htmlspecialchars($br['brPrikaza']);
    }
    $brojStranica=$brUkupno/$limit;
    
    return array($limit,$offset,$brojStranica);

}

?>