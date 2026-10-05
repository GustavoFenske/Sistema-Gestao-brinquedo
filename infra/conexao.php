<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "loja_brinquedos";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Erro ao conectar no banco de dados: " . mysqli_connect_error());
}

?>