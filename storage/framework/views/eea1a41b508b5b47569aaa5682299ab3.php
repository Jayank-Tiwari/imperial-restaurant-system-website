

<?php $__env->startSection('title', 'Menu - Imperial Spice'); ?>
<?php $__env->startSection('active', 'menu'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Menu Item Card Styling */
    .menu-item-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .menu-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.15);
    }

    .menu-item-card .card-img-top {
        height: 200px;
        object-fit: cover;
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .menu-item-card .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        min-height: 180px;
    }

    .menu-item-card .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--primary-color, #d35400);
    }

    .menu-item-card .card-text {
        font-size: 0.9rem;
        color: #6c757d;
        line-height: 1.5;
        margin-bottom: 1rem;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .menu-item-card .price-section {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid #f8f9fa;
    }

    .menu-item-card .price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color, #d35400);
    }

    .add-to-cart {
        border-radius: 25px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .add-to-cart:hover {
        transform: scale(1.05);
    }

    /* Filter button styling */
    .filter-buttons-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
        max-width: 100%;
    }

    .filter-buttons-wrapper .btn {
        border-radius: 25px;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        transition: all 0.3s ease;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        background: white;
    }

    .filter-buttons-wrapper .btn:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    .filter-buttons-wrapper .btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    /* Animation styles */
    .fade-in { 
        animation: fadeIn 0.5s ease-in; 
    }
    
    @keyframes fadeIn {
        from { 
            opacity: 0; 
            transform: translateY(20px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .menu-item-card .card-img-top {
            height: 180px;
        }
        
        .menu-item-card .card-body {
            min-height: 160px;
            padding: 1.25rem;
        }

        .filter-buttons-wrapper {
            gap: 0.25rem;
            padding: 0 1rem;
        }

        .filter-buttons-wrapper .btn {
            padding: 0.4rem 1rem;
            font-size: 0.875rem;
            letter-spacing: 0.3px;
        }

        /* For very small screens, make buttons stack better */
        @media (max-width: 576px) {
            .filter-buttons-wrapper {
                gap: 0.5rem;
            }
            
            .filter-buttons-wrapper .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
                min-width: auto;
            }
        }
    }

    /* Hero section overlay for better text readability */
    .hero-section {
        position: relative;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .hero-section .container {
        position: relative;
        z-index: 2;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<!-- Hero Section -->
<section class="hero-section py-5 mt-5" style="background-image: url('<?php echo e(asset('assets/img/home.webp')); ?>'); background-size: cover; background-position: center;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white"><?php echo app('translator')->get('messages.our_menu'); ?></h1>
        <p class="lead text-white"><?php echo app('translator')->get('messages.discover_our_dishes'); ?></p>
    </div>
</section>

<!-- Filter Buttons -->
<section class="py-4 bg-white sticky-top shadow-sm">
    <div class="container text-center">
        <div class="filter-buttons-wrapper" id="menuFilter">
            <button type="button" class="btn btn-outline-primary active" data-filter="all"><?php echo app('translator')->get('messages.all_items'); ?></button>
            <?php $__currentLoopData = $menuItems->keys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // Split category name by " // " separator
                    $parts = explode(' // ', $cat);
                    $displayName = (app()->getLocale() == 'es' && isset($parts[1])) 
                        ? trim($parts[1])  // Spanish name
                        : trim($parts[0]); // English name (default)
                ?>
                <button type="button" class="btn btn-outline-primary" data-filter="<?php echo e($cat); ?>">
                    <?php echo e($displayName); ?>

                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Menu Items -->
<section class="py-5">
    <div class="container">
        <div class="row g-4" id="menuItems">
            <?php $__empty_1 = true; $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 menu-item" data-category="<?php echo e($category); ?>" data-id="<?php echo e($item->id); ?>">
                        <div class="card menu-item-card h-100">
                            <img src="<?php echo e($item->image ? asset($item->image) : asset('assets/img/placeholder.jpg')); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo e($item->name); ?>"
                                 loading="lazy">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($item->name); ?></h5>
                                <p class="card-text"><?php echo e($item->description); ?></p>
                                <div class="price-section d-flex justify-content-between align-items-center">
                                    <span class="price">€<?php echo e(number_format($item->price, 2)); ?></span>
                                    <button class="btn btn-primary add-to-cart">
                                        <i class="fas fa-plus me-1"></i><?php echo app('translator')->get('messages.add_to_cart'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No menu items available</h4>
                        <p class="text-muted">Please check back later for our delicious offerings.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    // Filter functionality
    document.querySelectorAll('#menuFilter button').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelectorAll('#menuFilter button').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            document.querySelectorAll('.menu-item').forEach(item => {
                const match = filter === 'all' || item.dataset.category === filter;
                item.style.display = match ? 'block' : 'none';
                if (match) {
                    item.classList.add('fade-in');
                }
            });
        });
    });

    // Add to cart via backend
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const itemDiv = this.closest('.menu-item');
            const menuItemId = itemDiv.dataset.id;
            const originalText = this.innerHTML;

            // Disable button during request
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Adding...';

            fetch('<?php echo e(route('cart.add')); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    menu_item_id: menuItemId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.innerHTML = '<i class="fas fa-check me-1"></i>Added!';
                    this.classList.replace('btn-primary', 'btn-success');

                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.replace('btn-success', 'btn-primary');
                        this.disabled = false;
                    }, 2000);
                } else {
                    throw new Error(data.message || 'Failed to add item');
                }
            })
            .catch(error => {
                console.error('Cart error:', error);
                this.innerHTML = '<i class="fas fa-exclamation me-1"></i>Error';
                this.classList.replace('btn-primary', 'btn-danger');
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.replace('btn-danger', 'btn-primary');
                    this.disabled = false;
                }, 2000);
                
                alert('Please log in to add items to the cart.');
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/menu.blade.php ENDPATH**/ ?>