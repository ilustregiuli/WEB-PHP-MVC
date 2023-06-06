<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

// Forma "errada", pegando o dado direto da variável global $_POST sem tratamento
$url = $_POST['link_video']; // Recebe após a requisição, o campo "name" = "link_video" da página "enviar-video.html"
$titulo_video = $_POST['titulo']; // Quando enviado por POST, vai no corpo da requisição

// forma "correta", filtrando o dado antes de usar, com o uso da função "filter_input"
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL); // parametros: 1- tipo de input,de onde vem o dado (POST),
                                                             // 2- Nome da var que está vindo,
                                                             //3 - Regra de validação -> VALIDATE_URL - valida se é uma URL   
$titulo_video = filter_input(INPUT_POST, 'title');

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$statement = $pdo->prepare($sql);

$statement->bindValue(1, $url);
$statement->bindValue(2, $titulo_video);

if ($statement->execute()) {
    header('Location: /index.php?success=1');
} else {
    header('Location: /index.php?success=0');
};
