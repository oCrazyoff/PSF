<?php
$cargo = $_SESSION['cargo'];

$sqlMenu = "SELECT * FROM permissoes WHERE cargo_id = ?";
$stmtMenu = $conn->prepare($sqlMenu);
$stmtMenu->bind_param("i", $cargo);
$stmtMenu->execute();
$resultadoMenu = $stmtMenu->get_result();

?>
<div class="sidebar" id="menu">
    <ul class="sidebar-menu">
        <li><a href="<?php echo BASE_URL; ?>pages/inicio.php"><i class="fa-solid fa-house"></i>Inicio</a></li>
        <?php
        while ($rowMenu = $resultadoMenu->fetch_assoc()):

            if ($rowMenu['submenu'] != null && $rowMenu['submenu'] == $rowMenu['pasta']): ?>
                <li class="has-submenu">
                    <a href="#" class="submenu-toggle">
                        <i class="<?php echo $rowMenu['icone'] ?>"></i>
                        <?php echo ucfirst(str_replace('_', ' ', $rowMenu['pagina'])); ?>
                        <span class="caret">&#9662;</span>
                    </a>
                    <ul class="submenu">
                        <?php
                        $sqlSubmenu = "SELECT * FROM permissoes WHERE submenu = ? AND pasta != ?";
                        $stmtSubmenu = $conn->prepare($sqlSubmenu);
                        $stmtSubmenu->bind_param("ss", $rowMenu['submenu'], $rowMenu['submenu']);
                        $stmtSubmenu->execute();
                        $resultadoSubmenu = $stmtSubmenu->get_result();
                        ?>
                        <?php while ($rowSubmenu = $resultadoSubmenu->fetch_assoc()): ?>
                            <li>
                                <a href="<?php echo BASE_URL . $rowSubmenu['pasta'] . '/' . $rowSubmenu['pagina'] . '.php' ?>">
                                    <i class="<?php echo $rowSubmenu['icone'] ?>"></i>
                                    <?php echo ucfirst(str_replace('_', ' ', $rowSubmenu['pagina'])); ?>
                                </a>
                            </li>
                        <?php endwhile ?>
                    </ul>
                </li>
            <?php endif ?>

            <?php if ($rowMenu['submenu'] == null): ?>
                <li>
                    <a href="<?php echo BASE_URL . $rowMenu['pasta'] . '/' . $rowMenu['pagina'] . '.php' ?>">
                        <i class="<?php echo $rowMenu['icone'] ?>"></i>
                        <?php echo ucfirst(str_replace('_', ' ', $rowMenu['pagina'])); ?>
                    </a>
                </li>
            <?php endif ?>

        <?php endwhile ?>
        <li><a href="<?php echo BASE_URL; ?>auth/sair.php"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
    </ul>
</div>

<div class="overlay" id="overlay" onclick="menu()"></div>

<?php
$stmtMenu->close();
?>

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