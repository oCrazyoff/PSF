<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define('BASE_URL', '/PSF/');
} else {
    define('BASE_URL', '/');
}
