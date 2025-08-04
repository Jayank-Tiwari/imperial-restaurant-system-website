<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset ('assets/css/style.css')); ?>" rel="stylesheet">
     <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <?php echo $__env->make('layout.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>


    
    <?php echo $__env->make('layout.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
// Global cart count updater
window.updateCartCount = function(count) {
    console.log('Global updateCartCount called with:', count);
    
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
        
        // Animation
        cartCountElement.style.transform = 'scale(1.3)';
        cartCountElement.style.transition = 'transform 0.2s ease';
        
        setTimeout(() => {
            cartCountElement.style.transform = 'scale(1)';
        }, 200);
        
        return true;
    }
    
    console.warn('Cart count element not found');
    return false;
};

// Ensure DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, cart element:', document.getElementById('cart-count'));
});
</script>
</body>
</html><?php /**PATH D:\Imperial Spice\website\resources\views/layout/app.blade.php ENDPATH**/ ?>