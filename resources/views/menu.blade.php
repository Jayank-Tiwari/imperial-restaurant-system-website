@extends('layout.app')

@section('title', 'Menu - Imperial Spice')
@section('active', 'menu')

@push('styles')
<style>
    /* Hero section overlay for better text readability */
    .hero-section {
        position: relative;
        height: 40vh;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.7) 100%);
        z-index: 1;
    }

    .hero-section .container {
        position: relative;
        z-index: 2;
    }

    /* Sticky Navigation */
    .sticky-nav-container {
        position: sticky;
        top: 70px; /* Adjust based on your main navbar height */
        z-index: 1020;
        background: #fff;
        border-bottom: 1px solid #e9ecef;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .filter-buttons-wrapper {
        display: flex;
        overflow-x: auto;
        overflow-y: hidden;
        flex-wrap: nowrap;
        justify-content: flex-start;
        padding: 1rem 0;
        gap: 1rem;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE/Edge */
    }

    /* Remove desktop centering to prevent left-side clipping on overflow */
    @media (min-width: 992px) {
        .filter-buttons-wrapper {
            justify-content: flex-start;
            /* Padding to align with container on desktop */
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    .filter-buttons-wrapper::-webkit-scrollbar {
        height: 6px; /* Show a thin scrollbar */
        display: none; /* Hide on mobile by default */
    }

    @media (min-width: 992px) {
        .filter-buttons-wrapper::-webkit-scrollbar {
            display: block; /* Show on desktop */
        }
        .filter-buttons-wrapper::-webkit-scrollbar-track {
            background: #f1f3f5;
            border-radius: 10px;
        }
        .filter-buttons-wrapper::-webkit-scrollbar-thumb {
            background: #ced4da;
            border-radius: 10px;
        }
        .filter-buttons-wrapper::-webkit-scrollbar-thumb:hover {
            background: #adb5bd;
        }
    }

    .filter-buttons-wrapper .btn {
        border-radius: 50px;
        padding: 0.7rem 1.75rem;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
        white-space: nowrap;
        text-transform: capitalize;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e9ecef;
        color: #495057;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }

    .filter-buttons-wrapper .btn:hover {
        border-color: #ced4da;
        color: var(--primary-color, #d35400);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.05);
        background: #f8f9fa;
    }

    .filter-buttons-wrapper .btn.active {
        background: var(--primary-color, #d35400);
        color: white;
        border-color: var(--primary-color, #d35400);
        box-shadow: 0 6px 15px rgba(211, 84, 0, 0.35);
        transform: translateY(-2px);
    }
    
    .filter-buttons-wrapper .btn:active {
        transform: translateY(0);
    }

    /* Horizontal Menu Cards (Modern App Style) */
    .category-section {
        padding-top: 2rem;
        padding-bottom: 1rem;
        scroll-margin-top: 140px; /* Accounts for navbar + sticky nav */
    }

    .category-title {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
        padding-bottom: 0.5rem;
        text-transform: capitalize;
    }
    
    .category-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--primary-color, #d35400);
        border-radius: 2px;
    }

    .menu-item-card {
        display: flex;
        flex-direction: row;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        border: 1px solid #f1f3f5;
        height: 100%;
    }

    .menu-item-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }

    .menu-item-img-container {
        width: 140px;
        min-width: 140px;
        position: relative;
    }

    .menu-item-card .card-img-left {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .menu-item-content {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: space-between;
    }

    .menu-item-card .card-title {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        color: #2b2b2b;
    }

    .menu-item-card .card-text {
        font-size: 0.9rem;
        color: #6c757d;
        line-height: 1.4;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .menu-item-card .price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2b2b2b;
    }

    .add-to-cart {
        border-radius: 50px;
        padding: 0.4rem 1.2rem;
        font-weight: 600;
        font-size: 0.9rem;
        background: var(--primary-color, #d35400);
        color: white;
        border: none;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .add-to-cart:hover {
        background: #b54600;
        transform: scale(1.05);
    }

    .add-to-cart:active {
        transform: scale(0.95);
    }

    /* Animation styles */
    .fade-in-up { 
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    
    @keyframes fadeInUp {
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
        /* Switch to vertical cards on smaller tablets and mobile for better readability */
        .menu-item-card {
            flex-direction: column;
        }
        
        .menu-item-img-container {
            width: 100%;
            min-width: 100%;
            height: 200px;
        }
        
        .menu-item-content {
            padding: 1.25rem;
        }

        .hero-section {
            height: 30vh;
            min-height: 250px;
        }

        .category-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .menu-item-img-container {
            height: 180px;
        }
        
        .menu-item-content {
            padding: 1rem;
        }
        
        .menu-item-card .card-title {
            font-size: 1.1rem;
        }
        
        .add-to-cart {
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero-section mt-5" style="background-image: url('{{ asset('assets/img/home.webp') }}'); background-size: cover; background-position: center;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold text-white mb-3 fade-in-up" style="animation-delay: 0.1s">@lang('messages.our_menu')</h1>
        <p class="lead text-white fade-in-up" style="animation-delay: 0.3s">@lang('messages.discover_our_dishes')</p>
    </div>
</section>

<!-- Sticky Filter/Nav Buttons -->
<section class="sticky-nav-container">
    <div class="container">
        <div class="filter-buttons-wrapper" id="menuFilter">
            @foreach($menuItems->keys() as $index => $cat)
                @php
                    $parts = explode('//', $cat);
                    $displayName = (app()->getLocale() == 'es' && isset($parts[1])) 
                        ? trim($parts[1])  
                        : trim($parts[0]); 
                    $safeId = Str::slug($cat);
                @endphp
                <button type="button" class="btn {{ $index === 0 ? 'active' : '' }}" data-target="{{ $safeId }}">
                    {{ $displayName }}
                </button>
            @endforeach
        </div>
    </div>
</section>

<!-- Menu Items Sections -->
<section class="py-5 bg-light">
    <div class="container">
        @forelse($menuItems as $category => $items)
            @php
                $parts = explode('//', $category);
                $displayName = (app()->getLocale() == 'es' && isset($parts[1])) 
                    ? trim($parts[1])  
                    : trim($parts[0]); 
                $safeId = Str::slug($category);
            @endphp
            
            <div id="{{ $safeId }}" class="category-section">
                <h2 class="category-title fade-in-up">{{ $displayName }}</h2>
                <div class="row g-4 mt-2">
                    @foreach($items as $index => $item)
                        <div class="col-lg-6 fade-in-up" style="animation-delay: {{ 0.1 * ($index % 10) }}s">
                            <div class="menu-item-card" data-id="{{ $item->id }}">
                                <div class="menu-item-img-container">
                                    <img src="{{ $item->image ? asset($item->image) : 'https://placehold.co/400x400/f8f9fa/d35400?text=Imperial+Spice' }}" 
                                         class="card-img-left" 
                                         alt="{{ $item->name }}"
                                         onerror="this.onerror=null; this.src='https://placehold.co/400x400/f8f9fa/d35400?text=Imperial+Spice';"
                                         loading="lazy">
                                </div>
                                <div class="menu-item-content">
                                    <div>
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <p class="card-text">{{ $item->description }}</p>
                                    </div>
                                    <div class="price-row">
                                        <span class="price">€{{ number_format($item->price, 2) }}</span>
                                        <button class="add-to-cart">
                                            <i class="fas fa-plus"></i> @lang('messages.add_to_cart')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded shadow-sm fade-in-up">
                    <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No menu items available</h4>
                    <p class="text-muted">Please check back later for our delicious offerings.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- Smooth Scrolling & Scrollspy ---
        const navButtons = document.querySelectorAll('#menuFilter button');
        const sections = document.querySelectorAll('.category-section');
        let isClickScrolling = false;

        // Click to scroll
        navButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    isClickScrolling = true;
                    
                    // Update active class immediately
                    navButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Center the button in the scrollable wrapper (for mobile)
                    const wrapper = document.getElementById('menuFilter');
                    wrapper.scrollTo({
                        left: this.offsetLeft - (wrapper.clientWidth / 2) + (this.clientWidth / 2),
                        behavior: 'smooth'
                    });

                    // Scroll to section
                    targetSection.scrollIntoView({
                        behavior: 'smooth'
                    });

                    // Release scroll flag after animation
                    setTimeout(() => {
                        isClickScrolling = false;
                    }, 800);
                }
            });
        });

        // Scrollspy: update active nav button based on scroll position
        window.addEventListener('scroll', function() {
            if (isClickScrolling) return; // Don't interfere during smooth click scrolling

            let currentSection = '';
            // Accounts for navbar + sticky nav height
            const scrollPosition = window.scrollY + 160; 

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    currentSection = section.getAttribute('id');
                }
            });

            if (currentSection) {
                navButtons.forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.getAttribute('data-target') === currentSection) {
                        btn.classList.add('active');
                        
                        // Optionally center button on scroll too (nice for mobile)
                        const wrapper = document.getElementById('menuFilter');
                        wrapper.scrollTo({
                            left: btn.offsetLeft - (wrapper.clientWidth / 2) + (btn.clientWidth / 2),
                            behavior: 'smooth'
                        });
                    }
                });
            }
        });


        // --- Add to Cart Functionality ---
        function updateCartCount(count) {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                try {
                    cartCountElement.textContent = count;
                    cartCountElement.style.transform = 'scale(1.3)';
                    cartCountElement.style.transition = 'transform 0.2s ease';
                    setTimeout(() => { cartCountElement.style.transform = 'scale(1)'; }, 200);
                } catch (error) {
                    console.error('Error updating cart count:', error);
                }
            }
        }

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                const cardDiv = this.closest('.menu-item-card');
                const menuItemId = cardDiv.dataset.id;
                const originalText = this.innerHTML;

                @guest
                    alert('Please log in to add items to the cart.');
                    window.location.href = '{{ route('login') }}';
                    return;
                @endguest

                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        menu_item_id: menuItemId,
                        quantity: 1
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        this.innerHTML = '<i class="fas fa-check"></i>';
                        this.style.background = '#28a745';
                        
                        if (data.cart_count !== undefined) {
                            if (window.updateCartCount && window.updateCartCount(data.cart_count)) {
                                // Handled globally
                            } else {
                                updateCartCount(data.cart_count);
                            }
                        }

                        showToast('Item added to cart successfully!', 'success');

                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.background = '';
                            this.disabled = false;
                        }, 2000);
                    } else {
                        throw new Error(data.message || 'Failed to add item to cart');
                    }
                })
                .catch(error => {
                    console.error('Cart error:', error);
                    if (error.message.includes('401') || error.message.includes('Unauthenticated')) {
                        showToast('Please log in to add items to the cart.', 'error');
                    } else {
                        showToast('Error adding item to cart', 'error');
                    }
                    this.innerHTML = '<i class="fas fa-exclamation"></i>';
                    this.style.background = '#dc3545';
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.style.background = '';
                        this.disabled = false;
                    }, 3000);
                });
            });
        });

        function showToast(message, type = 'info') {
            const existingToasts = document.querySelectorAll('.custom-toast');
            existingToasts.forEach(toast => toast.remove());

            const toast = document.createElement('div');
            toast.className = `custom-toast alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} position-fixed`;
            toast.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                border-radius: 8px;
                animation: slideIn 0.3s ease-out;
            `;
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                    <span>${message}</span>
                    <button type="button" class="btn-close ms-auto" onclick="this.parentElement.remove()"></button>
                </div>
            `;
            
            if (!document.getElementById('toast-styles')) {
                const style = document.createElement('style');
                style.id = 'toast-styles';
                style.textContent = `
                    @keyframes slideIn {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                `;
                document.head.appendChild(style);
            }
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.style.animation = 'slideIn 0.3s ease-out reverse';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 4000);
        }
    });
</script>

@endsection
