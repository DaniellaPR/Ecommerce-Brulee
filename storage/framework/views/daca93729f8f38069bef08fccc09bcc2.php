<?php $__env->startSection('title', 'Brúlée Catering & Event Design — Home'); ?>

<?php $__env->startSection('cabecera-text'); ?>
    <h1 class="Texto-cabecera m-3">Catálogo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <div id="ContenedorCarrusel" class="carousel slide" data-bs-ride="carousel" aria-label="Carrusel de promociones">
        <div class="carousel-inner">
            <?php
                $categorias_destacadas = \App\Models\Categoria::with('productos')->limit(3)->get();
            ?>
            <?php $__currentLoopData = $categorias_destacadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($cat->productos->first()): ?>
                    <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                        <img src="<?php echo e($cat->productos->first()->imagen_url); ?>" class="d-block w-100" alt="<?php echo e($cat->nombre); ?>">
                        <div class="carousel-caption d-none d-md-block">
                            
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    
    <div id="ProductosFavoritos" class="row container mx-auto mt-5">
        <?php
            // Productos específicos para la grilla "Favoritos" o destacados (Legacy usaba categorías, aquí usamos productos destacados)
            $productos_favoritos = \App\Models\Producto::activos()->limit(4)->get();
        ?>
        <?php $__currentLoopData = $productos_favoritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mb-4">
                <a href="<?php echo e(route('productos.show', $producto->id)); ?>" class="card h-100 shadow-sm text-decoration-none"
                    aria-label="Ver detalle de <?php echo e($producto->nombre); ?>">
                    <img src="<?php echo e($producto->imagen_url); ?>" class="card-img-top" alt="<?php echo e($producto->nombre); ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo e($producto->nombre); ?></h2>
                        <p class="card-text"><?php echo e(Str::limit($producto->descripcion, 50)); ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div id="Producto-Catalogo" class="container">
        <?php
            // Agrupar productos por categoría para simular la vista legacy
            $categorias = \App\Models\Categoria::with([
                'productos' => function ($query) {
                    $query->limit(4); // Mostrar 4 productos por categoría
                }
            ])->get();
        ?>

        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($cat->productos->count() > 0): ?>
                <h2 class="Pagina mt-5 mb-3 text-center p-2"><?php echo e($cat->nombre); ?></h2>
                <div class="row">
                    <?php $__currentLoopData = $cat->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-6 col-md-3 mb-4 text-center">
                            <a href="<?php echo e(route('productos.show', $prod->id)); ?>" class="text-decoration-none text-reset">
                                <div class="card shadow-sm h-100">
                                    <img class="Imagen-producto img-fluid card-img-top" style="max-height: 350px;"
                                        src="<?php echo e($prod->imagen_url); ?>" alt="<?php echo e($prod->nombre); ?>">
                                    <div class="card-body">
                                        <h2 class="Titulo-producto mt-2 px-0"><?php echo e($prod->nombre); ?></h2>
                                        <p>$<?php echo e(number_format($prod->precio, 2)); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pdani\Downloads\Desarrollo\app2\appWebBrulee\resources\views/index.blade.php ENDPATH**/ ?>