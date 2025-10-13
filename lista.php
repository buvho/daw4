<?php
header('Content-Type: application/json'); 
$file = fopen("pergunta.txt","r");
$i = 0;

while(! feof($file)) {
    $line = fgets($file);
    $partes = explode(";",$line);
    $pergunta[] = [
        "pergunta" => $partes[0],
        "tipo" => $partes[1],
        "id" => $i
    ];
    $i += 1;
}

fclose($file);
$json = json_encode($pergunta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo $json;
?>
