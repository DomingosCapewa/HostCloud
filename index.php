<?php
require_once 'includes/config.php';
require_once 'includes/header.php';
?>

<div class="hero-section bg-primary text-white py-5 mb-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold"><i class="bi bi-cloud-arrow-up-fill"></i> Hospedagem Profissional</h1>
        <p class="lead">Soluções completas para seu site com alta performance e segurança</p>
        <a href="planos.php" class="btn btn-light btn-lg mt-3">Ver Planos</a>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-speedometer2 fs-1 text-primary"></i>
                    <h3 class="card-title">Performance</h3>
                    <p class="card-text">Servidores otimizados para máxima velocidade de carregamento.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-shield-lock fs-1 text-primary"></i>
                    <h3 class="card-title">Segurança</h3>
                    <p class="card-text">Proteção avançada contra ataques e certificado SSL gratuito.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-headset fs-1 text-primary"></i>
                    <h3 class="card-title">Suporte 24/7</h3>
                    <p class="card-text">Nossa equipe está disponível a qualquer momento para ajudar.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
