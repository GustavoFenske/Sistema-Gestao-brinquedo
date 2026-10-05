<?php
require_once '../infra/conexao.php';

$id = $_GET['id'] ?? null;
$mensagem = "";

if (!$id) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $preco = $_POST['preco'];
    $quantidade_estoque = $_POST['quantidade_estoque'];

    $sql = "UPDATE brinquedos SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade_estoque = ? WHERE id = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, "sssdii", $nome, $categoria, $faixa_etaria, $preco, $quantidade_estoque, $id);

    if (mysqli_stmt_execute($comando)) {
        header("Location: ../index.php");
        exit;
    } else {
        $mensagem = "Erro ao atualizar dados.";
    }
}

$sql = "SELECT * FROM brinquedos WHERE id = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);

$resultado = mysqli_stmt_get_result($comando);
$brinquedo = mysqli_fetch_assoc($resultado);

if (!$brinquedo) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Brinquedo</title>
</head>

<body>

    <h1>Editar Brinquedo</h1>
    <a href="../index.php">Voltar</a>
    <br><br>

    <?php if ($mensagem != "") { ?>
        <p><?php echo $mensagem; ?></p>
    <?php } ?>

    <form method="POST" action="editar.php?id=<?php echo htmlspecialchars($id); ?>">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($brinquedo['nome']); ?>" required><br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($brinquedo['categoria']); ?>" required><br><br>

        <label>Faixa Etária:</label><br>
        <input type="text" name="faixa_etaria" value="<?php echo htmlspecialchars($brinquedo['faixa_etaria']); ?>" required><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?php echo htmlspecialchars($brinquedo['preco']); ?>" required><br><br>

        <label>Quantidade em Estoque:</label><br>
        <input type="number" name="quantidade_estoque" value="<?php echo htmlspecialchars($brinquedo['quantidade_estoque']); ?>" required><br><br>

        <button type="submit">Atualizar</button>
    </form>

</body>

</html>