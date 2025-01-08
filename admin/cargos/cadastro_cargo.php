<?php
include("../../auth/valida.php");
include("../../database/utils/conexao.php");
include("../../auth/config.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar cargo</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container">
            <form action="../../database/cargos/cadastrar_cargo.php" method="post">
                <h2>Cadastrar Cargo</h2>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite nome do cargo"
                            required>
                    </div>
                    <br>
                    <label>Selecione as permissões:</label>
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="paginas[]" value="dashboard" data-pasta="admin/dashboard"
                                data-icone="fa-solid fa-border-all">
                            Dashboard
                            <input type="hidden" name="dashboard_pasta" value="admin/dashboard">
                            <input type="hidden" name="dashboard_icone" value="fa-solid fa-border-all">
                            <input type="hidden" name="dashboard_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="produtos" data-pasta="admin/produtos"
                                data-icone="fa-solid fa-box">
                            Produtos ADM
                            <input type="hidden" name="produtos_pasta" value="admin/produtos">
                            <input type="hidden" name="produtos_icone" value="fa-solid fa-box">
                            <input type="hidden" name="produtos_submenu" value="0">
                        </label>

                        <label>
                            <input type="checkbox" name="paginas[]" value="produtos_cliente" data-pasta="pages"
                                data-icone="fa-solid fa-box">
                            Produtos Clientes
                            <input type="hidden" name="produtos_cliente_pasta" value="pages">
                            <input type="hidden" name="produtos_cliente_icone" value="fa-solid fa-box">
                            <input type="hidden" name="produtos_cliente_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="funcionarios" data-pasta="admin/funcionarios"
                                data-icone="fa-solid fa-briefcase">
                            Funcionários
                            <input type="hidden" name="funcionarios_pasta" value="admin/funcionarios">
                            <input type="hidden" name="funcionarios_icone" value="fa-solid fa-briefcase">
                            <input type="hidden" name="funcionarios_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="fornecedores" data-pasta="admin/fornecedores"
                                data-icone="fa-solid fa-truck">
                            Fornecedores
                            <input type="hidden" name="fornecedores_pasta" value="admin/fornecedores">
                            <input type="hidden" name="fornecedores_icone" value="fa-solid fa-truck">
                            <input type="hidden" name="fornecedores_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="cargos" data-pasta="admin/cargos"
                                data-icone="fa-solid fa-id-card-clip">
                            Cargos
                            <input type="hidden" name="cargos_pasta" value="admin/cargos">
                            <input type="hidden" name="cargos_icone" value="fa-solid fa-id-card-clip">
                            <input type="hidden" name="cargos_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="grupos" data-pasta="admin/grupos"
                                data-icone="fa-solid fa-boxes-stacked">
                            Grupos
                            <input type="hidden" name="grupos_pasta" value="admin/grupos">
                            <input type="hidden" name="grupos_icone" value="fa-solid fa-boxes-stacked">
                            <input type="hidden" name="grupos_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="subgrupos" data-pasta="admin/subgrupos"
                                data-icone="fa-solid fa-box-open">
                            Subgrupos
                            <input type="hidden" name="subgrupos_pasta" value="admin/subgrupos">
                            <input type="hidden" name="subgrupos_icone" value="fa-solid fa-box-open">
                            <input type="hidden" name="subgrupos_submenu" value="0">
                        </label>
                        <label>
                            <input type="checkbox" name="paginas[]" value="marcas" data-pasta="admin/marcas"
                                data-icone="fa-solid fa-tags">
                            Marcas
                            <input type="hidden" name="marcas_pasta" value="admin/marcas">
                            <input type="hidden" name="marcas_icone" value="fa-solid fa-tags">
                            <input type="hidden" name="marcas_submenu" value="0">
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-3">Cadastrar</button>
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