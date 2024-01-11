<?php


//pronadeno na stack overflow

$charset = "utf8mb4"; 


$conn->set_charset($charset);
$result = mysqli_query($conn, "SHOW TABLES");
$tables = array();

while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}


$sqlScript = "";
foreach ($tables as $table)
 {
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
     
    $sqlScript .= "\n\n" . $row[1] . ";\n\n";
     
     
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
     
    $columnCount = mysqli_num_fields($result);
     
    for ($i = 0; $i < $columnCount; $i ++) {
        while ($row = mysqli_fetch_row($result)) {
            $sqlScript .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $columnCount; $j ++) {
                $row[$j] = $row[$j];
                 
                $sqlScript .= (isset($row[$j])) ? '"' . $row[$j] . '"' : '""';

                if ($j < ($columnCount - 1)) {
                    $sqlScript .= ',';
                }

            }
            $sqlScript .= ");\n";
        }
    }
     
    $sqlScript .= "\n"; 
}


$mysql_file = fopen($db . '_backup_'.time() . '.sql', 'w+');
fwrite($mysql_file ,$sqlScript );
fclose($mysql_file );

?>
