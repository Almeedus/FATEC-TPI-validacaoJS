import { validateCNPJ, validateCPF } from '../js/validation/cpf_cnpj.mjs';

const user_register_form = document.getElementById('user_register'); 

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

    console.log(isCNPJValid, isCPFValid)

    if (!isCPFValid && !isCNPJValid) {
        cpf_cnpj.classList.add("error");
        hasError = true;
    } else {
        cpf_cnpj.classList.remove("error");
    }

    if (hasError) {
        alert("Por favor, preencha todos os campos e forneça um CPF ou CNPJ válido.");
        event.preventDefault();
    }
    return !hasError;
}

user_register_form.addEventListener('submit', validateForm);
