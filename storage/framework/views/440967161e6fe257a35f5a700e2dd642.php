

<?php $__env->startSection('title', __('messages.order_number') . ' #'.$order->id.' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'order'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?php echo app('translator')->get('messages.order_number'); ?> #<?php echo e($order->id); ?></h2>
        <a href="<?php echo e(route('admin.order.index')); ?>" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> <?php echo app('translator')->get('messages.back_to_orders'); ?>
        </a>
    </div>

    <!-- Order Summary -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    <?php echo app('translator')->get('messages.customer_info'); ?>
                </div>
                <div class="card-body">
                    <p><strong><?php echo app('translator')->get('messages.name'); ?>:</strong> <?php echo e($order->user->name); ?></p>
                    <p><strong><?php echo app('translator')->get('messages.email_address'); ?>:</strong> <?php echo e($order->user->email); ?></p>
                    <p><strong><?php echo app('translator')->get('messages.phone_number'); ?>:</strong> <?php echo e($order->user->phone ?? __('messages.not_available')); ?></p>
                    <p><strong><?php echo app('translator')->get('messages.order_placed_at'); ?>:</strong> <?php echo e($order->created_at->format('d M Y - h:i A')); ?></p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <?php echo app('translator')->get('messages.order_details'); ?>
                </div>
                <div class="card-body">
                    <p><strong><?php echo app('translator')->get('messages.type'); ?>:</strong> 
                        <span class="badge bg-<?php echo e($order->delivery_type == 'dinein' ? 'success' : ($order->delivery_type == 'delivery' ? 'warning text-dark' : 'info')); ?>">
                            <?php echo app('translator')->get('messages.delivery_type_' . $order->delivery_type); ?>
                        </span>
                    </p>
                    <?php if($order->delivery_type == 'dinein'): ?>
                        <p><strong><?php echo app('translator')->get('messages.table_no'); ?>:</strong> <?php echo e($order->table_no); ?></p>
                    <?php elseif($order->delivery_type == 'delivery'): ?>
                        <p><strong><?php echo app('translator')->get('messages.delivery_address'); ?>:</strong> <?php echo e($order->delivery_address); ?></p>
                        <?php if($order->postal_code): ?>
                            <p><strong><?php echo app('translator')->get('messages.postal_code'); ?>:</strong> <?php echo e($order->postal_code); ?></p>
                        <?php endif; ?>
                        <?php if($order->delivery_charge && $order->delivery_charge > 0): ?>
                            <p><strong><?php echo app('translator')->get('messages.delivery_charge'); ?>:</strong> €<?php echo e(number_format($order->delivery_charge, 2)); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <p><strong><?php echo app('translator')->get('messages.order_status'); ?>:</strong> 
                        <span class="badge bg-<?php echo e($order->order_status == 'delivered' ? 'success' : ($order->order_status == 'cancelled' ? 'danger' : 'secondary')); ?>">
                            <?php echo app('translator')->get('messages.order_status_' . $order->order_status); ?>
                        </span>
                    </p>
                    
                    <p><strong><?php echo app('translator')->get('messages.payment_method'); ?>:</strong> 
                        <span class="badge bg-<?php echo e($order->payment_method == 'card' ? 'primary' : 'warning text-dark'); ?>">
                            <i class="fas <?php echo e($order->payment_method == 'card' ? 'fa-credit-card' : 'fa-money-bill-wave'); ?> me-1"></i>
                            <?php echo app('translator')->get('messages.payment_method_' . ($order->payment_method ?? 'unknown')); ?>
                        </span>
                        <?php if($order->payment_method == 'cash'): ?>
                            <?php if($order->delivery_type == 'delivery'): ?>
                                <small class="text-muted d-block mt-1">(<?php echo app('translator')->get('messages.cash_on_delivery'); ?>)</small>
                            <?php else: ?>
                                <small class="text-muted d-block mt-1">(<?php echo app('translator')->get('messages.pay_at_restaurant'); ?>)</small>
                            <?php endif; ?>
                        <?php endif; ?>
                    </p>
                    
                    <p><strong><?php echo app('translator')->get('messages.payment_status'); ?>:</strong> 
                        <span class="badge bg-<?php echo e($order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'failed' ? 'danger' : 'warning text-dark')); ?>">
                            <?php echo app('translator')->get('messages.payment_status_' . $order->payment_status); ?>
                        </span>
                        <?php if($order->payment_method == 'cash' && $order->payment_status == 'pending'): ?>
                            <small class="text-muted d-block mt-1">
                                <?php if($order->delivery_type == 'delivery'): ?>
                                    <?php echo app('translator')->get('messages.payment_due_on_delivery'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('messages.payment_due_at_restaurant'); ?>
                                <?php endif; ?>
                            </small>
                        <?php endif; ?>
                    </p>
                    
                    <p><strong><?php echo app('translator')->get('messages.total_amount'); ?>:</strong> 
                        <span class="fw-bold text-success">€<?php echo e(number_format($order->total_amount, 2)); ?></span>
                    </p>

                    <?php if($order->delivery_type == 'delivery' && $order->delivery_otp): ?>
                        <div class="alert alert-info mt-3">
                            <strong><?php echo app('translator')->get('messages.delivery_otp'); ?>:</strong> 
                            <span class="fs-5 fw-bold text-primary"><?php echo e($order->delivery_otp); ?></span>
                            <br>
                            <small><?php echo app('translator')->get('messages.share_otp_with_delivery_person'); ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Ordered Items -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <?php echo app('translator')->get('messages.ordered_items'); ?>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><?php echo app('translator')->get('messages.item'); ?></th>
                                <th><?php echo app('translator')->get('messages.qty'); ?></th>
                                <th><?php echo app('translator')->get('messages.price'); ?></th>
                                <th><?php echo app('translator')->get('messages.subtotal'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $itemsTotal = 0;
                            ?>
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $itemSubtotal = $item->price * $item->quantity;
                                    $itemsTotal += $itemSubtotal;
                                ?>
                                <tr>
                                    <td><?php echo e($item->menuItem->name); ?></td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td>€<?php echo e(number_format($item->price, 2)); ?></td>
                                    <td>€<?php echo e(number_format($itemSubtotal, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><?php echo app('translator')->get('messages.subtotal'); ?>:</td>
                                <td>€<?php echo e(number_format($itemsTotal, 2)); ?></td>
                            </tr>
                            <?php if($order->delivery_charge && $order->delivery_charge > 0): ?>
                                <tr>
                                    <td colspan="3" class="text-end"><?php echo app('translator')->get('messages.delivery_charge'); ?>:</td>
                                    <td>€<?php echo e(number_format($order->delivery_charge, 2)); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="3" class="text-end"><?php echo app('translator')->get('messages.tax'); ?> (10%):</td>
                                <td>€<?php echo e(number_format($order->total_amount - $itemsTotal - ($order->delivery_charge ?? 0), 2)); ?></td>
                            </tr>
                            <tr class="fw-bold table-success">
                                <td colspan="3" class="text-end"><?php echo app('translator')->get('messages.total'); ?>:</td>
                                <td>€<?php echo e(number_format($order->total_amount, 2)); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Order Actions (for cash payments) -->
            <?php if($order->payment_method == 'cash' && $order->payment_status == 'pending'): ?>
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-warning text-dark">
                        <i class="fas fa-exclamation-triangle me-1"></i><?php echo app('translator')->get('messages.cash_payment_pending'); ?>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">
                            <?php if($order->delivery_type == 'delivery'): ?>
                                <?php echo app('translator')->get('messages.customer_will_pay_cash_on_delivery'); ?>
                            <?php else: ?>
                                <?php echo app('translator')->get('messages.customer_will_pay_cash_at_restaurant'); ?>
                            <?php endif; ?>
                        </p>
                        <form method="POST" action="<?php echo e(route('admin.order.updatePayment', $order->id)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="payment_status" value="paid">
                            <button type="submit" class="btn btn-success btn-sm" 
                                    onclick="return confirm('<?php echo app('translator')->get('messages.confirm_cash_payment_received'); ?>')">
                                <i class="fas fa-check-circle me-1"></i><?php echo app('translator')->get('messages.mark_as_paid'); ?>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/order/show.blade.php ENDPATH**/ ?>