<footer>
    <div class="footer-container">
        <hr style="margin: 2rem 0; border-color: #c8d1e1ff;">
        <p>&copy; 2025 ClinForm. Todos os direitos reservados.</p>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>js/main.js"></script>

<!------------------------------------ HEADER --------------------------------------------------->
<script>
    // Elementos do menu mobile
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    // Função para abrir o menu
    function openMobileMenu() {
        mobileMenu.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Impede o scroll da página
    }

    // Função para fechar o menu
    function closeMobileMenu() {
        mobileMenu.classList.remove('active');
        mobileMenuOverlay.classList.remove('active');
        document.body.style.overflow = ''; // Restaura o scroll da página
    }

    // Event listeners
    mobileMenuToggle.addEventListener('click', openMobileMenu);
    mobileMenuClose.addEventListener('click', closeMobileMenu);
    mobileMenuOverlay.addEventListener('click', closeMobileMenu);

    // Fechar menu ao clicar em um link
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Fechar menu com a tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });

    // Prevenir scroll no overlay
    mobileMenuOverlay.addEventListener('touchmove', function(e) {
        e.preventDefault();
    }, {
        passive: false
    });
</script>

</html>