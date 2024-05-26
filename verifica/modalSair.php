<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
        $url = $_SERVER['HTTP_REFERER'] . "?sair=ok";
        header('Location: ' . $url);
        exit;
    } else {
        header('Location: ../login.php');
        exit;
    }
} else {
    header('Location: ../login.php');
    exit;
}
