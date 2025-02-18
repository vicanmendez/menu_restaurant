<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

        <style>
            :root {
                --primary-color: #2C3639;
                --secondary-color: #A27B5C;
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
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/">
                <span class="h3 mb-0">Restaurante Gourmet</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#menu">Menú</a></li>
                </ul>
                <a href="{{ route('cart') }}" class="btn btn-outline-dark d-flex align-items-center">
                    <i class="bi-cart-fill me-1"></i>
                    Carrito
                    <span class="badge bg-dark text-white ms-1 rounded-pill" id="cartCount">0</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Product section-->
    <section class="py-5 mt-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0 dish-image" 
                         src="{{ Storage::url($dish->image_main) }}" 
                         alt="{{ $dish->name }}" />
                    
                    @if($dish->additional_images)
                        <div class="row mt-4">
                            @foreach(json_decode($dish->additional_images) as $image)
                                <div class="col-4 mb-3">
                                    <img src="{{ Storage::url($image) }}" 
                                         alt="Imagen adicional de {{ $dish->name }}" 
                                         class="img-fluid additional-image rounded"
                                         onclick="updateMainImage('{{ Storage::url($image) }}')" />
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">
                        @if($dish->is_special)
                            <span class="badge bg-danger">Especial del Chef</span>
                        @endif
                        @if($dish->is_available)
                            <span class="badge bg-success">Disponible</span>
                        @else
                            <span class="badge bg-secondary">No Disponible</span>
                        @endif
                    </div>
                    <h1 class="display-5 fw-bolder mb-4">{{ $dish->name }}</h1>
                    <div class="fs-5 mb-4">
                        <span class="h2">${{ number_format($dish->price, 2) }}</span>
                    </div>
                    <p class="lead mb-4">{{ $dish->description }}</p>
                    
                    @if($dish->is_available)
                        <div class="d-flex gap-3">
                            <button class="btn btn-outline-dark flex-shrink-0" 
                                    onclick="addToCart({{ $dish->id }}, '{{ $dish->name }}', {{ $dish->price }})">
                                <i class="bi-cart-plus me-1"></i>
                                Agregar al Carrito
                            </button>
                            <a href="{{ route('cart') }}" class="btn btn-dark flex-shrink-0">
                                <i class="bi-cart-fill me-1"></i>
                                Ver Carrito
                            </a>
                        </div>
                    @else
                        <button class="btn btn-secondary flex-shrink-0" disabled>
                            <i class="bi-x-circle me-1"></i>
                            No Disponible
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-3">Sobre Nosotros</h5>
                    <p class="text-white-50">Ofrecemos la mejor experiencia culinaria con ingredientes frescos y sabores únicos.</p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-3">Horarios</h5>
                    <p class="text-white-50">
                        Lunes a Viernes: 11:00 - 22:00<br>
                        Sábados y Domingos: 11:00 - 23:00
                    </p>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-3">Contacto</h5>
                    <p class="text-white-50">
                        <i class="bi bi-geo-alt me-2"></i>Dirección del Restaurante<br>
                        <i class="bi bi-telephone me-2"></i>+1234567890<br>
                        <i class="bi bi-envelope me-2"></i>info@restaurante.com
                    </p>
                </div>
            </div>
            <hr class="text-white-50 my-4">
            <p class="m-0 text-center text-white">Copyright &copy; Restaurante Gourmet 2024</p>
        </div>
    </footer>

    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
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
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            
            // Mostrar mensaje de éxito
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 p-3';
            toast.style.zIndex = '11';
            toast.innerHTML = `
                <div class="toast show" role="alert">
                    <div class="toast-header">
                        <strong class="me-auto">¡Éxito!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        Producto agregado al carrito
                    </div>
                </div>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            let count = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
        }

        function updateMainImage(imageUrl) {
            document.querySelector('.dish-image').src = imageUrl;
        }

        // Update cart count on page load
        document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>
</body>
</html>
