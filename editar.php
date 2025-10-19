<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id']) || !isset($data['pergunta'])) {
    echo json_encode(["erro" => "Dados inválidos"]);
    exit;
}

$linhas = file("pergunta.txt", FILE_IGNORE_NEW_LINES);
$id = (int)$data['id'];

if (!isset($linhas[$id])) {
    echo json_encode(["erro" => "Pergunta não encontrada"]);
    exit;
}

$partes = explode(";", $linhas[$id]);
$tipo = trim($partes[1] ?? "");

if (strtolower($tipo) === "multipla") {
    if (!isset($data['alternativas']) || !isset($data['correta'])) {
        echo json_encode(["erro" => "Campos de múltipla escolha faltando"]);
        exit;
    }

    $novaLinha = implode(";", array_merge(
        [$data['pergunta'], $tipo],
        $data['alternativas'],
        [$data['correta']]
    ));
} else {
    $novaLinha = "{$data['pergunta']};{$tipo}";
}

$linhas[$id] = $novaLinha;
file_put_contents("pergunta.txt", implode("\n", $linhas));

echo json_encode(["sucesso" => true]);
