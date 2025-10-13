<?php
header('Content-Type: application/json'); 
$file = fopen("pergunta.txt","r");
$i = 0

while(! feof($file)) {
    $line = fgets($file);
    $partes = explode(";",$line);
    if ($partes[1] == "multipla"){
        $alternativas = array_slice($partes, 2, -1);
        $pergunta[] = [
            "pergunta" => $partes[0],
            "tipo" => $partes[1],
            "alternativas" => $alternativas,
            "resposta_correta" => intval(end($partes))
            "id" = $i
        ];
    }
    else{ 
        $pergunta[] = [
            "pergunta" => $partes[0],
            "tipo" => $partes[1],
            "alternativas" => [],
            "resposta_correta" => 0
            "id" = $i
        ];
    }
    $i += 1
}

fclose($file);
$json = json_encode($pergunta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo $json;
?>
