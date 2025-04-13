<?php
require_once 'includes/config.php';
require_once 'includes/header.php';

// Buscar planos do banco de dados
$stmt = $pdo->query("SELECT * FROM planos");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="text-center mb-4">Nossos Planos de Hospedagem</h2>
<p class="text-center mb-5">Escolha o plano perfeito para suas necessidades</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($planos as $plano): ?>
    <div class="col">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h4 class="my-2 text-center"><?= htmlspecialchars($plano['nome']) ?></h4>
            </div>
            <div class="card-body">
                <h3 class="card-title pricing-card-title text-center">R$ <?= number_format($plano['preco'], 2, ',', '.') ?><small class="text-muted fw-light">/mês</small></h3>
                <ul class="list-unstyled mt-3 mb-4">
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['armazenamento'] ?> SSD</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['largura_banda'] ?> de banda</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['sites'] ?> site(s)</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['contas_email'] ?> contas de e-mail</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $plano['banco_dados'] ?> banco(s) de dados</li>
                    <?php if ($plano['dominio_gratis']): ?>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Domínio grátis</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="card-footer bg-transparent">
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#planoModal<?= $plano['id'] ?>">
                    Assinar Plano
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para cada plano -->
    <div class="modal fade" id="planoModal<?= $plano['id'] ?>" tabindex="-1" aria-labelledby="planoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="planoModalLabel">Assinar <?= htmlspecialchars($plano['nome']) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (!isLoggedIn()): ?>
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Você precisa estar logado para assinar um plano.
                        </div>
                        <div class="d-grid gap-2">
                            <a href="/hospedagem/login.php" class="btn btn-primary">Fazer Login</a>
                            <a href="/hospedagem/register.php" class="btn btn-outline-primary">Criar Conta</a>
                        </div>
                    <?php else: 
                        // Verificar se usuário já tem este plano
                        $stmt = $pdo->prepare("SELECT * FROM assinaturas WHERE usuario_id = ? AND plano_id = ? AND status = 'ativo'");
                        $stmt->execute([$_SESSION['user_id'], $plano['id']]);
                        $assinatura = $stmt->fetch();
                        
                        if ($assinatura): ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle-fill me-2"></i> Você já possui este plano ativo.
                            </div>
                            <a href="/hospedagem/user/dashboard.php" class="btn btn-primary w-100">Ir para meu painel</a>
                        <?php else: ?>
                            <p>Você está prestes a assinar o plano <strong><?= htmlspecialchars($plano['nome']) ?></strong> por <strong>R$ <?= number_format($plano['preco'], 2, ',', '.') ?> mensais</strong>.</p>
                            <p>Confirme abaixo para prosseguir com o pagamento.</p>
                            <form action="/hospedagem/pagamento.php" method="post">
                                <input type="hidden" name="plano_id" value="<?= $plano['id'] ?>">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Confirmar Assinatura</button>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
