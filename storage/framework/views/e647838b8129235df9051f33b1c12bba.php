<?php $__env->startSection('title', 'Brúlée — Catálogo de Productos'); ?>

<?php $__env->startSection('cabecera-text'); ?>
    <h1 class="Texto-cabecera m-3">Catálogo de Productos</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <h2 class="Pagina mt-5 mb-3 text-center p-2"><?php echo e($categoria->cat_descripcion); ?></h2>
            

            
            <div class="row g-4 mb-5">
                <?php $__currentLoopData = $categoria->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="<?php echo e(route('productos.show', $producto->pro_codigo)); ?>" class="text-decoration-none text-reset">
                            <div class="card shadow-sm h-100">
                                <img src="<?php echo e($producto->pro_imagen); ?>" class="card-img-top"
                                    alt="<?php echo e($producto->pro_alt_imagen ?? $producto->pro_nombre); ?>"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($producto->pro_nombre); ?></h5>
                                    <p class="card-text small"><?php echo e(Str::limit($producto->pro_descripcion, 60)); ?></p>
                                    <p class="fw-bold text-primary">$<?php echo e(number_format($producto->pro_precio_venta, 2)); ?></p>
                                    <?php if($producto->pro_existencia > 0): ?>
                                        <span class="badge bg-success">Stock: <?php echo e($producto->pro_existencia); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Agotado</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\israe\Desktop\aver4\Ecommerce-Brulee\resources\views/productos/index.blade.php ENDPATH**/ ?>