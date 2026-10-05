<?php
require_once 'infra/conexao.php';

if (isset($_GET['excluir'])) {
    $id_excluir = $_GET['excluir'];

    $sql = "DELETE FROM brinquedos WHERE id = ?";

    $comando = $pdo->prepare($sql);
    $comando->execute([$id_excluir]);   
   
}

$sql = "SELECT * FROM brinquedos";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Brinquedos</title>
</head>
<body>

    <h1>Gestão de Brinquedos</h1>
    
    <a href="public/cadastrar.php">Cadastrar Novo Brinquedo</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Faixa Etária</th>
            <th>Preço (R$)</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>

        <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo $linha['id']; ?></td>
                <td><?php echo $linha['nome']; ?></td>
                <td><?php echo $linha['categoria']; ?></td>
                <td><?php echo $linha['faixa_etaria']; ?></td>
                <td><?php echo $linha['preco']; ?></td>
                <td><?php echo $linha['quantidade_estoque']; ?></td>
                <td>
                    <a href="public/editar.php?id=<?php echo $linha['id']; ?>">Editar</a> | 
                    <a href="index.php?excluir=<?php echo $linha['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>