<?php
$host = "localhost";
$user = "root";
$senha = "familia54";
$banco = "mensatos_pizzaria";

$conn = new mysqli($host, $user, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$nome = trim($_POST['nome'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$sabor = trim($_POST['sabor'] ?? '');
$tamanho = trim($_POST['tamanho'] ?? '');
$bebida = trim($_POST['bebida'] ?? '');
$observacoes = trim($_POST['observacoes'] ?? '');

if (empty($nome) || empty($telefone) || empty($sabor) || empty($tamanho) || empty($bebida)) {
    die("Erro: Todos os campos obrigatórios devem ser preenchidos.");
}

// Buscar preço do sabor
$stmt_sabor = $conn->prepare("SELECT preco FROM sabores WHERE nome = ?");
$stmt_sabor->bind_param("s", $sabor);
$stmt_sabor->execute();
$result_sabor = $stmt_sabor->get_result();

if ($result_sabor->num_rows === 0) {
    die("Erro: Sabor não encontrado.");
}
$preco_sabor = $result_sabor->fetch_assoc()['preco'];

// Buscar preço do tamanho
$stmt_tamanho = $conn->prepare("SELECT preco FROM tamanhos WHERE tamanho = ?");
$stmt_tamanho->bind_param("s", $tamanho);
$stmt_tamanho->execute();
$result_tamanho = $stmt_tamanho->get_result();

if ($result_tamanho->num_rows === 0) {
    die("Erro: Tamanho não encontrado.");
}
$preco_tamanho = $result_tamanho->
