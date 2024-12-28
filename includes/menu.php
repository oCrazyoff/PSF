<div class="sidebar">
    <ul class="sidebar-menu">
        <li><a href="../admin/dashboard.php"><i class="fa-solid fa-border-all"></i>Dashboard</a></li>
        <li><a href="../admin/funcionarios.php"><i class="fa-solid fa-briefcase"></i>Funcionarios</a></li>
        <li class="has-submenu">
            <a href="#" class="submenu-toggle"><i class="fa-solid fa-users"></i>Pessoas <span
                    class="caret">&#9662;</span></a>
            <ul class="submenu">
                <li><a href="../admin/pessoas_fisica.php"><i class="fa-solid fa-user"></i>Físicas</a></li>
                <li><a href="../admin/pessoas_juridica.php"><i class="fa-solid fa-building"></i>Jurídicas</a></li>
            </ul>
        </li>
        <li><a href="../admin/produtos.php"><i class="fa-solid fa-box"></i>Produtos</a></li>
        <li><a href="../auth/sair.php"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
    </ul>
</div>

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