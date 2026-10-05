<?php
require_once '../infra/conexao.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $preco = $_POST['preco'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
        
    $sql = "INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade_estoque) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
        
    mysqli_stmt_bind_param($comando, "sssdi", $nome, $categoria, $faixa_etaria, $preco, $quantidade_estoque);

    if (mysqli_stmt_execute($comando)) {
        header("Location: ../index.php");
        exit;
    } else {
        $mensagem = "Erro ao cadastrar no banco de dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Brinquedo</title>
</head>
<body>

    <h1>Cadastrar Brinquedo</h1>
    <a href="../index.php">Voltar</a>
    <br><br>

    <?php if ($mensagem != "") { ?>
        <p><?php echo $mensagem; ?></p>
    <?php } ?>

    <form method="POST" action="cadastrar.php">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria" required><br><br>

        <label>Faixa Etária:</label><br>
        <input type="text" name="faixa_etaria" required><br><br>

        <label>Preço:</label><br>
        <input type="number" name="preco" required><br><br>

        <label>Quantidade em Estoque:</label><br>
        <input type="number" name="quantidade_estoque" required><br><br>

        <button type="submit">Salvar</button>
    </form>

</body>
</html> 