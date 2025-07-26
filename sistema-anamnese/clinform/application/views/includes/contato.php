<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/clinform/sistema-anamnese/clinform/public/css/contato/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Contato - ClinForm</title>
</head>

<body>
    <div class="contato-container">
        <!-- Seção de Informações -->
        <div class="info-section">
            <h1 class="main-title">Entre em contato conosco</h1>
            <p class="subtitle">
                <strong>Envie um e-mail, faça uma ligação ou preencha o formulário,</strong>
                e um membro da nossa equipe entrará em contato com você o mais breve possível.
            </p>

            <div class="contact-info">
                <div class="contact-item">
                    <span class="contact-label">WhatsApp Comercial:</span>
                    <span class="contact-value">
                        <a href="https://wa.me/5541987714503" target="_blank">(41) 98771-4503</a>
                    </span>
                </div>

                <div class="contact-item">
                    <span class="contact-label">E-mail:</span>
                    <span class="contact-value">
                        <a href="mailto:suporte@egssistemas.com">suporte@egssistemas.com</a>
                    </span>
                </div>
            </div>
        </div>

        <!-- Seção do Formulário -->
        <div class="form-section">
            <div class="form-header">
                <h2 class="form-title">No que podemos <span class="highlight">ajudar?</span></h2>
                <p class="form-subtitle">
                    Preencha as informações abaixo.<br>
                    Em breve, entraremos em contato.
                </p>
            </div>

            <div id="messageContainer"></div>

            <form id="contactForm" action="index.php?action=enviar-email" method="POST">
                <div class="form-group">
                    <input type="text" name="nome" id="nome" required placeholder=" ">
                    <label for="nome">Nome <span class="required">*</span></label>
                    <div class="error-message" id="nomeError"></div>
                </div>

                <div class="form-group">
                    <input type="text" name="empresa" id="empresa" required placeholder=" ">
                    <label for="empresa">Empresa <span class="required">*</span></label>
                    <div class="error-message" id="empresaError"></div>
                </div>

                <div class="form-group">
                    <div class="phone-input">
                        <input type="tel" name="telefone" id="telefone" required placeholder=" ">
                        <label for="telefone">Telefone <span class="required">*</span></label>
                    </div>
                    <div class="error-message" id="telefoneError"></div>
                </div>

                <div class="form-group">
                    <input type="email" name="email" id="email" required placeholder=" ">
                    <label for="email">Email <span class="required">*</span></label>
                    <div class="error-message" id="emailError"></div>
                </div>

                <div class="form-group">
                    <input type="text" name="assunto" id="assunto" required placeholder=" ">
                    <label for="assunto">Assunto <span class="required">*</span></label>
                    <div class="error-message" id="assuntoError"></div>
                </div>

                <div class="form-group">
                    <textarea name="mensagem" id="mensagem" rows="5" required placeholder=" "></textarea>
                    <label for="mensagem">Digite sua mensagem aqui... <span class="required">*</span></label>
                    <div class="error-message" id="mensagemError"></div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <span class="btn-text">Enviar</span>
                    <div class="loading"></div>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            const messageContainer = document.getElementById('messageContainer');

            const fields = {
                nome: {
                    el: document.getElementById('nome'),
                    error: document.getElementById('nomeError')
                },
                empresa: {
                    el: document.getElementById('empresa'),
                    error: document.getElementById('empresaError')
                },
                telefone: {
                    el: document.getElementById('telefone'),
                    error: document.getElementById('telefoneError')
                },
                email: {
                    el: document.getElementById('email'),
                    error: document.getElementById('emailError')
                },
                assunto: {
                    el: document.getElementById('assunto'),
                    error: document.getElementById('assuntoError')
                },
                mensagem: {
                    el: document.getElementById('mensagem'),
                    error: document.getElementById('mensagemError')
                }
            };

            function validateField(name) {
                const field = fields[name];
                const value = field.el.value.trim();
                field.el.classList.remove('invalid', 'valid');
                field.error.classList.remove('show');

                if (value === '') {
                    field.el.classList.add('invalid');
                    field.error.textContent = 'Este campo é obrigatório.';
                    field.error.classList.add('show');
                    return false;
                } else {
                    field.el.classList.add('valid');
                    return true;
                }
            }

            function validateAllFields() {
                return Object.keys(fields).every(name => validateField(name));
            }

            Object.keys(fields).forEach(name => {
                const field = fields[name];
                field.el.addEventListener('blur', () => validateField(name));
                field.el.addEventListener('input', () => {
                    if (field.el.classList.contains('invalid')) validateField(name);
                });
            });

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                if (!validateAllFields()) {
                    Swal.fire('Atenção!', 'Preencha todos os campos obrigatórios.', 'warning');
                    return;
                }

                const formData = new FormData(form);

                Swal.fire({
                    title: 'Enviando...',
                    text: 'Aguarde enquanto enviamos sua mensagem.',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                submitBtn.classList.add('submitting');
                submitBtn.disabled = true;

                try {
                    const response = await fetch('?action=enviar-email', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();
                    Swal.close();

                    if (result.success) {
                        Swal.fire('✅ Sucesso!', result.message, 'success');
                        form.reset();
                        Object.keys(fields).forEach(name => {
                            fields[name].el.classList.remove('valid', 'invalid');
                            fields[name].error.classList.remove('show');
                        });
                    } else {
                        Swal.fire('❌ Erro!', result.message, 'error');
                    }

                } catch (err) {
                    Swal.close();
                    Swal.fire('❌ Erro inesperado!', 'Houve um problema na conexão.', 'error');
                } finally {
                    submitBtn.classList.remove('submitting');
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
</body>

</html>