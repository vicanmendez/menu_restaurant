@extends('layouts.front')

@section('content')

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

@endsection