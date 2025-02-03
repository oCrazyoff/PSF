<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$id = $_POST['id'];
$sql = "SELECT * FROM cargos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$row = $resultado->fetch_assoc();
unset($sql);
$stmt->close();

$sqlPermissao = "SELECT * FROM permissoes WHERE cargo_id = ?";
$stmt = $conn->prepare($sqlPermissao);
$stmt->bind_param("s", $id);
$stmt->execute();
$resultadoPermissao = $stmt->get_result();
$permissoes = [];
while ($rowPermissao = $resultadoPermissao->fetch_assoc()) {
    $permissoes[] = $rowPermissao['pagina'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo $row['nome'] ?></title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container">
            <form action="../../database/cargos/editar_cargo.php" method="post">
                <h2>Editar <?php echo $row['nome'] ?></h2>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                        <input type="text" class="form-control" value="<?php echo $row['nome'] ?>" name="nome" id="nome"
                            placeholder="Digite nome do cargo" required>
                    </div>
                    <br>
                    <label>Selecione as permissões:</label>
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="paginas[]" value="dashboard" data-pasta="admin/dashboard"
                                data-icone="fa-solid fa-border-all"
                                <?php echo in_array('dashboard', $permissoes) ? 'checked' : ''; ?>>
                            Dashboard
                            <input type="hidden" name="dashboard_pasta" value="admin/dashboard">
                            <input type="hidden" name="dashboard_icone" value="fa-solid fa-border-all">
                            <input type="hidden" name="dashboard_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="produtos_adm" data-pasta="admin/produtos"
                                data-icone="fa-solid fa-box"
                                <?php echo in_array('produtos_adm', $permissoes) ? 'checked' : ''; ?>>
                            Produtos ADM
                            <input type="hidden" name="produtos_adm_pasta" value="admin/produtos">
                            <input type="hidden" name="produtos_adm_icone" value="fa-solid fa-box">
                            <input type="hidden" name="produtos_adm_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="vendas" data-pasta="admin/transações"
                                data-icone="fa-solid fa-cart-shopping"
                                <?php echo in_array('vendas', $permissoes) ? "checked" : "" ?>>
                            Vendas
                            <input type="hidden" name="vendas_pasta" value="2">
                            <input type="hidden" name="vendas_icone" value="fa-solid fa-cart-shopping">
                            <input type="hidden" name="vendas_submenu" value="2">

                            <!-- Pagina transações -->
                            <input type="hidden" name="paginas[]" value="transações"
                                data-pasta="admin/vendas/transações" data-icone="fa-solid fa-exchange-alt">
                            <input type="hidden" name="transações_pasta" value="admin/vendas/transações">
                            <input type="hidden" name="transações_icone" value="fa-solid fa-exchange-alt">
                            <input type="hidden" name="transações_submenu" value="2">
                            <!-- Pagina do caixa -->
                            <input type="hidden" name="paginas[]" value="caixa" data-pasta="admin/vendas/caixa"
                                data-icone="fa-solid fa-cash-register">
                            <input type="hidden" name="caixa_pasta" value="admin/vendas/caixa">
                            <input type="hidden" name="caixa_icone" value="fa-solid fa-cash-register">
                            <input type="hidden" name="caixa_submenu" value="2">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="produtos" data-pasta="pages"
                                data-icone="fa-solid fa-box"
                                <?php echo in_array('produtos', $permissoes) ? 'checked' : ''; ?>>
                            Produtos Clientes
                            <input type="hidden" name="produtos_pasta" value="pages">
                            <input type="hidden" name="produtos_icone" value="fa-solid fa-box">
                            <input type="hidden" name="produtos_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="pessoas" data-pasta="1"
                                data-icone="fa-solid fa-users"
                                <?php echo in_array('pessoas', $permissoes) ? 'checked' : ''; ?>>
                            Pessoas
                            <input type="hidden" name="pessoas_pasta" value="1">
                            <input type="hidden" name="pessoas_icone" value="fa-solid fa-users">
                            <input type="hidden" name="pessoas_submenu" value="1">

                            <!-- Pagina pessoas físicas -->
                            <input type="hidden" name="paginas[]" value="pessoas_fisica" data-pasta="admin/pessoas"
                                data-icone="fa-solid fa-user">
                            <input type="hidden" name="pessoas_fisica_pasta" value="admin/pessoas">
                            <input type="hidden" name="pessoas_fisica_icone" value="fa-solid fa-user">
                            <input type="hidden" name="pessoas_fisica_submenu" value="1">
                            <!-- Pagina pessoas juridicas -->
                            <input type="hidden" name="paginas[]" value="pessoas_juridica" data-pasta="admin/pessoas"
                                data-icone="fa-solid fa-building">
                            <input type="hidden" name="pessoas_juridica_pasta" value="admin/pessoas">
                            <input type="hidden" name="pessoas_juridica_icone" value="fa-solid fa-building">
                            <input type="hidden" name="pessoas_juridica_submenu" value="1">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="funcionarios" data-pasta="admin/funcionarios"
                                data-icone="fa-solid fa-briefcase"
                                <?php echo in_array('funcionarios', $permissoes) ? 'checked' : ''; ?>>
                            Funcionários
                            <input type="hidden" name="funcionarios_pasta" value="admin/funcionarios">
                            <input type="hidden" name="funcionarios_icone" value="fa-solid fa-briefcase">
                            <input type="hidden" name="funcionarios_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="fornecedores" data-pasta="admin/fornecedores"
                                data-icone="fa-solid fa-truck"
                                <?php echo in_array('fornecedores', $permissoes) ? 'checked' : ''; ?>>
                            Fornecedores
                            <input type="hidden" name="fornecedores_pasta" value="admin/fornecedores">
                            <input type="hidden" name="fornecedores_icone" value="fa-solid fa-truck">
                            <input type="hidden" name="fornecedores_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="cargos" data-pasta="admin/cargos"
                                data-icone="fa-solid fa-id-card-clip"
                                <?php echo in_array('cargos', $permissoes) ? 'checked' : ''; ?>>
                            Cargos
                            <input type="hidden" name="cargos_pasta" value="admin/cargos">
                            <input type="hidden" name="cargos_icone" value="fa-solid fa-id-card-clip">
                            <input type="hidden" name="cargos_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="grupos" data-pasta="admin/grupos"
                                data-icone="fa-solid fa-boxes-stacked"
                                <?php echo in_array('grupos', $permissoes) ? 'checked' : ''; ?>>
                            Grupos
                            <input type="hidden" name="grupos_pasta" value="admin/grupos">
                            <input type="hidden" name="grupos_icone" value="fa-solid fa-boxes-stacked">
                            <input type="hidden" name="grupos_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="subgrupos" data-pasta="admin/subgrupos"
                                data-icone="fa-solid fa-box-open"
                                <?php echo in_array('subgrupos', $permissoes) ? 'checked' : ''; ?>>
                            Subgrupos
                            <input type="hidden" name="subgrupos_pasta" value="admin/subgrupos">
                            <input type="hidden" name="subgrupos_icone" value="fa-solid fa-box-open">
                            <input type="hidden" name="subgrupos_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="marcas" data-pasta="admin/marcas"
                                data-icone="fa-solid fa-tags"
                                <?php echo in_array('marcas', $permissoes) ? 'checked' : ''; ?>>
                            Marcas
                            <input type="hidden" name="marcas_pasta" value="admin/marcas">
                            <input type="hidden" name="marcas_icone" value="fa-solid fa-tags">
                            <input type="hidden" name="marcas_submenu" value="0">
                        </label>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button type="submit" class="btn btn-primary btn-block mt-3">Editar</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="paginas[]"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const pagina = this.value;
                    const pastaInput = document.querySelector(`#${pagina}_pasta`);
                    const iconeInput = document.querySelector(`#${pagina}_icone`);
                    const submenuInput = document.querySelector(`#${pagina}_submenu`);

                    if (this.checked) {
                        pastaInput.value = this.getAttribute('data-pasta');
                        iconeInput.value = this.getAttribute('data-icone');
                        submenuInput.value = this.hasAttribute('data-submenu') ? 1 : 0;
                    } else {
                        pastaInput.value = '';
                        iconeInput.value = '';
                        submenuInput.value = 0;
                    }
                });
            });
        });
    </script>

</body>

</html>