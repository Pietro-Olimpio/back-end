<?php
declare(strict_types=1);

require_once __DIR__ . '/src/AuthService.php';

AuthService::destruirSessao();
header('Location: login.php?erro=logout');
exit;