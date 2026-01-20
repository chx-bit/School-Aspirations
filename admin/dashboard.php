<?php
require_once 'helpers/engine.php'
session_start();
session_unset();
session_destroy();
header('Location: ' . BASE_URL . 'index.php'); 
exit();
?>