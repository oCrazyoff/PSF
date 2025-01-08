<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];
$paginas = isset($_POST['paginas']) ? $_POST['paginas'] : [];

$sql = "INSERT INTO cargos (nome) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);

if ($stmt->execute()) {
    $cargoId = $stmt->insert_id;
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar cargo: " . $stmt->error;
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

$_SESSION['resposta'] = "Cargo cadastrado com sucesso!";
header("Location: ../../admin/cargos/cargos.php");
exit;
