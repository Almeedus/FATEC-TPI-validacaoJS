
// Função para validar CPF
function validateCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf === '') return false;

    // Elimina CPFs inválidos conhecidos
    if (
    cpf.length !== 11 ||
    cpf === '00000000000' ||
    cpf === '11111111111' ||
    cpf === '22222222222' ||
    cpf === '33333333333' ||
    cpf === '44444444444' ||
    cpf === '55555555555' ||
    cpf === '66666666666' ||
    cpf === '77777777777' ||
    cpf === '88888888888' ||
    cpf === '99999999999'
    ) {
    return false;
    }

    // Valida 1º dígito
    let add = 0;
    for (let i = 0; i < 9; i++) {
    add += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let rev = 11 - (add % 11);
    if (rev === 10 || rev === 11) {
    rev = 0;
    }
    if (rev !== parseInt(cpf.charAt(9))) {
    return false;
    }

    // Valida 2º dígito
    add = 0;
    for (let i = 0; i < 10; i++) {
    add += parseInt(cpf.charAt(i)) * (11 - i);
    }
    rev = 11 - (add % 11);
    if (rev === 10 || rev === 11) {
    rev = 0;
    }
    if (rev !== parseInt(cpf.charAt(10))) {
    return false;
    }

    return true;
}
  
// Função para validar CNPJ
function validateCNPJ(cnpj) {
    // Remove caracteres não numéricos
    cnpj = cnpj.replace(/[^\d]+/g, '');
  
    if (cnpj === '') return false;
  
    if (cnpj.length !== 14) return false;
  
    // Elimina CNPJs inválidos conhecidos
    if (
      cnpj === '00000000000000' ||
      cnpj === '11111111111111' ||
      cnpj === '22222222222222' ||
      cnpj === '33333333333333' ||
      cnpj === '44444444444444' ||
      cnpj === '55555555555555' ||
      cnpj === '66666666666666' ||
      cnpj === '77777777777777' ||
      cnpj === '88888888888888' ||
      cnpj === '99999999999999'
    ) {
      return false;
    }
  
    // Valida DVs
    let size = cnpj.length - 2;
    let numbers = cnpj.substring(0, size);
    let digits = cnpj.substring(size);
    let sum = 0;
    let pos = size - 7;
  
    for (let i = size; i >= 1; i--) {
      sum += parseInt(numbers.charAt(size - i)) * pos--;
      if (pos < 2) pos = 9;
    }
  
    const result = sum % 11 < 2 ? 0 : 11 - (sum % 11);
  
    if (result != digits.charAt(0)) return false;
  
    size = size + 1;
    numbers = cnpj.substring(0, size);
    sum = 0;
    pos = size - 7;
  
    for (let i = size; i >= 1; i--) {
      sum += parseInt(numbers.charAt(size - i)) * pos--;
      if (pos < 2) pos = 9;
    }
  
    const secondDigit = sum % 11 < 2 ? 0 : 11 - (sum % 11);
  
    if (secondDigit != digits.charAt(1)) return false;
  
    return true;
  }

const user_form = document.querySelector('.user_form'); 

//Obtenhas os campos
const name = document.getElementById("name");
const address = document.getElementById("address");
const number = document.getElementById("number");
const neighborhood = document.getElementById("neighborhood");
const city = document.getElementById("city");
const state = document.getElementById("state");
const email = document.getElementById("email");
const cpf_cnpj = document.getElementById("cpf_cnpj");
const rg = document.getElementById("rg");
const phonenumber = document.getElementById("phonenumber");
const cellphone = document.getElementById("cellphone");
const username = document.getElementById("username");
const password = document.getElementById("password");

cpf_cnpj.addEventListener('blur', function(event) {
    // Obtenha o valor do campo CPF/CNPJ
    const cpfCnpjValue = event.target.value;

    // Valide CPF ou CNPJ
    let isCPFValid = validateCPF(cpfCnpjValue);
    let isCNPJValid = validateCNPJ(cpfCnpjValue);

    // Remova classes de erro do campo
    cpf_cnpj.classList.remove("error");

    // Exiba uma mensagem de erro se tanto CPF quanto CNPJ forem inválidos
    if (!isCPFValid && !isCNPJValid) {
        cpf_cnpj.classList.add("error");
        alert("Por favor, forneça um CPF ou CNPJ válido.");
    }
});

function validateForm(event) {
    
    // Crie um array com os campos para facilitar a iteração
    let fields = [name, address, number, neighborhood, city, state, email, cpf_cnpj, rg, phonenumber, cellphone, username, password];

    // Verifique cada campo
    let hasError = false;
    for (let field of fields) {
        if (field.value === "") {
            field.classList.add("error"); // Adiciona a classe "error" aos campos vazios
            hasError = true;
        } else {
            field.classList.remove("error"); // Remove a classe "error" dos campos preenchidos
        }
    }

    // Valide CPF ou CNPJ
    let isCPFValid = validateCPF(cpf_cnpj.value);
    let isCNPJValid = validateCNPJ(cpf_cnpj.value);

    if (!isCPFValid && !isCNPJValid) {
        cpf_cnpj.classList.add("error");
        hasError = true;
        alert('CPF/CNPJ inválido.')
    } else {
        cpf_cnpj.classList.remove("error");
    }

    // Valide telefone e celular
    if (phonenumber.value.trim().length !== 11) {
        phonenumber.classList.add("error");
        hasError = true;
        alert('Número de telefone deve possuir 11 caracteres.')
    } else {
        phonenumber.classList.remove("error");
    }

    if (cellphone.value.trim().length !== 11) {
        cellphone.classList.add("error");
        hasError = true;
        alert('Número de celular deve possuir 11 caracteres.')
    } else {
        cellphone.classList.remove("error");
    }

    if (hasError) {
        event.preventDefault();
    }
    return !hasError;
}

user_form.addEventListener('submit', validateForm);
