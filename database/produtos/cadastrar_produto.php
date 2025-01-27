<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$fornecedor = $_POST['fornecedor'];
$marca = $_POST['marca'];
$grupo = $_POST['grupo'];
$preco_custo = floatval($_POST['preco_custo']);
$preco_venda = floatval($_POST['preco_venda']);
$quantidade = intval($_POST['quantidade']);
$validade = $_POST['validade'];
$subgrupo = $_POST['subgrupo'];
$imagem = $_FILES['imagem']['tmp_name'];
$file_name = $_FILES['imagem']['name'];
$file_info = pathinfo($file_name);
$extencao = strtolower($file_info['extension']);
$file_type = $_FILES['imagem']['type'];
$imagem_info = getimagesize($imagem);
$imagem_type = $imagem_info[2];


if($imagem_type === IMAGETYPE_JPEG || $imagem_type === IMAGETYPE_PNG) {
    if((($extencao === 'jpg' || $extencao === 'jpeg') && ($file_type === 'image/jpeg'))) {
        if($imagem_type === IMAGETYPE_PNG) {
            $imagem_original = imagecreatefrompng($imagem); 
        } else {
            $imagem_original = imagecreatefromjpeg($imagem);  
        }
        ob_start();
        imagejpeg($imagem_original, null, 20);
        $imagem_data = ob_get_clean();
        imagedestroy($imagem_original);
    } else {
        $_SESSION['resposta'] = "Formato de imagem inválido!";
        header("Location: ../../admin/produtos/cadastro_produto.php");
        exit;
    }
} else {
    $_SESSION['resposta'] = "Formato de imagem inválido 2!";
    header("Location: ../../admin/produtos/cadastro_produto.php");
    exit;
}

if (!DateTime::createFromFormat('Y-m-d', $validade)) {
    $_SESSION['resposta'] = "Data de validade inválida!";
    header("Location: ../../admin/produtos/cadastro_produto.php");
    exit;
}

$sql = "INSERT INTO produtos (nome, codigo_barra, fornecedor, preco_custo, preco_venda, quantidade, subgrupo, grupo, marca, validade, imagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssb", $nome, $codigo, $fornecedor, $preco_custo, $preco_venda, $quantidade, $subgrupo, $grupo, $marca, $validade, $imagem_data);
$stmt->send_long_data(10, $imagem_data);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Produto cadastrado com sucessso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar produto: " . $stmt->error;
}

header("Location: ../../admin/produtos/produtos_adm.php");
exit;
