<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/clinform/sistema-anamnese/clinform/public/css/erro404/style.css">
    <link rel="stylesheet" href="/clinform/sistema-anamnese/clinform/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">

</head>
<div class="floating-elements"></div>
<div class="error-container">
    <div class="error-content">
        <div class="error-image">
            <img src="/clinform/sistema-anamnese/clinform/public/images/erro404.jpg" alt="Erro 404 - Página não encontrada">
        </div>

        <div class="error-text">
            <div class="error-code">404</div>
            <h1 class="error-title">Ops! Página não encontrada</h1>
            <p class="error-subtitle">
                Parece que a página que você está procurando saiu para uma consulta e ainda não voltou.
                Que tal explorar outras áreas da nossa plataforma?
            </p>

            <div class="error-buttons">
                <a href="<?= BASE_URL ?>home" class="btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Ir para Home
                </a>

                <a href="#" class="btn-secondary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Voltar
                </a>
            </div>
        </div>
    </div>

    <div class="help-section">
        <h2 class="help-title">Como podemos ajudar?</h2>
        <div class="help-grid">
            <div class="help-item">
                <div class="help-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11" cy="11" r="8" stroke="white" stroke-width="2" />
                        <path d="M21 21L16.65 16.65" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3>Buscar conteúdo</h3>
                <p>Use nossa busca para encontrar formulários, templates ou documentação específica.</p>
            </div>

            <div class="help-item">
                <div class="help-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3>Falar com suporte</h3>
                <p>Nossa equipe está pronta para esclarecer dúvidas e resolver problemas técnicos.</p>
            </div>

            <div class="help-item">
                <div class="help-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3>Ver documentação</h3>
                <p>Acesse tutoriais e guias completos sobre como usar nossa plataforma de anamnese.</p>
            </div>
        </div>
    </div>
</div>

</html>