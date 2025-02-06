<html>
    <div class="error-container" id="error-container">
        <p><?=$_SESSION['resposta']?></p>
        <div class="progress-bar" id="progress-bar"></div>
    </div>

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessage = "<?php echo isset($_SESSION['resposta']) ? $_SESSION['resposta'] : ''; ?>";
            if (errorMessage !== '') {
                var errorContainer = document.getElementById('error-container');
                errorContainer.style.display = 'block';
                var timeoutId = setTimeout(function() {
                    errorContainer.style.display = 'none';
                    clearTimeout(timeoutId);
                }, 2000);

                document.addEventListener('click', cancelTimeout);

                function cancelTimeout() {
                    clearTimeout(timeoutId);
                    errorContainer.style.display = 'none';
                    document.removeEventListener('click', cancelTimeout);
                }
            }
        });
    </script>
    <?php
    unset($_SESSION['resposta']);
    ?>
</html>