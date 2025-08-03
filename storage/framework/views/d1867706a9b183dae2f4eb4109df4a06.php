<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Order - Imperial Spice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #d4a574, #c89a5c);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .order-details {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .customer-info {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            border-left: 4px solid #d4a574;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .items-table th,
        .items-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .items-table th {
            background: #f5f5f5;
            font-weight: bold;
        }
        .total-row {
            font-weight: bold;
            background: #f0f8f0;
        }
        .delivery-info {
            background: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            border-left: 4px solid #ffc107;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-confirmed {
            background: #d4edda;
            color: #155724;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🍽️ New Order Received!</h1>
        <p>Imperial Spice Restaurant</p>
    </div>

    <div class="content">
        <div class="order-details">
            <h2>Order Information</h2>
            <p><strong>Order ID:</strong> #<?php echo e($order->id); ?></p>
            <p><strong>Order Date:</strong> <?php echo e($order->created_at->format('d M Y, H:i A')); ?></p>
            <p><strong>Order Type:</strong> 
                <?php if($order->delivery_type === 'dinein'): ?>
                    🏪 Dine In (Table #<?php echo e($order->table_no); ?>)
                <?php else: ?>
                    🚚 Delivery
                <?php endif; ?>
            </p>
            <p><strong>Payment Method:</strong> 
                <?php if($order->payment_method === 'cash'): ?>
                    💵 Cash <?php echo e($order->delivery_type === 'delivery' ? 'on Delivery' : 'at Restaurant'); ?>

                <?php else: ?>
                    💳 Card Payment
                <?php endif; ?>
            </p>
            <p><strong>Payment Status:</strong> 
                <span class="status-badge status-<?php echo e($order->payment_status); ?>">
                    <?php echo e(ucfirst($order->payment_status)); ?>

                </span>
            </p>
            <p><strong>Order Status:</strong> 
                <span class="status-badge status-<?php echo e($order->order_status); ?>">
                    <?php echo e(ucfirst($order->order_status)); ?>

                </span>
            </p>
        </div>

        <div class="customer-info">
            <h3>👤 Customer Details</h3>
            <p><strong>Name:</strong> <?php echo e($order->user->name); ?></p>
            <p><strong>Email:</strong> <?php echo e($order->user->email); ?></p>
            <p><strong>Phone:</strong> <?php echo e($order->user->phone ?? 'Not provided'); ?></p>
        </div>

        <?php if($order->delivery_type === 'delivery'): ?>
        <div class="delivery-info">
            <h3>📍 Delivery Information</h3>
            <p><strong>Address:</strong> <?php echo e($order->delivery_address); ?></p>
            <?php if($order->delivery_fee > 0): ?>
                <p><strong>Delivery Fee:</strong> €<?php echo e(number_format($order->delivery_fee, 2)); ?></p>
            <?php else: ?>
                <p><strong>Delivery:</strong> FREE</p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="order-details">
            <h3>🛍️ Order Items</h3>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->menuItem->name); ?></td>
                        <td><?php echo e($item->quantity); ?></td>
                        <td>€<?php echo e(number_format($item->price, 2)); ?></td>
                        <td>€<?php echo e(number_format($item->price * $item->quantity, 2)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($order->tax > 0): ?>
                    <tr>
                        <td colspan="3"><strong>Tax (10%):</strong></td>
                        <td><strong>€<?php echo e(number_format($order->tax, 2)); ?></strong></td>
                    </tr>
                    <?php endif; ?>
                    
                    <?php if($order->delivery_fee > 0): ?>
                    <tr>
                        <td colspan="3"><strong>Delivery Fee:</strong></td>
                        <td><strong>€<?php echo e(number_format($order->delivery_fee, 2)); ?></strong></td>
                    </tr>
                    <?php endif; ?>
                    
                    <tr class="total-row">
                        <td colspan="3"><strong>TOTAL AMOUNT:</strong></td>
                        <td><strong>€<?php echo e(number_format($order->total_amount, 2)); ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated notification from Imperial Spice Restaurant System</p>
        <p>Generated on <?php echo e(now()->format('d M Y, H:i A')); ?></p>
    </div>
</body>
</html><?php /**PATH D:\Imperial Spice\website\resources\views/emails/order-placed.blade.php ENDPATH**/ ?>