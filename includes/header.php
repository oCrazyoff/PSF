<header>
    <button class="btn-menu" onclick="menu()">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="header-left">
        <h1 class="system-name">PSF System</h1>
    </div>
    <div class="header-right">
        <div class="user-info">
            <span class="user-name"><?php echo $_SESSION['nome'] ?></span>
            <span class="user-avatar">
                <i class="fas fa-user-circle"></i>
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