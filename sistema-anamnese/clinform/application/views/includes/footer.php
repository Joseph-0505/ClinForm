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
<script>
    // Animação dinâmica das barras de progresso
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.mockup-progress-fill');

        function animateProgress() {
            progressBars.forEach((bar, index) => {
                const baseWidths = [85, 72, 93];
                const variation = (Math.random() - 0.5) * 10;
                const newWidth = Math.max(50, Math.min(100, baseWidths[index] + variation));

                setTimeout(() => {
                    bar.style.width = newWidth + '%';
                }, index * 200);
            });
        }

        setInterval(animateProgress, 4000);
    });

    // Efeito 3D interativo no mockup
    const mockupContainer = document.querySelector('.mockup-container');
    const mockup = document.querySelector('.mockup');

    mockup.addEventListener('mousemove', function(e) {
        const rect = mockup.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = (y - centerY) / 15;
        const rotateY = (centerX - x) / 15;

        mockupContainer.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    });

    mockup.addEventListener('mouseleave', function() {
        mockupContainer.style.transform = 'perspective(1000px) rotateY(-15deg) rotateX(5deg)';
    });

    // Animação de tabs
    const tabs = document.querySelectorAll('.mockup-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // CTAs com feedback visual
    const buttons = document.querySelectorAll('.cta-button');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            // Feedback visual
            const original = this.innerHTML;
            this.innerHTML = '✓ Redirecionando...';
            this.style.opacity = '0.8';

            setTimeout(() => {
                this.innerHTML = original;
                this.style.opacity = '1';
            }, 1500);
        });
    });
</script>

</html>