
const productSelect = document.getElementById('product');
const quantityInput = document.getElementById('quantity');
const dateField = document.getElementById('date');
const paymentField = document.getElementById('payment');
const observationField = document.getElementById('observation');
const adicionarCarrinhoButton = document.getElementById('adicionarCarrinho');
const finalizarCompraButton = document.getElementById('finalizarCompra');

const cartItems = []; // Array para armazenar produtos e quantidades


// Evento de mudança no campo "product" para limitar a quantidade com base no estoque
productSelect.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    if (selectedOption && selectedOption.dataset.qtdeEstoque) {
        quantityInput.max = selectedOption.dataset.qtdeEstoque;
    } else {
        quantityInput.max = '';
    }
});

// Evento de clique no botão "Adicionar ao Carrinho"
adicionarCarrinhoButton.addEventListener('click', (e) => {
    e.preventDefault();

    // Verifique se todos os campos estão preenchidos
    if (productSelect.value && quantityInput.value) {
        // Desabilite os campos adicionais na primeira vez que "Adicionar ao Carrinho" for clicado
        if (cartItems.length === 0) {
            dateField.disabled = true;
            paymentField.disabled = true;
            observationField.disabled = true;
        }

        // Adicione o item do carrinho ao array
        cartItems.push({
            product: productSelect.value,
            quantity: quantityInput.value
        });

        // Limpe os campos para o próximo item
        productSelect.value = '';
        quantityInput.value = '';
    }
});

// Evento de clique no botão "Finalizar Compra"
finalizarCompraButton.addEventListener('click', (e) => {
    e.preventDefault();

    // Verifique se há itens no carrinho
    if (cartItems.length === 0) {
        alert('Seu carrinho está vazio. Adicione produtos antes de finalizar a compra.');
        return;
    }

    // Crie um objeto com os dados a serem enviados para o PHP
    const data = {
        cartItems: cartItems,
        observation: observationField.value,
        date: dateField.value,
        payment: paymentField.value
    };

    // Realize uma solicitação POST para o arquivo PHP usando fetch
    fetch('../../php/cart/register.php', {
        method: 'POST',
        body: JSON.stringify(data), // Converta o objeto em JSON
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Aqui você pode lidar com a resposta do servidor (se houver)
        // Por exemplo, exibir uma mensagem de sucesso ou redirecionar para outra página
        console.log(data);
    })
    .catch(error => {
        console.error('Erro ao enviar dados para o servidor:', error);
    });

    // Limpe o carrinho após finalizar a compra
    cartItems.length = 0;

    // Habilite os campos adicionais para um novo pedido
    dateField.disabled = false;
    paymentField.disabled = false;
    observationField.disabled = false;
});

