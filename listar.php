<?php
header('Content-Type: application/json');

$file = fopen("pergunta.txt","r");
$perguntas = [];
$i = 0;

while(!feof($file)) {
    $line = trim(fgets($file));
    if ($line === "") continue;
    $partes = array_map('trim', explode(";", $line));

    $tipo = $partes[1] ?? "";
    $dados = [
        "id" => $i,
        "pergunta" => $partes[0],
        "tipo" => $tipo,
    ];

    if (strtolower($tipo) === "multipla") {
        $alternativas = array_slice($partes, 2, -1);
        $correta = end($partes);
        $dados["alternativas"] = $alternativas;
        $dados["correta"] = (int)trim($correta);
    }

    $perguntas[] = $dados;
    $i++;
}

fclose($file);

echo json_encode($perguntas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
