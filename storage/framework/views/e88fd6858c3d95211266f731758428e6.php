

<?php $__env->startSection('title', 'Cart - Imperial Spice'); ?>
<?php $__env->startSection('active', 'cart'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Cart Header -->
    <section class="py-5 mt-5 bg-light">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 fw-bold"><?php echo app('translator')->get('messages.shopping_cart'); ?></h1>
                <p class="lead"><?php echo app('translator')->get('messages.review_items'); ?></p>
            </div>
        </div>
    </section>

    <!-- Cart Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-shopping-cart me-2"></i><?php echo app('translator')->get('messages.cart_items'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if($cartItems->isEmpty()): ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <h5><?php echo app('translator')->get('messages.cart_empty'); ?></h5>
                                    <p class="text-muted"><?php echo app('translator')->get('messages.cart_empty_message'); ?></p>
                                    <a href="<?php echo e(route('menu')); ?>" class="btn btn-primary"><?php echo app('translator')->get('messages.browse_menu'); ?></a>
                                </div>
                            <?php else: ?>
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row align-items-center border-bottom py-3">
                                        <div class="col-md-2">
                                            <img src="<?php echo e(asset('storage/' . $item->menuItem->image)); ?>"
                                                class="img-fluid rounded" alt="<?php echo e($item->menuItem->name); ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1"><?php echo e($item->menuItem->name); ?></h6>
                                            <p class="text-muted mb-0">€<?php echo e(number_format($item->menuItem->price, 2)); ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <form method="POST" action="<?php echo e(route('cart.update', $item->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="input-group input-group-sm">
                                                    <button class="btn btn-outline-secondary" name="action"
                                                        value="decrease" type="submit">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="text" class="form-control text-center"
                                                        value="<?php echo e($item->quantity); ?>" readonly>
                                                    <button class="btn btn-outline-secondary" name="action"
                                                        value="increase" type="submit">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <span
                                                class="fw-bold">€<?php echo e(number_format($item->menuItem->price * $item->quantity, 2)); ?></span>
                                        </div>
                                        <div class="col-md-1">
                                            <form method="POST" action="<?php echo e(route('cart.remove', $item->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-receipt me-2"></i><?php echo app('translator')->get('messages.order_summary'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php
                                $subtotal = $cartItems->sum(fn($item) => $item->menuItem->price * $item->quantity);
                                $taxRate = 0.1; // 10% IVA
                                $tax = $subtotal * $taxRate;
                                $total = $subtotal + $tax;
                            ?>

                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo app('translator')->get('messages.subtotal'); ?>:</span>
                                <span>€<?php echo e(number_format($subtotal, 2)); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo app('translator')->get('messages.tax'); ?>:</span>
                                <span>€<?php echo e(number_format($tax, 2)); ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold h5">
                                <span><?php echo app('translator')->get('messages.total'); ?>:</span>
                                <span>€<?php echo e(number_format($total, 2)); ?></span>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <?php if(!$cartItems->isEmpty()): ?>
                                    <a href="<?php echo e(route('checkout')); ?>" class="btn btn-primary btn-lg">
                                        <i class="fas fa-credit-card me-2"></i><?php echo app('translator')->get('messages.proceed_to_checkout'); ?>
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-primary btn-lg" disabled>
                                        <i class="fas fa-credit-card me-2"></i><?php echo app('translator')->get('messages.proceed_to_checkout'); ?>
                                    </button>
                                <?php endif; ?>
                                <a href="<?php echo e(route('menu')); ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i><?php echo app('translator')->get('messages.browse_menu'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/cart/index.blade.php ENDPATH**/ ?>