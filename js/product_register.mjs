const formElement = document.querySelector('.product-form');

function sucessAlert() {
    alert('Cadastro realizado com sucesso!');
}

function validateForm(event) {
    // Realize suas verificações aqui
    const name = document.getElementById('name').value;
    const stockQuantity = document.getElementById('stockQuantity').value;
    const price = document.getElementById('price').value;

    if (name === '' || stockQuantity === '' || price === '') {
        // Se algum campo estiver vazio, evite o envio do formulário
        alert('Por favor, preencha todos os campos obrigatórios.');
        event.preventDefault(); // Evita o envio do formulário
    } else {
        // Se todas as verificações passarem, permita o envio do formulário
        sucessAlert();
    }
}

formElement.addEventListener('submit', validateForm);
