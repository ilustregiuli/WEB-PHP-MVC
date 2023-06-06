<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = $_GET['id'];
$sql = 'DELETE FROM videos WHERE id = ?';

$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id);


if ($statement->execute()) {        // O método execute devolve "true" ou "false"; De qualquer modo será enviado para o index,
    header('Location: /index.php?success=1');  // mas a URL será diferente. Lembrando: os parâmetros após a "?" não interferem
} else {                                        // no destino da URL. Tudo que vem após o "?" não é mais endereço, e sim, parâmetros
    header('Location: /index.php?success=0');   // que são enviados via GET (pela URL).
};


