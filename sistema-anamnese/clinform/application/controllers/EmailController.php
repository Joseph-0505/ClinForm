<?php
// application/controllers/EmailController.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailController
{
    public function enviarContato()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->jsonResponse(false, 'Método não permitido.');
        }

        // Captura dos dados do formulário
        $nome     = $_POST['nome']     ?? '';
        $email    = $_POST['email']    ?? '';
        $empresa  = $_POST['empresa']  ?? '';
        $assunto  = $_POST['assunto']  ?? '';
        $mensagem = $_POST['mensagem'] ?? '';

        // Verificação básica de campos obrigatórios
        if (!$nome || !$email || !$empresa || !$assunto || !$mensagem) {
            return $this->jsonResponse(false, 'Preencha todos os campos obrigatórios.');
        }

        // Log para debug
        error_log("=== DADOS RECEBIDOS ===");
        error_log("Nome: $nome | Email: $email | Empresa: $empresa | Assunto: $assunto");

        try {
            $mail = new PHPMailer(true);

            // Debug para log
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Debugoutput = function ($str, $level) {
                error_log("PHPMailer Debug: $str");
            };

            // Configuração SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sjosevictor31@gmail.com';
            $mail->Password   = 'ynpj gbgg rwtt tsxs'; // ← SENHA DE APP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';
            $mail->Timeout    = 60;
            $mail->SMTPKeepAlive = true;

            // Endereçamento
            $mail->setFrom('sjosevictor31@gmail.com', 'ClinForm Sistema');
            $mail->addAddress('sjosevictor31@gmail.com');
            $mail->addReplyTo($email, $nome);

            // Conteúdo HTML
            $mail->isHTML(true);
            $mail->Subject = 'Nova solicitação de contato - ClinForm';
            $mail->Body = "
                <h2>Nova Solicitação de Contato</h2>
                <p><strong>Data:</strong> " . date('d/m/Y H:i:s') . "</p>
                <p><strong>Nome:</strong> {$nome}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Empresa:</strong> {$empresa}</p>
                <p><strong>Assunto:</strong> {$assunto}</p>
                <p><strong>Mensagem:</strong> {$mensagem}</p>
                <hr>
                <p>Nossa equipe retornará em até 24 horas.</p>
                <p>Contato urgente: (41) 98771-4503</p>
                <p>Atenciosamente,<br>ClinForm</p>
            ";

            // Envio do email
            if ($mail->send()) {
                error_log("=== EMAIL ENVIADO COM SUCESSO ===");
                return $this->jsonResponse(true, 'Mensagem enviada com sucesso! Verifique sua caixa de entrada.');
            } else {
                error_log("=== FALHA NO ENVIO ===");
                return $this->jsonResponse(false, 'Erro ao enviar o e-mail.');
            }
        } catch (Exception $e) {
            error_log("=== ERRO DE ENVIO ===");
            error_log("Mensagem: " . $e->getMessage());
            error_log("Arquivo: " . $e->getFile() . " Linha: " . $e->getLine());

            return $this->jsonResponse(false, 'Erro técnico ao enviar: ' . $e->getMessage());
        }
    }

    private function jsonResponse($success, $message)
    {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success,
            'message' => $message
        ]);
        exit;
    }
}
