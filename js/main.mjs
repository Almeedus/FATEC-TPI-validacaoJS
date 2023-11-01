// const validateForm = require('user_register');
// const { validateCPF, validateCNPJ } = require('./validation/cpf_cnpj');


// //form validation
// function validationForm() {
//     return validateForm();
// };

// //CNPJ and CPF validations
// function validationCPF(userInput) {
//     const cpfInput = userInput;

//     const isValid = validateCPF(cpfInput);

//     if (!isValid) {
//         alert('CPF inválido!')
//     } else {
//         validateCPF();
//     }
// };

// function validationCNPJ(userInput) {
//     const cnpjInput = userInput;

//     const isValid = validateCPF(cnpjInput);

//     if (!isValid) {
//         alert('CNPJ inválido!')
//     } else {
//         validateCNPJ();
//     }
// };

// document.getElementById('user_register').addEventListener('submit', function(event) {
//     event.preventDefault();

//     function validateDigits() {
//         const userInput = document.getElementById('cpf_cnpj').value;
    
//         if (userInput != "" || userInput.length == 11) {
//             return validationCPF();
//         }
//         else if (userInput != "" || userInput.length == 14) {
//             return validationCNPJ();
//         }
//         else {
//             return alert('Informe uma quantidade de números válidos.')
//         }
    
//     };
// });

