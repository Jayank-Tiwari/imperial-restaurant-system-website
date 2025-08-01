

<?php $__env->startSection('title', __('messages.orders') . ' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'order'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-3 px-md-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap pt-3 pb-3 border-bottom">
            <h1 class="h2 mb-2"><?php echo app('translator')->get('messages.order_management'); ?></h1>
        </div>

        <!-- Filter Buttons -->
        <form method="GET" class="mb-4">
            <div class="row gy-2 gx-3 align-items-center">
                <!-- Order Status Filter -->
                <div class="col-auto">
                    <label class="form-label mb-0 fw-bold"><?php echo app('translator')->get('messages.order_status'); ?>:</label>
                </div>
                <div class="col-auto">
                    <div class="btn-group" role="group">
                        <a href="<?php echo e(route('admin.order.index')); ?>"
                            class="btn btn-outline-primary <?php echo e(request('status') == 'all' || !request('status') ? 'active' : ''); ?>">
                            <?php echo app('translator')->get('messages.all'); ?>
                        </a>
                        <?php $__currentLoopData = ['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('admin.order.index', array_merge(request()->except('page'), ['status' => $status]))); ?>"
                                class="btn btn-outline-secondary <?php echo e(request('status') == $status ? 'active' : ''); ?>">
                                <?php echo app('translator')->get('messages.order_status_' . $status); ?>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Payment Status Filter -->
                <div class="col-auto">
                    <label class="form-label mb-0 fw-bold"><?php echo app('translator')->get('messages.payment'); ?>:</label>
                </div>
                <div class="col-auto">
                    <select name="payment" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value=""><?php echo app('translator')->get('messages.all'); ?></option>
                        <?php $__currentLoopData = ['pending', 'paid', 'failed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pay); ?>" <?php echo e(request('payment') == $pay ? 'selected' : ''); ?>>
                                <?php echo app('translator')->get('messages.payment_status_' . $pay); ?>
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Payment Method Filter -->
                <div class="col-auto">
                    <label class="form-label mb-0 fw-bold"><?php echo app('translator')->get('messages.payment_method'); ?>:</label>
                </div>
                <div class="col-auto">
                    <select name="payment_method" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value=""><?php echo app('translator')->get('messages.all'); ?></option>
                        <?php $__currentLoopData = ['card', 'cash']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($method); ?>" <?php echo e(request('payment_method') == $method ? 'selected' : ''); ?>>
                                <?php echo app('translator')->get('messages.payment_method_' . $method); ?>
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </form>

        <!-- Flash Messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php elseif(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <!-- Orders Table -->
        <div class="card shadow-sm">
            <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><?php echo app('translator')->get('messages.all_orders'); ?></h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><?php echo app('translator')->get('messages.order_number'); ?></th>
                                <th><?php echo app('translator')->get('messages.customer'); ?></th>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th class="text-start"><?php echo app('translator')->get('messages.items'); ?></th>
                                <th><?php echo app('translator')->get('messages.total'); ?></th>
                                <th><?php echo app('translator')->get('messages.type'); ?></th>
                                <th><?php echo app('translator')->get('messages.order_status'); ?></th>
                                <th><?php echo app('translator')->get('messages.payment'); ?></th>
                                <th><?php echo app('translator')->get('messages.payment_method'); ?></th>
                                <th><?php echo app('translator')->get('messages.actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><strong>#<?php echo e($order->id); ?></strong></td>
                                    <td><?php echo e($order->user->name); ?></td>
                                    <td><?php echo e($order->created_at->format('d M Y - h:i A')); ?></td>
                                    <td class="text-start">
                                        <ul class="list-unstyled mb-0 small">
                                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($item->menuItem->name); ?> <small>(x<?php echo e($item->quantity); ?>)</small>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </td>
                                    <td><strong>€<?php echo e(number_format($order->total_amount, 2)); ?></strong></td>
                                    <td>
                                        <span
                                            class="badge 
                                        <?php if($order->delivery_type == 'delivery'): ?> bg-warning text-dark
                                        <?php elseif($order->delivery_type == 'dinein'): ?> bg-success
                                        <?php else: ?> bg-info <?php endif; ?>">
                                            <?php echo app('translator')->get('messages.delivery_type_' . $order->delivery_type); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="<?php echo e(route('admin.order.updateStatus', $order->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <select class="form-select form-select-sm" name="order_status"
                                                onchange="this.form.submit()"
                                                <?php echo e($order->order_status == 'delivered' ? 'disabled' : ''); ?>>
                                                <?php $__currentLoopData = ['pending', 'confirmed', 'preparing', 'out_for_delivery', 'cancelled', 'delivered']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($status); ?>"
                                                        <?php echo e($order->order_status == $status ? 'selected' : ''); ?>>
                                                        <?php echo app('translator')->get('messages.order_status_' . $status); ?>
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </form>
                                    </td>

                                    <td>
                                        <form method="POST" action="<?php echo e(route('admin.order.updatePayment', $order->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <select class="form-select form-select-sm" name="payment_status"
                                                onchange="this.form.submit()">
                                                <?php $__currentLoopData = ['pending', 'paid', 'failed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($payStatus); ?>"
                                                        <?php echo e($order->payment_status == $payStatus ? 'selected' : ''); ?>>
                                                        <?php echo app('translator')->get('messages.payment_status_' . $payStatus); ?>
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </form>
                                    </td>

                                    <td>
                                        <span class="badge 
                                            <?php if($order->payment_method == 'card'): ?> bg-primary
                                            <?php elseif($order->payment_method == 'cash'): ?> bg-warning text-dark
                                            <?php else: ?> bg-secondary <?php endif; ?>">
                                            <i class="fas 
                                                <?php if($order->payment_method == 'card'): ?> fa-credit-card
                                                <?php elseif($order->payment_method == 'cash'): ?> fa-money-bill-wave
                                                <?php else: ?> fa-question <?php endif; ?> me-1"></i>
                                            <?php echo app('translator')->get('messages.payment_method_' . ($order->payment_method ?? 'unknown')); ?>
                                        </span>
                                    </td>

                                    <td>
                                        <a href="<?php echo e(route('admin.order.show', $order->id)); ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <?php echo app('translator')->get('messages.view'); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted"><?php echo app('translator')->get('messages.no_orders_found_for_status'); ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-3">
                    <?php echo e($orders->withQueryString()->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/order/index.blade.php ENDPATH**/ ?>