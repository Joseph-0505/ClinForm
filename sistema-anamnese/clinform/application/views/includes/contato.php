<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/clinform/sistema-anamnese/clinform/public/css/contato/style.css">

</head>

<div class="contato-container">
    <div class="header">
        <h1>Entre em Contato</h1>
        <p>Preencha o formulário e fale conosco via WhatsApp</p>
    </div>

    <form id="contactForm">
        <div class="form-group">
            <label for="nome">Nome Completo <span class="required">*</span></label>
            <input type="text" id="nome" name="nome" required>
            <div class="success-icon">✓</div>
            <div class="error-icon">✕</div>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label for="email">E-mail <span class="required">*</span></label>
            <input type="email" id="email" name="email" required>
            <div class="success-icon">✓</div>
            <div class="error-icon">✕</div>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone/WhatsApp <span class="required">*</span></label>
            <input type="tel" id="telefone" name="telefone" required placeholder="(11) 99999-9999">
            <div class="success-icon">✓</div>
            <div class="error-icon">✕</div>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label for="assunto">Assunto</label>
            <select id="assunto" name="assunto">
                <option value="">Selecione um assunto</option>
                <option value="Informações Gerais">Informações Gerais</option>
                <option value="Suporte">Suporte</option>
                <option value="Orçamento">Orçamento</option>
                <option value="Reclamação">Reclamação</option>
                <option value="Sugestão">Sugestão</option>
                <option value="Outro">Outro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="mensagem">Mensagem <span class="required">*</span></label>
            <textarea id="mensagem" name="mensagem" placeholder="Descreva sua mensagem aqui..." required></textarea>
            <div class="success-icon">✓</div>
            <div class="error-icon">✕</div>
            <div class="error-message"></div>
        </div>

        <button type="submit" class="submit-btn">
            <svg class="whatsapp-icon" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
            </svg>
            <span class="btn-text">Enviar via WhatsApp</span>
            <div class="loading"></div>
        </button>
    </form>
</div>

<script>
    // Funções de validação
    const validators = {
        nome: (value) => {
            if (!value.trim()) return 'Nome é obrigatório';
            if (value.trim().length < 2) return 'Nome deve ter pelo menos 2 caracteres';
            if (!/^[a-zA-ZÀ-ÿ\s]+$/.test(value)) return 'Nome deve conter apenas letras';
            return null;
        },

        email: (value) => {
            if (!value.trim()) return 'E-mail é obrigatório';
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) return 'E-mail inválido';
            return null;
        },

        telefone: (value) => {
            if (!value.trim()) return 'Telefone é obrigatório';
            const cleanPhone = value.replace(/\D/g, '');
            if (cleanPhone.length < 10 || cleanPhone.length > 11) {
                return 'Telefone deve ter 10 ou 11 dígitos';
            }
            return null;
        },

        mensagem: (value) => {
            if (!value.trim()) return 'Mensagem é obrigatória';
            if (value.trim().length < 10) return 'Mensagem deve ter pelo menos 10 caracteres';
            if (value.trim().length > 1000) return 'Mensagem muito longa (máximo 1000 caracteres)';
            return null;
        }
    };

    // Função para validar campo individual
    function validateField(fieldName, value) {
        const formGroup = document.getElementById(fieldName).closest('.form-group');
        const errorMessage = formGroup.querySelector('.error-message');
        const successIcon = formGroup.querySelector('.success-icon');
        const errorIcon = formGroup.querySelector('.error-icon');

        const error = validators[fieldName] ? validators[fieldName](value) : null;

        // Limpar estados anteriores
        formGroup.classList.remove('error', 'success');
        errorMessage.style.display = 'none';
        successIcon.style.display = 'none';
        errorIcon.style.display = 'none';

        if (error) {
            formGroup.classList.add('error');
            errorMessage.textContent = error;
            errorMessage.style.display = 'block';
            errorIcon.style.display = 'block';
            return false;
        } else if (value.trim()) {
            formGroup.classList.add('success');
            successIcon.style.display = 'block';
            return true;
        }

        return true;
    }

    // Função para validar todo o formulário
    function validateForm() {
        let isValid = true;
        const requiredFields = ['nome', 'email', 'telefone', 'mensagem'];

        requiredFields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            const fieldValid = validateField(fieldName, field.value);
            if (!fieldValid) isValid = false;
        });

        return isValid;
    }

    // Adicionar validação em tempo real
    document.addEventListener('DOMContentLoaded', function() {
        const fields = ['nome', 'email', 'telefone', 'mensagem'];

        fields.forEach(fieldName => {
            const field = document.getElementById(fieldName);

            // Validação ao sair do campo
            field.addEventListener('blur', function() {
                validateField(fieldName, this.value);
            });

            // Validação durante a digitação (com delay)
            let timeout;
            field.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    validateField(fieldName, this.value);
                }, 500);
            });
        });
    });

    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validar formulário antes de enviar
        if (!validateForm()) {
            // Focar no primeiro campo com erro
            const firstError = this.querySelector('.form-group.error input, .form-group.error textarea');
            if (firstError) {
                firstError.focus();
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
            return;
        }

        // Elementos do botão
        const submitBtn = this.querySelector('.submit-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const loading = submitBtn.querySelector('.loading');
        const icon = submitBtn.querySelector('.whatsapp-icon');

        // Mostrar loading
        btnText.textContent = 'Enviando...';
        loading.style.display = 'block';
        icon.style.display = 'none';
        submitBtn.disabled = true;

        // Coletar dados do formulário
        const nome = document.getElementById('nome').value;
        const email = document.getElementById('email').value;
        const telefone = document.getElementById('telefone').value;
        const assunto = document.getElementById('assunto').value;
        const mensagem = document.getElementById('mensagem').value;

        // Criar mensagem para WhatsApp
        let whatsappMessage = `*Nova mensagem de contato*\n\n`;
        whatsappMessage += `*Nome:* ${nome}\n`;
        whatsappMessage += `*E-mail:* ${email}\n`;
        whatsappMessage += `*Telefone:* ${telefone}\n`;
        if (assunto) {
            whatsappMessage += `*Assunto:* ${assunto}\n`;
        }
        whatsappMessage += `*Mensagem:* ${mensagem}`;

        // Simular delay de envio
        setTimeout(() => {
            // Número do WhatsApp (substitua pelo seu número)
            // Formato: código do país + DDD + número (sem espaços, traços ou parênteses)
            const whatsappNumber = '5511999999999'; // Exemplo: +55 11 99999-9999

            // Codificar mensagem para URL
            const encodedMessage = encodeURIComponent(whatsappMessage);

            // Criar URL do WhatsApp
            const whatsappURL = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

            // Abrir WhatsApp
            window.open(whatsappURL, '_blank');

            // Resetar botão
            btnText.textContent = 'Enviar via WhatsApp';
            loading.style.display = 'none';
            icon.style.display = 'block';
            submitBtn.disabled = false;

            // Opcional: limpar formulário após sucesso
            // this.reset();
            // Limpar estados de validação
            // this.querySelectorAll('.form-group').forEach(group => {
            //     group.classList.remove('error', 'success');
            //     group.querySelector('.error-message').style.display = 'none';
            //     group.querySelector('.success-icon').style.display = 'none';
            //     group.querySelector('.error-icon').style.display = 'none';
            // });

        }, 1500);
    });

    // Máscara para telefone
    document.getElementById('telefone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');

        if (value.length <= 11) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{4,5})(\d{4})/, '$1-$2');
        }

        e.target.value = value;
    });
</script>


</html>