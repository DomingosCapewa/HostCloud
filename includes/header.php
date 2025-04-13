<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostCloud - Hospedagem Profissional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-cloud-fill me-2"></i>HostCloud
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/hospedagem/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hospedagem/planos.php">Planos</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>Minha Conta
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if (isAdmin()): ?>
                                    <li><a class="dropdown-item" href="/hospedagem/admin/dashboard.php">Painel Admin</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="/hospedagem/user/dashboard.php">Painel do Usuário</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/hospedagem/logout.php">Sair</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/hospedagem/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/hospedagem/register.php">Registrar</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container my-4">
