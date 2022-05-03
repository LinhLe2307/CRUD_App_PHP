<?php
include '../includes/sessions.php';
logout();
unset($_SESSION['userDatabase']);

header('Location: ../index.php');