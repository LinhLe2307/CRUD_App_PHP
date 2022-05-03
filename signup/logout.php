<?php
include '../includes/sessions.php';
logout();
unset($_SESSION['userDatabase']);
unset($_SESSION['userName']);

header('Location: ../index.php');