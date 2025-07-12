<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/clinform/sistema-anamnese/clinform/public/css/style.css">
    <link rel="stylesheet" href="/clinform/sistema-anamnese/clinform/public/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">

    <?php
    if (isset($cssPage)) {
        if (is_array($cssPage)) {
            foreach ($cssPage as $css) {
                echo '<link rel="stylesheet" href="' . BASE_URL . 'css/' . $css . '">' . PHP_EOL;
            }
        } else {
            echo '<link rel="stylesheet" href="' . BASE_URL . 'css/' . $cssPage . '">' . PHP_EOL;
        }
    }
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL ?>home">
                <img src="/clinform/sistema-anamnese/clinform/public/images/logo.png" alt="clinform">
            </a>
            <!-- Botão toggler modificado para abrir menu lateral -->
            <button class="navbar-toggler d-lg-none" type="button" id="mobileMenuToggle" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-4">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>home"><i class="fas fa-home"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/includes/sobre.php"><i class="fas fa-info-circle"></i>Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contato.php"><i class="fas fa-envelope"></i>Contato</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn btn-primary">Façe seu orçamento</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <h4>ClinForm</h4>
            <button class="mobile-menu-close" id="mobileMenuClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-menu-content">
            <a class="nav-link" href="<?= BASE_URL ?>home"><i class="fas fa-home"></i>Home</a>
            <a href="sobre.php" class="mobile-nav-link"><i class="fas fa-info-circle"></i>Sobre</a>
            <a href="contato.php" class="mobile-nav-link"><i class="fas fa-envelope"></i>Contato</a>
            <button class="mobile-cta-button">Façe seu orçamento</button>
        </div>
</header>