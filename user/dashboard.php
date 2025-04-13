<?php
require_once '../includes/config.php';

if (!isLoggedIn()) {
    redirect('/hospedagem/login.php');
}

// Buscar assinatura ativa do usuário
$stmt = $pdo->prepare("SELECT p.*, a.data_inicio, a.data_vencimento 
                       FROM assinaturas a 
                       JOIN planos p ON a.plano_id = p.id 
                       WHERE a.usuario_id = ? AND a.status = 'ativo' 
                       ORDER BY a.data_inicio DESC LIMIT 1");
$stmt->execute([$_SESSION['user_id']]);
$planoAtivo = $stmt->fetch();

// Buscar todos os planos disponíveis
$stmt = $pdo->query("SELECT * FROM planos");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once '../includes/header.php';
?>

<div class="container my-5">
    <?php if (isset($_GET['payment']) && $_GET['payment'] === 'success'): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i> Pagamento realizado com sucesso! Sua assinatura está ativa.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <h2 class="mb-4"><i class="bi bi-speedometer2 me-2"></i> Painel do Usuário</h2>
    
    <?php if ($planoAtivo): ?>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Seu Plano Ativo</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3><?= htmlspecialchars($planoAtivo['nome']) ?></h3>
                        <p class="text-muted">Assinado em: <?= date('d/m/Y', strtotime($planoAtivo['data_inicio'])) ?></p>
                        <p class="text-muted">Vencimento: <?= date('d/m/Y', strtotime($planoAtivo['data_vencimento'])) ?></p>
                        <h5>R$ <?= number_format($planoAtivo['preco'], 2, ',', '.') ?> <small class="text-muted fw-light">/mês</small></h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Uso do Plano</h5>
                        <div class="progress mb-3" style="height: 30px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">Armazenamento: 5GB de <?= $planoAtivo['armazenamento'] ?></small>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Banda: 50GB de <?= $planoAtivo['largura_banda'] ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Você não possui um plano ativo no momento.
        </div>
    <?php endif; ?>
    
    <h4 class="mb-3">Outros Planos Disponíveis</h4>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($planos as $plano): 
            if ($planoAtivo && $plano['id'] === $planoAtivo['id']) continue; ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="my-1 text-center"><?= htmlspecialchars($plano['nome']) ?></h5>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title pricing-card-title text-center">R$ <?= number_format($plano['preco'], 2, ',', '.') ?><small class="text-muted fw-light">/mês</small></h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['armazenamento'] ?> SSD</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['largura_banda'] ?> de banda</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['sites'] ?> site(s)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['contas_email'] ?> contas de e-mail</li>
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="/planos.php" class="btn btn-outline-primary w-100">Assinar Plano</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
