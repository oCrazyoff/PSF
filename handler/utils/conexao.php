<?php

$servidor = "sql112.infinityfree.com";
$usuario = "if0_37944711";
$senha = "obLVaJpCA6GF";
$dbname = "if0_37944711_psf";

/*$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "sistema";*/

/**/

$conn = new mysqli($servidor, $usuario, $senha, $dbname);

if ($conn->connect_error) {
    die("ERRO! " . $conn->connect_error);
}
