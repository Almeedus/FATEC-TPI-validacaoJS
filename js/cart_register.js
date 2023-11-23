let cart = [];

const productSelect = document.getElementById('product');
const quantityInput = document.getElementById('quantity');
const dateField = document.getElementById('date');
const paymentField = document.getElementById('payment');
const observationField = document.getElementById('observation');
const cartForm = document.getElementById('cart_register');

const addCartButton = document.getElementById('addCartButton')
const finishPurchaseButton = document.getElementById('finishPurchaseButton')

addCartButton.addEventListener('click', addCart)
finishPurchaseButton.addEventListener('click', finishPurchase)

function addCart() {
    const product = productSelect.value;
    const quantity = quantityInput.value;
    const dateValue = dateField.value;

    // Verificar campos vazios
    if (!product) {
        alert('Selecione um produto.');
        return;
    }

    if (!quantity) {
        alert('Informe a quantidade.');
        return;
    }

    // Verificar se a quantidade é maior que 0
    if (parseInt(quantity) <= 0) {
        alert('A quantidade deve ser maior que 0.');
        return;
    }

    if (!dateValue) {
        alert('Informe a data.');
        return;
    }

    // Validar a data
    const currentDate = new Date();
    const selectedDate = new Date(dateValue);
    
    // Converter as datas para strings no formato ISO (sem considerar o horário)
    const currentDateISO = currentDate.toISOString().split('T')[0];
    const selectedDateISO = selectedDate.toISOString().split('T')[0];
    
    if (selectedDateISO < currentDateISO) {
        alert('A data deve ser igual ou maior que o dia atual.');
        return;
    }
 
    // Resto do código para adicionar o produto ao carrinho
    cart.push({ product, quantity });
    // Limpar campos
    productSelect.value = '';
    quantityInput.value = '';

    // Atualizar a quantidade máxima com base no estoque
    if (productSelect.options[productSelect.selectedIndex].dataset.qtdeEstoque) {
        quantityInput.max = productSelect.options[productSelect.selectedIndex].dataset.qtdeEstoque;
    } else {
        quantityInput.max = '';
    }

    // Desabilitar campos adicionais na primeira vez que "Adicionar ao Carrinho" for clicado
    if (cart.length === 1) {
        dateField.readOnly = true;
        paymentField.readOnly = true;
        observationField.readOnly = true;
    }

    // Mostrar o botão "Finalizar Compra" após o primeiro item ser adicionado
    if (cart.length === 1) {
        const finalizarCompraButton = document.getElementById('finishPurchaseButton');
        finalizarCompraButton.removeAttribute('hidden');
    }
}

function finishPurchase() {
    const cartItemsInput = document.createElement('input');
    cartItemsInput.type = 'hidden';
    cartItemsInput.name = 'cartItems';
    cartItemsInput.value = JSON.stringify(cart);
    cartForm.appendChild(cartItemsInput);
    cartForm.submit();
}

window.onload = function () {
    // Limpar os valores dos campos de entrada ao carregar a página
    productSelect.value = '';
    quantityInput.value = '';
    dateField.value = '';
    paymentField.value = '';
    observationField.value = '';
};

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('success_message');
    const errorMessage = urlParams.get('error_message');

    if (successMessage) {
        alert(successMessage);
    } else if (errorMessage) {
        alert(errorMessage);
    }

    // Remova a mensagem da URL para que ela não seja exibida novamente após a atualização da página
    removeMessageFromUrl();
};

function removeMessageFromUrl() {
    if (window.history.replaceState) {
        // Use a API de histórico para remover a mensagem da URL sem recarregar a página
        const url = window.location.href;
        const cleanUrl = url.split('?')[0];
        window.history.replaceState({}, document.title, cleanUrl);
    }
}
