<?php
require_once('classes/livros.php');
require_once('conexao/conexao.php');

// Verifica qual aba foi selecionada
$aba = isset($_GET['aba']) ? $_GET['aba'] : 'listar';

// Lógica para adicionar um livro
if (isset($_POST['adicionarLivro'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $editora = $_POST['editora'];

    $sql = "INSERT INTO livros (titulo, autor, ano_publicacao, editora) VALUES ('$titulo', '$autor', '$ano_publicacao', '$editora')";
    $conn->query($sql);
}

// Lógica para atualizar um livro
if (isset($_POST['atualizarLivro'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $editora = $_POST['editora'];

    $sql = "UPDATE livros SET titulo='$titulo', autor='$autor', ano_publicacao='$ano_publicacao', editora='$editora' WHERE id=$id";
    $conn->query($sql);
}

// Lógica para excluir um livro
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];

    $sql = "DELETE FROM livros WHERE id=$id";
    $conn->query($sql);
}

// Lógica para listar livros
$sql = "SELECT * FROM livros";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerenciamento de Biblioteca</title>
    <link rel="stylesheet" type="text/css" href="designer.css">
</head>
<body>
    <h1>Gerenciamento de Biblioteca</h1>

    <!-- Abas de Navegação -->
    <ul>
        <li><a href="index.php?aba=listar">Listar Livros</a></li>
        <li><a href="index.php?aba=adicionar">Adicionar Livro</a></li>
    </ul>

    <?php
    // Conteúdo da aba "Listar Livros"
    if ($aba == 'listar'):
    ?>
    <h2>Lista de Livros</h2>
    <table border="1">
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Ano de Publicação</th>
            <th>Editora</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo $row['autor']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['ano_publicacao'])); ?></td>
            <td><?php echo $row['editora']; ?></td>
            <td>
                <a href="index.php?aba=editar&id=<?php echo $row['id']; ?>">Editar</a>
                <a href="index.php?excluir=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php endif; ?>

    <?php
    // Conteúdo da aba "Adicionar Livro"
    if ($aba == 'adicionar'):
    ?>
    <h2>Adicionar Livro</h2>
    <form method="post">
        <input type="text" name="titulo" placeholder="Título" required>
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="date" name="ano_publicacao" placeholder="Ano de Publicação" required>
        <input type="text" name="editora" placeholder="Editora" required>
        <button type="submit" name="adicionarLivro">Adicionar Livro</button>
    </form>
    <?php endif; ?>

    <?php
    // Conteúdo da aba "Editar Livro"
    if ($aba == 'editar'):
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        // Recupera os dados do livro a ser editado
        $sql = "SELECT * FROM livros WHERE id = $id";
        $result = $conn->query($sql);
        $livro = $result->fetch_assoc();
    ?>
    <h2>Editar Livro</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $livro['id']; ?>">
        <input type="text" name="titulo" placeholder="Título" value="<?php echo $livro['titulo']; ?>" required>
        <input type="text" name="autor" placeholder="Autor" value="<?php echo $livro['autor']; ?>" required>
        <input type="date" name="ano_publicacao" placeholder="Ano de Publicação" value="<?php echo $livro['ano_publicacao']; ?>" required>
        <input type="text" name="editora" placeholder="Editora" value="<?php echo $livro['editora']; ?>">
        <button type="submit" name="atualizarLivro">Atualizar Livro</button>
    </form>
    <?php endif; ?>
</body>
</html>
