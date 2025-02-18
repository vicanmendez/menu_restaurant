let cart = JSON.parse(localStorage.getItem('cart')) || [];

function updateCartCount() {
    const cartCount = document.querySelector('.badge');
    cartCount.textContent = cart.reduce((total, item) => total + item.quantity, 0);
}

function showSuccessModal(message) {
    const modalElement = document.getElementById('successModal');
    const messageElement = document.getElementById('successModalMessage');
    messageElement.textContent = message;
    
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
}

function addToCart() {
    const quantity = parseInt(document.getElementById('inputQuantity').value);
    const item = {
        id: window.location.pathname,
        name: document.querySelector('.display-5').textContent,
        price: parseFloat(document.querySelector('.price').textContent.replace('$', '')),
        quantity: quantity,
        image: document.querySelector('.carousel-item.active img').src
    };

    const existingItem = cart.find(i => i.id === item.id);
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push(item);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    showSuccessModal('Item added to cart!');
}

function updateCartDisplay() {
    const cartItems = document.getElementById('cartItems');
    if (!cartItems) return; // Not on cart page

    if (cart.length === 0) {
        cartItems.innerHTML = '<p class="text-center">Your cart is empty</p>';
        updateTotals(0);
        return;
    }

    cartItems.innerHTML = cart.map((item, index) => `
        <div class="cart-item d-flex align-items-center">
            <img src="${item.image}" alt="${item.name}" class="me-4">
            <div class="flex-grow-1">
                <h5 class="fw-bolder">${item.name}</h5>
                <div class="price mb-2">$${item.price.toFixed(2)}</div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-dark me-2" onclick="updateQuantity(${index}, -1)">-</button>
                    <input type="number" class="form-control text-center" style="max-width: 60px;" value="${item.quantity}" 
                           onchange="updateQuantity(${index}, this.value - ${item.quantity})">
                    <button class="btn btn-sm btn-outline-dark ms-2" onclick="updateQuantity(${index}, 1)">+</button>
                    <button class="btn btn-sm btn-outline-danger ms-4" onclick="removeItem(${index})">Remove</button>
                </div>
            </div>
        </div>
    `).join('');

    const subtotal = cart.reduce((total, item) => total + item.price * item.quantity, 0);
    updateTotals(subtotal);
}

function updateTotals(subtotal) {
    const tax = subtotal * 0.08; // 8% tax
    const total = subtotal + tax;

    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
}

function updateQuantity(index, change) {
    const newQuantity = cart[index].quantity + (typeof change === 'number' ? change : parseInt(change));
    
    if (newQuantity < 1) {
        removeItem(index);
        return;
    }
    
    cart[index].quantity = newQuantity;
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
    updateCartCount();
}

function removeItem(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
    updateCartCount();
}

function placeOrder() {
    const customerName = document.getElementById('customerName').value;
    const orderType = document.getElementById('orderType').value;
    
    if (!customerName || !orderType) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Here you would typically send the order to a server
    cart = [];
    localStorage.removeItem('cart');
    updateCartDisplay();
    updateCartCount();
    showSuccessModal('Order placed successfully!');
}

// Initialize cart display
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    updateCartDisplay();
}); 