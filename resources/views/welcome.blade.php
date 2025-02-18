<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Restaurant') }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Fine dining restaurant offering exceptional culinary experiences" />
        <meta name="author" content="" />
        <title>La Maison - Fine Dining Experience</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

        <style>
            :root {
                --primary-color: #2C3639;s
                --secondary-color: #A27B5C;s
                --accent-color: #DCD7C9;
                --text-color: #2C3639;
                --light-bg: #F9F5F0;
            }
            
            body {
                font-family: 'Montserrat', sans-serif;
                color: var(--text-color);
                background-color: var(--light-bg);
            }
            
            h1, h2, h3, h4, h5, .navbar-brand {
                font-family: 'Cormorant Garamond', serif;
            }

            .navbar {
                background-color: rgba(249, 245, 240, 0.95) !important;
                padding: 1.5rem 0;
                transition: all 0.3s ease;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            }

            .navbar.scrolled {
                background-color: rgba(249, 245, 240, 0.98) !important;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .navbar-brand {
                font-size: 2rem;
                color: var(--primary-color) !important;
                font-weight: 600;
            }

            .nav-link {
                color: var(--primary-color) !important;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-size: 0.9rem;
            }

            .nav-link:hover {
                color: var(--secondary-color) !important;
            }

            .dropdown-menu {
                background-color: rgba(249, 245, 240, 0.98);
                border: none;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }

            .dropdown-item:hover {
                background-color: var(--accent-color);
            }

            .btn-outline-dark {
                border-color: var(--secondary-color);
                color: var(--secondary-color);
            }

            .btn-outline-dark:hover {
                background-color: var(--secondary-color);
                border-color: var(--secondary-color);
            }

            .product-section {
                background-color: white;
            }

            .display-5 {
                font-weight: 700;
                color: var(--primary-color);
            }

            .lead {
                font-size: 1.1rem;
                line-height: 1.8;
                color: #666;
            }

            .price {
                color: var(--secondary-color);
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.5rem;
            }

            .card {
                border: none;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                transition: all 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .fw-bolder {
                color: var(--primary-color);
            }

            footer {
                background-color: var(--primary-color) !important;
            }

            .carousel {
                background-color: var(--primary-color);
                border-radius: 8px;
                overflow: hidden;
            }

            .carousel-item {
                height: 400px;
            }

            .carousel-item img,
            .carousel-item video {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 10%;
                background: rgba(0,0,0,0.2);
            }

            .carousel-indicators {
                margin-bottom: 0.5rem;
            }

            .thumbnail-btn {
                cursor: pointer;
                height: 80px;
                object-fit: cover;
                transition: all 0.3s ease;
                opacity: 0.7;
            }

            .thumbnail-btn:hover,
            .thumbnail-btn.active {
                opacity: 1;
                border-color: var(--secondary-color);
            }

            .video-thumb {
                background-color: var(--primary-color);
                height: 80px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
            }

            .video-thumb i {
                font-size: 2rem;
            }

            .ratio-16x9 {
                aspect-ratio: 16/9;
            }
        </style>
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
                        <li class="nav-item"><a class="nav-link active" href="/">Inicio</a></li>
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        @endauth
                    </ul>
                    <a href="{{ route('cart') }}" class="d-flex btn btn-outline-dark">
                        <i class="bi-cart-fill me-1"></i>
                        Carrito
                        <span class="badge bg-dark text-white ms-1 rounded-pill" id="cartCount">0</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Nuestro Menú</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Los mejores platos para ti</p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
                    @foreach($dishes as $dish)
                    <div class="col mb-5">
                        <div class="card h-100">
                            @if($dish->is_special)
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Especial</div>
                            @endif
                            
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ Storage::url($dish->image_main) }}" alt="{{ $dish->name }}" />
                            
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $dish->name }}</h5>
                                    <!-- Product price-->
                                    ${{ number_format($dish->price, 2) }}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('dish.show', $dish) }}">Ver Detalles</a>
                                    @if($dish->is_available)
                                        <button class="btn btn-outline-dark mt-auto" 
                                                onclick="addToCart({{ $dish->id }}, '{{ $dish->name }}', {{ $dish->price }})">
                                            Agregar al Carrito
                                        </button>
                                    @else
                                        <button class="btn btn-secondary mt-auto" disabled>No Disponible</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
        
        <!-- Cart JavaScript -->
        <script>
           function addToCart(id, name, price) {
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    let item = cart.find(i => i.id === id);

    if (item) {
        item.quantity += 1;
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            quantity: 1
        });
    }

    // Guardamos el carrito actualizado en el localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

        // Ahora hacemos la solicitud AJAX para actualizar el carrito en el servidor
        $.ajax({
            url: '{{ route('cart.update') }}',  // Asegúrate de que esta ruta sea correcta
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  // Token CSRF necesario para la solicitud POST
                item: { id: id, name: name, price: price, quantity: 1 }  // Enviamos el artículo que se ha añadido
            },
            success: function(response) {
                if (response.success) {
                    console.log('Carrito actualizado en el servidor');
                    updateCartCount(response.cart);  // Actualiza el contador del carrito en la página
                } else {
                    console.error('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    }

    function updateCartCount(cart) {
        // Actualiza el contador del carrito en la interfaz de usuario
        $('#cart-count').text(cart.length);
    }

            function updateCartCount() {
                let cart = JSON.parse(localStorage.getItem('cart') || '[]');
                let count = cart.reduce((total, item) => total + item.quantity, 0);
                document.getElementById('cartCount').textContent = count;
            }

            // Update cart count on page load
            document.addEventListener('DOMContentLoaded', updateCartCount);
        </script>
    </body>
</html>
