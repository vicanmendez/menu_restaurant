<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Carrito - {{ config('app.name', 'Restaurant') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/front-styles.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/">Restaurante</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cart section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <h2 class="fw-bolder mb-4">Tu Carrito</h2>
            <div class="row">
                <div class="col-lg-8">
                    <!-- Cart items will be loaded here -->
                    <div id="cartItems" class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTableBody">
                                        <!-- Cart items will be inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Order form -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Detalles del Pedido</h5>
                            <form id="orderForm">
                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="order_type" class="form-label">Tipo de Orden</label>
                                    <select class="form-control" id="order_type" name="order_type" required>
                                        <option value="dine-in">Para comer aquí</option>
                                        <option value="takeaway">Para llevar</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="special_instructions" class="form-label">Instrucciones Especiales</label>
                                    <textarea class="form-control" id="special_instructions" name="special_instructions" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <h5>Total: $<span id="orderTotal">0.00</span></h5>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" id="submitOrder">
                                    Realizar Pedido
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Tu Restaurante 2024</p></div>
    </footer>

    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- a JavaScript -->
    <script>
        function loadCart() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const tbody = document.getElementById('cartTableBody');
            let total = 0;
            
            tbody.innerHTML = '';
            
            if (cart.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center">El carrito está vacío</td></tr>';
                document.getElementById('submitOrder').disabled = true;
                return;
            }

            cart.forEach(item => {
                const subtotal = item.price * item.quantity;
                total += subtotal;
                
                tbody.innerHTML += `
                    <tr>
                        <td>${item.name}</td>
                        <td>$${item.price.toFixed(2)}</td>
                        <td>
                            <input type="number" min="1" value="${item.quantity}" 
                                   onchange="updateQuantity(${item.id}, this.value)">
                        </td>
                        <td>$${subtotal.toFixed(2)}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="removeItem(${item.id})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById('orderTotal').textContent = total.toFixed(2);
        }

        function updateQuantity(id, quantity) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const item = cart.find(i => i.id === id);
            
            if (item) {
                item.quantity = parseInt(quantity);
                if (item.quantity < 1) {
                    cart = cart.filter(i => i.id !== id);
                }
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        }

        function removeItem(id) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            cart = cart.filter(i => i.id !== id);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        }

        document.getElementById('orderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                alert('El carrito está vacío');
                return;
            }

            const formData = {
                customer_name: document.getElementById('customer_name').value,
                order_type: document.getElementById('order_type').value,
                special_instructions: document.getElementById('special_instructions').value,
                items: cart
            };

            fetch('{{ route("order.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('¡Pedido realizado con éxito!');
                    localStorage.removeItem('cart');
                    window.location.href = '/';
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al procesar tu pedido');
            });
        });

        // Load cart on page load
        document.addEventListener('DOMContentLoaded', loadCart);
    </script>
</body>
</html>
