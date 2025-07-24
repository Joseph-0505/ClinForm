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
                <label for="nome"><span class="required"></span></label>
                <input type="text" name="nome" placeholder="Nome" id="nome" required>
                <div class="error-message" id="nomeError"></div>
            </div>

            <div class="form-group">
                <label for="empresa"> <span class="required"></span></label>
                <input type="text" name="empresa" placeholder="Empresa" id="empresa" required>
                <div class="error-message" id="empresaError"></div>
            </div>

            <div class="form-group">
                <label for="telefone"> <span class="required"></span></label>
                <div class="phone-input">
                    <input type="tel" name="telefone" id="telefone" placeholder="Telefone" placeholder="(00) 00000-0000" required>
                </div>
                <div class="error-message" id="telefoneError"></div>
            </div>

            <div class="form-group">
                <label for="email"> <span class="required"></span></label>
                <input type="email" name="email" placeholder="Email" id="email" required>
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group">
                <label for="assunto"> <span class="required"></span></label>
                <input type="text" name="assunto" placeholder="Assunto" id="assunto" required>
                <div class="error-message" id="assuntoError"></div>
            </div>

            <div class="form-group">
                <label for="mensagem"><span class="required"></span></label>
                <textarea name="mensagem" id="mensagem" rows="5" required placeholder="Digite sua mensagem aqui..."></textarea>
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
    class ContactFormValidator {
        constructor() {
            this.form = document.getElementById('contactForm');
            this.submitBtn = document.getElementById('submitBtn');
            this.messageContainer = document.getElementById('messageContainer');

            this.fields = {
                nome: {
                    element: document.getElementById('nome'),
                    errorElement: document.getElementById('nomeError'),
                    validators: ['required', 'minLength', 'nameFormat']
                },
                empresa: {
                    element: document.getElementById('empresa'),
                    errorElement: document.getElementById('empresaError'),
                    validators: ['required', 'maxLength']
                },
                telefone: {
                    element: document.getElementById('telefone'),
                    errorElement: document.getElementById('telefoneError'),
                    validators: ['required', 'phone']
                },
                email: {
                    element: document.getElementById('email'),
                    errorElement: document.getElementById('emailError'),
                    validators: ['required', 'email']
                },
                assunto: {
                    element: document.getElementById('assunto'),
                    errorElement: document.getElementById('assuntoError'),
                    validators: ['required', 'minLength']
                },
                mensagem: {
                    element: document.getElementById('mensagem'),
                    errorElement: document.getElementById('mensagemError'),
                    validators: ['required', 'minLength']
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
                    if (fieldName === 'telefone') {
                        this.formatPhone(field.element);
                    }

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
            let isValid = true;
            let errorMessage = '';

            field.element.classList.remove('valid', 'invalid');
            field.errorElement.classList.remove('show');

            for (const validator of field.validators) {
                const result = this.runValidator(validator, value, fieldName);
                if (!result.valid) {
                    isValid = false;
                    errorMessage = result.message;
                    break;
                }
            }

            if (isValid && value !== '') {
                field.element.classList.add('valid');
            } else if (!isValid) {
                field.element.classList.add('invalid');
                field.errorElement.textContent = errorMessage;
                field.errorElement.classList.add('show');
            }

            return isValid;
        }

        runValidator(validator, value, fieldName) {
            switch (validator) {
                case 'required':
                    return {
                        valid: value !== '',
                            message: 'Este campo é obrigatório.'
                    };

                case 'minLength':
                    const minLength = fieldName === 'mensagem' ? 10 : 2;
                    return {
                        valid: value.length >= minLength,
                            message: `Deve ter pelo menos ${minLength} caracteres.`
                    };

                case 'maxLength':
                    return {
                        valid: value.length <= 100,
                            message: 'Deve ter no máximo 100 caracteres.'
                    };

                case 'nameFormat':
                    const nameRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
                    return {
                        valid: nameRegex.test(value),
                            message: 'Nome deve conter apenas letras e espaços.'
                    };

                case 'email':
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return {
                        valid: emailRegex.test(value),
                            message: 'Digite um e-mail válido.'
                    };

                case 'phone':
                    const cleanPhone = value.replace(/\D/g, '');
                    return {
                        valid: cleanPhone.length >= 10 && cleanPhone.length <= 11,
                            message: 'Digite um telefone válido.'
                    };

                default:
                    return {
                        valid: true, message: ''
                    };
            }
        }

        formatPhone(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length <= 11) {
                if (value.length <= 2) {
                    value = value.replace(/(\d{0,2})/, '($1');
                } else if (value.length <= 6) {
                    value = value.replace(/(\d{2})(\d{0,4})/, '($1) $2');
                } else if (value.length <= 10) {
                    value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
                } else {
                    value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
                }
            }

            input.value = value;
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
                this.showMessage('Por favor, corrija os erros no formulário.', 'error');
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