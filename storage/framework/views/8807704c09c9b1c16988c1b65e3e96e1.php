<?php $__env->startSection('title', 'Brúlée — ' . $producto->pro_nombre); ?>

<?php $__env->startSection('cabecera-text'); ?>
    <h1 class="Texto-cabecera m-3">Detalle producto</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="contenedor my-4">
        <div class="Productos">
            <img id="Imagen-detalle" src="<?php echo e($producto->pro_imagen); ?>"
                alt="<?php echo e($producto->pro_alt_imagen ?? $producto->pro_nombre); ?>">
            <div>
                <h2> Descripción </h2>
                <p id="Texto-detalle-producto"><?php echo e($producto->pro_descripcion); ?></p>
                <p><strong>Categoría:</strong> <?php echo e($producto->categoria->cat_descripcion); ?></p>
                <?php if($producto->pro_existencia > 0): ?>
                    <p><strong>Stock disponible:</strong> <?php echo e($producto->pro_existencia); ?> unidades</p>
                <?php else: ?>
                    <div class="alert alert-warning">Producto agotado</div>
                <?php endif; ?>
            </div>
        </div>

        <h2 class="Titulo-producto" id="titulo-producto"><?php echo e($producto->pro_nombre); ?></h2>
        <h2 class="Titulo-producto" id="Precio-producto">$<?php echo e(number_format($producto->pro_precio_venta, 2)); ?></h2>

        <div class="text-end m-3">
            <?php if($producto->pro_existencia > 0): ?>
                <button class="btn btn-primary btn-lg" id="btn-comprar" data-bs-toggle="modal" data-bs-target="#modalCompra">
                    Comprar
                </button>
            <?php endif; ?>
            <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-outline-secondary btn-lg ms-2">
                Volver
            </a>
        </div>

        <!-- Modal de Compra (Carrito) -->
        <div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCompraLabel">Eliga su producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formComprar">
                            <div class="mb-3">
                                <label for="selectProducto" class="form-label">Producto</label>
                                <select id="selectProducto" class="form-select" required>
                                    <option value="<?php echo e($producto->pro_codigo); ?>" selected><?php echo e($producto->pro_nombre); ?></option>
                                    <?php $__currentLoopData = $productosSimilares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($rel->pro_codigo); ?>"><?php echo e($rel->pro_nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3 d-flex align-items-center justify-content-center gap-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <button type="button" class="btn btn-outline-secondary" id="btn-restar">−</button>
                                    <input type="number" id="cantidad" class="form-control text-center" style="width: 80px;"
                                        value="1" min="1" max="<?php echo e($producto->pro_existencia); ?>">
                                    <button type="button" class="btn btn-outline-secondary" id="btn-sumar">+</button>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btn-confirmar">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <?php if($productosSimilares->count() > 0): ?>
            <div class="mt-5 container">
                <h3 class="mb-4 text-center">También te podría gustar</h3>
                <div class="row g-4 justify-content-center">
                    <?php $__currentLoopData = $productosSimilares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="<?php echo e(route('productos.show', $similar->pro_codigo)); ?>" class="text-decoration-none text-reset">
                                <div class="card shadow-sm h-100">
                                    <img src="<?php echo e($similar->pro_imagen); ?>" class="card-img-top"
                                        alt="<?php echo e($similar->pro_alt_imagen ?? $similar->pro_nombre); ?>"
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo e($similar->pro_nombre); ?></h5>
                                        <p class="fw-bold text-primary">$<?php echo e(number_format($similar->pro_precio_venta, 2)); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {
            // Sumar/Restar cantidad
            $('#btn-sumar').click(function () {
                let val = parseInt($('#cantidad').val()) || 1;
                let max = parseInt($('#cantidad').attr('max')) || 100; // Obtener max del atributo
                if (val < max) $('#cantidad').val(val + 1);
            });
            $('#btn-restar').click(function () {
                let val = parseInt($('#cantidad').val()) || 1;
                if (val > 1) $('#cantidad').val(val - 1);
            });

            // Agregar al carrito
            $('#btn-confirmar').click(function () {
                const prdId = $('#selectProducto').val();
                const cantidad = parseInt($('#cantidad').val());
                const nombre = $("#selectProducto option:selected").text().trim();
                // Nota: el precio aquí es del producto principal. Si cambia el select, el precio debería actualizarse.
                // Por simplicidad, asumimos que el usuario selecciona el producto actual o uno similar.
                // Lo ideal sería obtener el precio dinámicamente o recargar la página al cambiar el select.
                const precio = <?php echo e($producto->pro_precio_venta); ?>;

                // Usar la lógica de carrito global si existe, o localstorage
                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                const itemExistente = carrito.find(i => i.PRD_Codigo == prdId);

                if (itemExistente) {
                    itemExistente.cantidad += cantidad;
                } else {
                    carrito.push({ PRD_Codigo: prdId, cantidad: cantidad });
                }
                localStorage.setItem('carrito', JSON.stringify(carrito));

                alert(cantidad + ' unidad(es) de "' + nombre + '" agregada(s) al carrito.');
                // Cerrar el modal correctamente
                const modalEl = document.getElementById('modalCompra');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                // Actualizar badge
                if (typeof actualizarBadgeCarrito === 'function') {
                    actualizarBadgeCarrito();
                } else {
                    location.reload();
                }
            });

            // Al cambiar el select, redirigir a la página del producto seleccionado para ver su precio/info correcta
            $('#selectProducto').change(function () {
                const newId = $(this).val();
                if (newId != '<?php echo e($producto->pro_codigo); ?>') {
                    window.location.href = '/productos/' + newId;
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\israe\Desktop\aver4\Ecommerce-Brulee\resources\views/productos/show.blade.php ENDPATH**/ ?>