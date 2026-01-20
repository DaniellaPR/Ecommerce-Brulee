@extends('layouts.app')

@section('title', 'Brúlée Catering & Event Design — Home')

@section('cabecera-text')
    <h1 class="Texto-cabecera m-3">Catálogo</h1>
@endsection

@section('content')
    {{-- Mensajes de sesión --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Carrusel (Estructura Legacy) --}}
    <div id="ContenedorCarrusel" class="carousel slide" data-bs-ride="carousel" aria-label="Carrusel de promociones">
        <div class="carousel-inner">
            @php
                $categorias_destacadas = \App\Models\Categoria::with('productos')->limit(3)->get();
            @endphp
            @foreach($categorias_destacadas as $index => $cat)
                @if($cat->productos->first())
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ $cat->productos->first()->imagen_url }}" class="d-block w-100" alt="{{ $cat->nombre }}">
                        <div class="carousel-caption d-none d-md-block">
                            {{-- Caption vacío intencionalmente como en el legacy --}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#ContenedorCarrusel" data-bs-slide="prev"
            aria-label="Anterior">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#ContenedorCarrusel" data-bs-slide="next"
            aria-label="Siguiente">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- Productos Favoritos (Estructura Legacy) --}}
    <div id="ProductosFavoritos" class="row container mx-auto mt-5">
        @php
            // Productos específicos para la grilla "Favoritos" o destacados (Legacy usaba categorías, aquí usamos productos destacados)
            $productos_favoritos = \App\Models\Producto::activos()->limit(4)->get();
        @endphp
        @foreach($productos_favoritos as $producto)
            <div class="col-md-3 mb-4">
                <a href="{{ route('productos.show', $producto->id) }}" class="card h-100 shadow-sm text-decoration-none"
                    aria-label="Ver detalle de {{ $producto->nombre }}">
                    <img src="{{ $producto->imagen_url }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body">
                        <h2 class="card-title">{{ $producto->nombre }}</h2>
                        <p class="card-text">{{ Str::limit($producto->descripcion, 50) }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Catálogo de Productos (Estructura Legacy) --}}
    <div id="Producto-Catalogo" class="container">
        @php
            // Agrupar productos por categoría para simular la vista legacy
            $categorias = \App\Models\Categoria::with([
                'productos' => function ($query) {
                    $query->limit(4); // Mostrar 4 productos por categoría
                }
            ])->get();
        @endphp

        @foreach($categorias as $cat)
            @if($cat->productos->count() > 0)
                <h2 class="Pagina mt-5 mb-3 text-center p-2">{{ $cat->nombre }}</h2>
                <div class="row">
                    @foreach($cat->productos as $prod)
                        <div class="col-12 col-sm-6 col-md-3 mb-4 text-center">
                            <a href="{{ route('productos.show', $prod->id) }}" class="text-decoration-none text-reset">
                                <div class="card shadow-sm h-100">
                                    <img class="Imagen-producto img-fluid card-img-top" style="max-height: 350px;"
                                        src="{{ $prod->imagen_url }}" alt="{{ $prod->nombre }}">
                                    <div class="card-body">
                                        <h2 class="Titulo-producto mt-2 px-0">{{ $prod->nombre }}</h2>
                                        <p>${{ number_format($prod->precio, 2) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        // Inicializar carrusel de Bootstrap
        const myCarouselElement = document.querySelector('#carouselExample');
        if (myCarouselElement) {
            const carousel = new bootstrap.Carousel(myCarouselElement, {
                interval: 3000,
                ride: 'carousel'
            });
        }
    </script>
@endpush