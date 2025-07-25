<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/clinform/sistema-anamnese/clinform/public/css/contato/style.css">

</head>

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

        <form id="contactForm" action="/clinform/enviar-email.php" method="POST" novalidate>
            <div class="form-group">
                <input type="text" name="nome" id="nome" required placeholder=" ">
                <label for="nome">Nome<span class="required"></span></label>
                <div class="error-message" id="nomeError"></div>
            </div>

            <div class="form-group">
                <input type="text" name="empresa" id="empresa" required placeholder=" ">
                <label for="empresa">Empresa<span class="required"></span></label>
                <div class="error-message" id="empresaError"></div>
            </div>

            <div class="form-group">
                <div class="phone-input">
                    <input type="tel" name="telefone" id="telefone" required placeholder=" ">
                    <label for="telefone">Telefone<span class="required"></span></label>
                </div>
                <div class="error-message" id="telefoneError"></div>
            </div>

            <div class="form-group">
                <input type="email" name="email" id="email" required placeholder=" ">
                <label for="email">Email<span class="required"></span></label>
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group">
                <input type="text" name="assunto" id="assunto" required placeholder=" ">
                <label for="assunto">Assunto<span class="required"></span></label>
                <div class="error-message" id="assuntoError"></div>
            </div>

            <div class="form-group">
                <textarea name="mensagem" id="mensagem" rows="5" required placeholder=" "></textarea>
                <label for="mensagem">Digite sua mensagem aqui...<span class="required"></span></label>
                <div class="error-message" id="mensagemError"></div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                <span class="btn-text">Enviar</span>
                <div class="loading"></div>
            </button>
        </form>
    </div>
</div>
</div>

<script>
    class ContactFormValidator {
        constructor() {
            this.form = document.getElementById('contactForm');
            this.submitBtn = document.getElementById('submitBtn');
            this.messageContainer = document.getElementById('messageContainer');

            this.fields = {
                nome: {
                    element: document.getElementById('nome'),
                    errorElement: document.getElementById('nomeError')
                },
                empresa: {
                    element: document.getElementById('empresa'),
                    errorElement: document.getElementById('empresaError')
                },
                telefone: {
                    element: document.getElementById('telefone'),
                    errorElement: document.getElementById('telefoneError')
                },
                email: {
                    element: document.getElementById('email'),
                    errorElement: document.getElementById('emailError')
                },
                assunto: {
                    element: document.getElementById('assunto'),
                    errorElement: document.getElementById('assuntoError')
                },
                mensagem: {
                    element: document.getElementById('mensagem'),
                    errorElement: document.getElementById('mensagemError')
                }
            };

            this.init();
            this.checkUrlParams();
        }

        init() {
            Object.keys(this.fields).forEach(fieldName => {
                const field = this.fields[fieldName];

                field.element.addEventListener('blur', () => {
                    this.validateField(fieldName);
                });

                field.element.addEventListener('input', () => {
                    if (field.element.classList.contains('invalid')) {
                        this.validateField(fieldName);
                    }
                });
            });

            this.form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleSubmit();
            });
        }

        validateField(fieldName) {
            const field = this.fields[fieldName];
            const value = field.element.value.trim();

            field.element.classList.remove('valid', 'invalid');
            field.errorElement.classList.remove('show');

            // Apenas validação de campo obrigatório
            if (value === '') {
                field.element.classList.add('invalid');
                field.errorElement.textContent = 'Este campo é obrigatório.';
                field.errorElement.classList.add('show');
                return false;
            } else {
                field.element.classList.add('valid');
                return true;
            }
        }

        validateAllFields() {
            let isFormValid = true;

            Object.keys(this.fields).forEach(fieldName => {
                const isFieldValid = this.validateField(fieldName);
                if (!isFieldValid) {
                    isFormValid = false;
                }
            });

            return isFormValid;
        }

        async handleSubmit() {
            if (!this.validateAllFields()) {
                this.showMessage('Por favor, preencha todos os campos obrigatórios.', 'error');
                return;
            }

            this.submitBtn.classList.add('submitting');
            this.submitBtn.disabled = true;

            try {
                await this.simulateSubmit();
                this.showMessage('Mensagem enviada com sucesso! Entraremos em contato em breve.', 'success');
                this.form.reset();
                this.resetFieldsState();

            } catch (error) {
                this.showMessage('Erro ao enviar a mensagem. Tente novamente.', 'error');
            } finally {
                this.submitBtn.classList.remove('submitting');
                this.submitBtn.disabled = false;
            }
        }

        async simulateSubmit() {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    if (Math.random() > 0.1) {
                        resolve();
                    } else {
                        reject(new Error('Erro simulado'));
                    }
                }, 2000);
            });
        }

        resetFieldsState() {
            Object.keys(this.fields).forEach(fieldName => {
                const field = this.fields[fieldName];
                field.element.classList.remove('valid', 'invalid');
                field.errorElement.classList.remove('show');
            });
        }

        showMessage(message, type) {
            this.messageContainer.innerHTML = `
          <div class="message ${type}">
            ${message}
          </div>
        `;

            setTimeout(() => {
                this.messageContainer.innerHTML = '';
            }, 5000);
        }

        checkUrlParams() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status === 'success') {
                this.showMessage('Mensagem enviada com sucesso!', 'success');
            } else if (status === 'error') {
                this.showMessage('Erro ao enviar a mensagem.', 'error');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        new ContactFormValidator();
    });
</script>

</html>