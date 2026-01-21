@extends('layouts.app')

@section('title', 'Brúlée — Catálogo de Productos')

@section('cabecera-text')
    <h1 class="Texto-cabecera m-3">Catálogo de Productos</h1>
@endsection

@section('content')
    <div class="container my-4">
        @foreach($categorias as $categoria)
            {{-- Título de categoría --}}
            <h2 class="Pagina mt-5 mb-3 text-center p-2">{{ $categoria->cat_descripcion }}</h2>
            {{-- <p class="text-center text-muted small mb-4">{{ $categoria->descripcion }}</p> --}}

            {{-- Grid de productos --}}
            <div class="row g-4 mb-5">
                @foreach($categoria->productos as $producto)
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="{{ route('productos.show', $producto->pro_codigo) }}" class="text-decoration-none text-reset">
                            <div class="card shadow-sm h-100">
                                <img src="{{ $producto->pro_imagen }}" class="card-img-top"
                                    alt="{{ $producto->pro_alt_imagen ?? $producto->pro_nombre }}"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->pro_nombre }}</h5>
                                    <p class="card-text small">{{ Str::limit($producto->pro_descripcion, 60) }}</p>
                                    <p class="fw-bold text-primary">${{ number_format($producto->pro_precio_venta, 2) }}</p>
                                    @if($producto->pro_existencia > 0)
                                        <span class="badge bg-success">Stock: {{ $producto->pro_existencia }}</span>
                                    @else
                                        <span class="badge bg-danger">Agotado</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection