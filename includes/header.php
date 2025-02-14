<header>
    <button class="btn-menu" onclick="menu()">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="header-left">
        <h1 class="system-name">PSF System</h1>
    </div>
    <div class="header-right">
        <div class="user-info">
            <span class="user-arrow"><i class="fa-solid fa-caret-down"></i></span>
            <span class="user-avatar"><i class="fas fa-user-circle"></i></span>
            <span class="user-submenu">
                <ul>
                    <li><a href="<?= BASE_URL . "pages/produtos.php" ?>">Catálogo</a></li>
                    <li><a href="<?= BASE_URL . "pages/carrinho.php" ?>">Carrinho</a></li>
                    <?php
                    if (isset($_SESSION['nome'])) {
                        echo "<li><a href='" . BASE_URL . "auth/sair.php'>Sair</a></li>";
                    } else {
                        echo "<li><a href='" . BASE_URL . "index.php'>Login</a></li>";
                    }
                    ?>
                </ul>
            </span>

        </div>
    </div>
</header>

<script>
    function menu() {
        var menu = document.getElementById('menu');
        menu.classList.toggle('active');
    }
</script>