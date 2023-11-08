let cart = [];

const productSelect = document.getElementById('product');
const quantityInput = document.getElementById('quantity');
const dateField = document.getElementById('date');
const paymentField = document.getElementById('payment');
const observationField = document.getElementById('observation');
const cartForm = document.getElementById('cart_register');

const addCartButton = document.getElementById('addCartButton')
const finishPurchaseButton = document.getElementById('finishPurchaseButton')

console.log(cart)

addCartButton.addEventListener('click', addCart)
finishPurchaseButton.addEventListener('click', finishPurchase)

function addCart() {

    const product = productSelect.value;
    const quantity = quantityInput.value;

    if (product && quantity) {
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
            finalizarCompraButton.removeAttribute('hidden')
        }
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