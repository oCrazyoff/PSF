<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];
$paginas = isset($_POST['paginas']) ? $_POST['paginas'] : [];
$id = $_POST['id'];

if ($id) {
    $sql = "UPDATE cargos SET nome = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nome, $id);
} else {
    $sql = "INSERT INTO cargos (nome) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome);
}

if (!$stmt->execute()) {
    $_SESSION['resposta'] = "Erro ao cadastrar/atualizar cargo: " . $stmt->error;
    header("Location: ../../admin/cargos/cargos.php");
    exit;
}

$cargoId = $id ? $id : $stmt->insert_id;

$sqlDeletePermissoes = "DELETE FROM permissoes WHERE cargo_id = ?";
$stmtDeletePermissoes = $conn->prepare($sqlDeletePermissoes);
$stmtDeletePermissoes->bind_param("i", $cargoId);
if (!$stmtDeletePermissoes->execute()) {
    $_SESSION['resposta'] = "Erro ao excluir permissões anteriores: " . $stmtDeletePermissoes->error;
    header("Location: ../../admin/cargos/cargos.php");
    exit;
}

foreach ($paginas as $pagina) {
    $pasta = isset($_POST["{$pagina}_pasta"]) ? $_POST["{$pagina}_pasta"] : '';
    $icone = isset($_POST["{$pagina}_icone"]) ? $_POST["{$pagina}_icone"] : '';
    $submenu = isset($_POST["{$pagina}_submenu"]) && $_POST["{$pagina}_submenu"] != 0 ? $_POST["{$pagina}_submenu"] : null;

    if (!empty($pagina) && !empty($pasta) && !empty($icone)) {
        $sqlPermissoes = "INSERT INTO permissoes (cargo_id, pagina, pasta, icone, submenu) VALUES (?, ?, ?, ?, ?)";
        $stmtPermissoes = $conn->prepare($sqlPermissoes);
        $stmtPermissoes->bind_param("isssi", $cargoId, $pagina, $pasta, $icone, $submenu);

        if (!$stmtPermissoes->execute()) {
            $_SESSION['resposta'] = "Erro ao cadastrar permissões: " . $stmtPermissoes->error;
            header("Location: ../../admin/cargos/cargos.php");
            exit;
        }
    }
}

$_SESSION['resposta'] = "Cargo atualizado com sucesso!";
header("Location: ../../admin/cargos/cargos.php");
exit;
