
const user_register_form = document.getElementById('user_register')

function validateForm(event) {
    // Obtenha todos os campos
    let name = document.getElementById("name");
    let address = document.getElementById("address");
    let number = document.getElementById("number");
    let neighborhood = document.getElementById("neighborhood");
    let city = document.getElementById("city");
    let state = document.getElementById("state");
    let email = document.getElementById("email");
    let cpf_cnpj = document.getElementById("cpf_cnpj");
    let rg = document.getElementById("rg");
    let phonenumber = document.getElementById("phonenumber");
    let cellphone = document.getElementById("cellphone");
    let username = document.getElementById("username");
    let password = document.getElementById("password");

    // Crie um array com os campos para facilitar a iteração
    // let fields = [name, address, number, neighborhood, city, state, email, cpf_cnpj, rg, phonenumber, cellphone, username, password];
    let fields = [name, address, number, neighborhood, city, state, email, cpf_cnpj, rg, cellphone, username, password];
    
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

    if (hasError) {
        alert("Por favor, preencha todos os campos.");
        event.preventDefault();
    }
    return !hasError;
}

user_register_form.addEventListener('submit', validateForm)
