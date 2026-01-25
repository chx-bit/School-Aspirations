<?php
require_once __DIR__ . '/helpers/engine.php';
require_once __DIR__ . '/helpers/functions.php';
session_unset();
session_destroy();
redirectTo('index.php');