 <style>
     /* Estilo do botão WhatsApp flutuante */
     .whatsapp-float {
         position: fixed;
         width: 60px;
         height: 60px;
         bottom: 20px;
         right: 20px;
         background: #25D366;
         color: white;
         border-radius: 50%;
         text-align: center;
         font-size: 28px;
         box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
         z-index: 1000;
         transition: all 0.3s ease;
         cursor: pointer;
         display: flex;
         align-items: center;
         justify-content: center;
         text-decoration: none;
         animation: pulse 2s infinite;
     }

     .whatsapp-float:hover {
         background: #1eb854;
         transform: scale(1.1);
         box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
     }

     .whatsapp-float:active {
         transform: scale(0.95);
     }

     /* Animação de pulso */
     @keyframes pulse {
         0% {
             box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
         }

         50% {
             box-shadow: 0 4px 30px rgba(37, 211, 102, 0.7);
         }

         100% {
             box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
         }
     }

     /* Tooltip opcional */
     .whatsapp-float::before {
         content: 'Fale conosco!';
         position: absolute;
         top: -45px;
         right: 0;
         background: #333;
         color: white;
         padding: 8px 12px;
         border-radius: 5px;
         font-size: 12px;
         white-space: nowrap;
         opacity: 0;
         visibility: hidden;
         transition: all 0.3s ease;
         font-family: Arial, sans-serif;
     }

     .whatsapp-float::after {
         content: '';
         position: absolute;
         top: -5px;
         right: 15px;
         width: 0;
         height: 0;
         border-left: 5px solid transparent;
         border-right: 5px solid transparent;
         border-top: 5px solid #333;
         opacity: 0;
         visibility: hidden;
         transition: all 0.3s ease;
     }

     .whatsapp-float:hover::before,
     .whatsapp-float:hover::after {
         opacity: 1;
         visibility: visible;
     }

     /* Responsividade */
     @media (max-width: 768px) {
         .whatsapp-float {
             width: 55px;
             height: 55px;
             font-size: 24px;
             bottom: 15px;
             right: 15px;
         }

     }

     /* Versão alternativa com texto */
     .whatsapp-text {
         display: none;
         position: fixed;
         bottom: 20px;
         right: 20px;
         background: #25D366;
         color: white;
         padding: 12px 20px;
         border-radius: 25px;
         text-decoration: none;
         font-weight: bold;
         box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
         z-index: 1000;
         transition: all 0.3s ease;
         font-family: Arial, sans-serif;
     }

     .whatsapp-text:hover {
         background: #1eb854;
         transform: translateY(-2px);
         box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
     }
 </style>
 <a href="https://wa.me/5544999506302" class="whatsapp-float" target="_blank">
     <i class="fab fa-whatsapp"></i>
 </a>

 <script>
     // Script opcional para melhorar a experiência
     document.addEventListener('DOMContentLoaded', function() {
         const whatsappButton = document.querySelector('.whatsapp-float');

         // Adiciona um pequeno delay na animação quando a página carrega
         setTimeout(() => {
             whatsappButton.style.opacity = '1';
         }, 500);

         // Opcional: esconder o botão quando o usuário está digitando em um formulário
         const inputs = document.querySelectorAll('input, textarea');
         inputs.forEach(input => {
             input.addEventListener('focus', () => {
                 whatsappButton.style.transform = 'scale(0.8)';
                 whatsappButton.style.opacity = '0.7';
             });

             input.addEventListener('blur', () => {
                 whatsappButton.style.transform = 'scale(1)';
                 whatsappButton.style.opacity = '1';
             });
         });
     });
 </script>