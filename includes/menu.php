<?php
if ($_SESSION['cargo'] == 1): ?>

    <div class="sidebar" id="menu" onclick="menu()">
        <ul class="sidebar-menu">
            <li><a href="<?php echo BASE_URL; ?>pages/inicio.php"><i class="fa-solid fa-house"></i>Inicio</a></li>
            <li><a href="<?php echo BASE_URL; ?>admin/produtos/produtos.php"><i class="fa-solid fa-box"></i>Produtos</a>
            </li>
            <li><a href="<?php echo BASE_URL; ?>auth/sair.php"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
        </ul>
    </div>

<?php endif; ?>

<?php if ($_SESSION['cargo'] == 2): ?>

    <div class="sidebar" id="menu" onclick="menu()">
        <ul class="sidebar-menu">
            <li><a href="<?php echo BASE_URL; ?>admin/dashboard/dashboard.php"><i
                        class="fa-solid fa-border-all"></i>Dashboard</a>
            </li>
            <li><a href="<?php echo BASE_URL; ?>admin/funcionarios/funcionarios.php"><i
                        class="fa-solid fa-briefcase"></i>Funcionarios</a></li>
            <li><a href="<?php echo BASE_URL; ?>admin/fornecedores/fornecedores.php"><i
                        class="fa-solid fa-truck"></i>Fornecedores</a>
            </li>
            <li class="has-submenu">
                <a href="#" class="submenu-toggle"><i class="fa-solid fa-users"></i>Pessoas <span
                        class="caret">&#9662;</span></a>
                <ul class="submenu">
                    <li><a href="<?php echo BASE_URL; ?>admin/pessoas/pessoas_fisica.php"><i
                                class="fa-solid fa-user"></i>Físicas</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/pessoas/pessoas_juridica.php"><i
                                class="fa-solid fa-building"></i>Jurídicas</a></li>
                </ul>
            </li>
            <li><a href="<?php echo BASE_URL; ?>admin/produtos/produtos.php"></i>Produtos</a></li>
            <li><a href="<?php echo BASE_URL; ?>auth/sair.php"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
        </ul>
    </div>

<?php endif; ?>

<?php if ($_SESSION['cargo'] == 3): ?>

    <div class="sidebar" id="menu" onclick="menu()">
        <ul class="sidebar-menu">
            <li><a href="<?php echo BASE_URL; ?>admin/dashboard/dashboard.php"><i
                        class="fa-solid fa-border-all"></i>Dashboard</a>
            </li>
            <li><a href="<?php echo BASE_URL; ?>admin/funcionarios/funcionarios.php"><i
                        class="fa-solid fa-briefcase"></i>Funcionarios</a></li>
            <li><a href="<?php echo BASE_URL; ?>admin/fornecedores/fornecedores.php"><i
                        class="fa-solid fa-truck"></i>Fornecedores</a>
            </li>
            <li class="has-submenu">
                <a href="#" class="submenu-toggle"><i class="fa-solid fa-users"></i>Pessoas <span
                        class="caret">&#9662;</span></a>
                <ul class="submenu">
                    <li><a href="<?php echo BASE_URL; ?>admin/pessoas/pessoas_fisica.php"><i
                                class="fa-solid fa-user"></i>Físicas</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/pessoas/pessoas_juridica.php"><i
                                class="fa-solid fa-building"></i>Jurídicas</a></li>
                </ul>
            </li>
            <li><a href="<?php echo BASE_URL; ?>admin/produtos/produtos.php"><i class="fa-solid fa-box"></i>Produtos</a>
            </li>
            <li><a href="<?php echo BASE_URL; ?>auth/sair.php"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
        </ul>
    </div>

<?php endif; ?>

<?php if ($_SESSION['cargo'] == 4): ?>

    <div class="sidebar" id="menu" onclick="menu()">
        <ul class="sidebar-menu">
            <li><a href="<?php echo BASE_URL; ?>pages/inicio.php"><i class="fa-solid fa-house"></i>Inicio</a></li>
            <li><a href="<?php echo BASE_URL; ?>pages/produtos.php"><i class="fa-solid fa-basket-shopping"></i>Produtos</a>
            </li>
            <li><a href="<?php echo BASE_URL; ?>auth/sair.php"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
        </ul>
    </div>

<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submenuToggles = document.querySelectorAll('.submenu-toggle');

        submenuToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault(); // Impede a navegação ao clicar no link
                const parent = this.parentElement; // Seleciona o elemento pai
                parent.classList.toggle('open'); // Alterna a classe 'open'
            });
        });
    });
</script>