@extends('layouts.front')

@section('content')



    <!-- Product section-->
    <section class="py-5 product-section">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <!-- Image Carousel -->
                    <div id="productCarousel" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-indicators">
                            @foreach($dish->additional_images as $index => $image)
                                <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner rounded-3 shadow">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $dish->image_main) }}" class="d-block w-100" alt="{{ $dish->name }}">
                            </div>
                            @foreach($dish->additional_images as $image)
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="{{ $dish->name }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- Thumbnail Navigation -->
                    <div class="d-flex justify-content-center mt-3">
                        <div class="row g-2 w-100">
                            <div class="col-3">
                                <img src="{{ asset('storage/' . $dish->image_main) }}" 
                                    class="img-thumbnail thumbnail-btn active" 
                                    data-bs-target="#productCarousel" 
                                    data-bs-slide-to="0"
                                    alt="Thumbnail 1">
                            </div>
                            @foreach($dish->additional_images as $index => $image)
                                <div class="col-3">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                        class="img-thumbnail thumbnail-btn" 
                                        data-bs-target="#productCarousel" 
                                        data-bs-slide-to="{{ $index + 1 }}"
                                        alt="Thumbnail {{ $index + 2 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">{{ $dish->is_special ? "Chef's Special" : "Menu Item" }}</div>
                    <h1 class="display-5 fw-bolder">{{ $dish->name }}</h1>
                    <div class="fs-5 mb-5">
                        <span class="price">${{ number_format($dish->price, 2) }}</span>
                    </div>
                    <p class="lead">{{ $dish->description }}</p>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" onclick="addToCart({{ $dish->id }}, '{{ $dish->name }}', {{ $dish->price }})">
                            <i class="bi-cart-fill me-1"></i>
                            Agregar al pedido
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related items section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Other Signature Dishes</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($relatedDishes as $relatedDish)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ asset('storage/' . $relatedDish->image_main) }}" alt="{{ $relatedDish->name }}" />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $relatedDish->name }}</h5>
                                    <div class="price">${{ number_format($relatedDish->price, 2) }}</div>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('dish.show', $relatedDish->id) }}">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; La Maison 2023</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        // Add to cart function
        function addToCart(id, name, price) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            let item = cart.find(i => i.id === id);
            let quantity = document.getElementById("inputQuantity").value;
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    quantity: quantity
                });
            

            // Guarda el carrito actualizado en el localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Actualiza el badge del carrito
            updateCartBadge();
        }

        // Actualizar el badge del carrito
        function updateCartBadge() {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            let totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            
            // Actualiza el número del carrito
            document.querySelector('.bi-cart-fill + .badge').textContent = totalItems;
        }

        // Llamada inicial para actualizar el badge cuando la página carga
        updateCartBadge();

        // Add navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });

        // Update thumbnail active state when carousel slides
        document.getElementById('productCarousel').addEventListener('slide.bs.carousel', function (event) {
            document.querySelectorAll('.thumbnail-btn').forEach((thumb, index) => {
                if (index === event.to) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        });

        // Pause video when switching slides
        document.getElementById('productCarousel').addEventListener('slide.bs.carousel', function () {
            const video = this.querySelector('video');
            if (video) {
                video.pause();
            }
        });


    </script>
</body>
</html>


@endsection