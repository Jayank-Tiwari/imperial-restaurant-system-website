@extends('layout.app')

@section('title', 'Home - Imperial Spice')
@section('active', 'home')

@push('styles')
<style>
    :root {
        --primary-orange: #d35400;
        --soft-orange: #fff3ec;
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        background-color: #1a1a1a;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%);
        z-index: 1;
    }

    .hero-section .container {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-weight: 800;
        letter-spacing: -1px;
        text-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .hero-subtitle {
        font-weight: 400;
        font-size: 1.3rem;
        text-shadow: 0 2px 8px rgba(0,0,0,0.2);
        max-width: 700px;
        margin: 0 auto;
    }

    /* Buttons */
    .btn-premium {
        background-color: var(--primary-orange);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        font-weight: 700;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(211, 84, 0, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.95rem;
    }

    .btn-premium:hover {
        background-color: #c0392b;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(211, 84, 0, 0.4);
    }

    .btn-premium-outline {
        background-color: transparent;
        color: white;
        border: 2px solid white;
        padding: 0.8rem 2rem;
        font-weight: 700;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.95rem;
    }

    .btn-premium-outline:hover {
        background-color: white;
        color: #1a1a1a;
        transform: translateY(-3px);
    }

    /* Menu Item Card Styling for Home Page */
    .menu-item-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #fff;
    }

    .menu-item-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(211, 84, 0, 0.12);
    }

    .menu-item-card .card-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 240px;
    }

    .menu-item-card .card-img-top {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .menu-item-card:hover .card-img-top {
        transform: scale(1.08);
    }

    .badge-featured {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary-orange);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        z-index: 2;
    }

    .menu-item-card .card-body {
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .menu-item-card .card-title {
        font-size: 1.35rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: #2d3436;
    }

    .menu-item-card .card-text {
        font-size: 0.95rem;
        color: #636e72;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .menu-item-card .price-section {
        margin-top: auto;
        padding-top: 1.25rem;
        border-top: 2px dashed #f1f2f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .menu-item-card .price {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--primary-orange);
    }

    .add-to-cart {
        border-radius: 50px;
        padding: 0.6rem 1.25rem;
        font-weight: 700;
        background-color: var(--soft-orange);
        color: var(--primary-orange);
        border: none;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    .add-to-cart:hover {
        background-color: var(--primary-orange);
        color: white;
        transform: scale(1.05);
    }

    /* Section Titles */
    .section-title {
        font-weight: 800;
        font-size: 2.5rem;
        color: #2d3436;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background-color: var(--primary-orange);
        border-radius: 2px;
    }

    /* Testimonial card styling */
    .testimonial-card {
        border: none;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        transition: transform 0.3s ease;
        background: #fff;
        position: relative;
    }

    .testimonial-card::before {
        content: '\201C';
        position: absolute;
        top: -15px;
        left: 20px;
        font-size: 5rem;
        color: var(--soft-orange);
        font-family: serif;
        line-height: 1;
        z-index: 0;
    }

    .testimonial-card:hover {
        transform: translateY(-8px);
    }

    .testimonial-text {
        position: relative;
        z-index: 1;
        font-size: 1.1rem;
        font-style: italic;
        color: #636e72;
        line-height: 1.7;
    }

    /* Feature List */
    .feature-icon-box {
        width: 50px;
        height: 50px;
        background-color: var(--soft-orange);
        color: var(--primary-orange);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem !important;
        }
        .hero-subtitle {
            font-size: 1.1rem;
        }
        .section-title {
            font-size: 2rem;
        }
        .menu-item-card .card-img-wrapper {
            height: 200px;
        }
    }

    /* Toast notification styles */
    .custom-toast {
        animation: slideInFromRight 0.3s ease-out;
    }

    @keyframes slideInFromRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
</style>
@endpush

@section('content')

    <section class="hero-section d-flex align-items-center"
        style="background-image: url('{{ asset('assets/img/home.webp') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">
        <div class="container position-relative z-1 py-5 my-5">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-9">
                    <h1 class="display-2 hero-title text-white mb-4" data-aos="fade-up">
                        @lang('messages.hero_title')
                    </h1>
                    <p class="hero-subtitle text-white-50 mb-5" data-aos="fade-up" data-aos-delay="100">
                        @lang('messages.hero_subtitle')
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ url('/booking') }}" class="btn btn-premium">
                            <i class="fas fa-calendar-alt me-2"></i>@lang('messages.book_a_table')
                        </a>
                        <a href="{{ url('/menu') }}" class="btn btn-premium-outline">
                            <i class="fas fa-utensils me-2"></i>@lang('messages.view_full_menu')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-4">
            <div class="text-center mb-5 pb-3" data-aos="fade-up">
                <h2 class="section-title">@lang('messages.our_top_dishes')</h2>
                <p class="text-muted mt-3 fs-5">@lang('messages.our_top_dishes_description')</p>
            </div>

            <div class="row g-4 mb-5">
                @foreach ($dishes as $dish)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up">
                        <div class="card menu-item-card">
                            <div class="card-img-wrapper">
                                <span class="badge-featured">Top Rated</span>
                                <img src="{{ $dish->image ? asset($dish->image) : 'https://placehold.co/400x400/f8f9fa/d35400?text=Imperial+Spice' }}" 
                                     class="card-img-top" 
                                     alt="{{ $dish->name }}" 
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='https://placehold.co/400x400/f8f9fa/d35400?text=Imperial+Spice';">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $dish->name }}</h5>
                                <p class="card-text">{{ $dish->description }}</p>
                                <div class="price-section">
                                    <span class="price">@lang('messages.currency'){{ number_format($dish->price, 2) }}</span>
                                    <button class="btn add-to-cart shadow-sm" data-id="{{ $dish->id }}">
                                        <i class="fas fa-shopping-basket me-1"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ url('/menu') }}" class="btn btn-premium shadow-sm">
                    <i class="fas fa-compass me-2"></i> Explore Full Menu
                </a>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 pe-lg-5" data-aos="fade-right">
                    <h2 class="fw-bold display-5 mb-4" style="color: #2d3436; letter-spacing: -1px;">@lang('messages.unforgettable_dining_experience')</h2>
                    <p class="text-muted mb-5 fs-5">@lang('messages.unforgettable_dining_experience_description')</p>
                    
                    <div class="vstack gap-4">
                        <div class="d-flex align-items-start">
                            <div class="feature-icon-box me-4 shadow-sm">
                                <i class="fas fa-fire"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">@lang('messages.authentic_bold_flavors')</h5>
                                <p class="mb-0 text-muted">@lang('messages.authentic_bold_flavors_desc')</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="feature-icon-box me-4 shadow-sm">
                                <i class="fas fa-glass-cheers"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">@lang('messages.elegant_inviting_ambiance')</h5>
                                <p class="mb-0 text-muted">@lang('messages.elegant_inviting_ambiance_desc')</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="feature-icon-box me-4 shadow-sm">
                                <i class="fas fa-concierge-bell"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">@lang('messages.impeccable_service')</h5>
                                <p class="mb-0 text-muted">@lang('messages.impeccable_service_desc')</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="position-relative">
                        <img src="{{ asset('assets/img/whyus.webp') }}" class="img-fluid w-100"
                            style="border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);" alt="Restaurant Ambiance">
                        <div class="position-absolute bottom-0 start-0 translate-middle-x mb-4 ms-4 d-none d-md-block">
                            <div class="bg-white p-4 rounded-4 shadow-lg text-center" style="border-left: 4px solid var(--primary-orange);">
                                <h3 class="fw-bold text-dark mb-0">2021</h3>
                                <p class="text-muted small fw-bold text-uppercase mb-0">Serving<br>Since</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3" data-aos="fade-up">
                <h2 class="section-title">@lang('messages.what_our_customers_say')</h2>
                <p class="text-muted mt-3 fs-5">@lang('messages.our_customers_say_description')</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="testimonial-card h-100">
                        <div class="mb-3" style="color: var(--primary-orange); font-size: 0.9rem;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text mb-4">@lang('messages.testimonial_1')</p>
                        <div class="d-flex align-items-center mt-auto">
                            <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold text-dark" style="width: 45px; height: 45px;">
                                {{ substr(__('messages.testimonial_1_author'), 0, 1) }}
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">@lang('messages.testimonial_1_author')</h6>
                                <small class="text-muted">@lang('messages.testimonial_1_author_role')</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card h-100">
                        <div class="mb-3" style="color: var(--primary-orange); font-size: 0.9rem;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text mb-4">@lang('messages.testimonial_2')</p>
                        <div class="d-flex align-items-center mt-auto">
                            <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold text-dark" style="width: 45px; height: 45px;">
                                {{ substr(__('messages.testimonial_2_author'), 0, 1) }}
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">@lang('messages.testimonial_2_author')</h6>
                                <small class="text-muted">@lang('messages.testimonial_2_author_role')</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card h-100">
                        <div class="mb-3" style="color: var(--primary-orange); font-size: 0.9rem;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="testimonial-text mb-4">@lang('messages.testimonial_3')</p>
                        <div class="d-flex align-items-center mt-auto">
                            <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold text-dark" style="width: 45px; height: 45px;">
                                {{ substr(__('messages.testimonial_3_author'), 0, 1) }}
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">@lang('messages.testimonial_3_author')</h6>
                                <small class="text-muted">@lang('messages.testimonial_3_author_role')</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Function to update cart count in header
            function updateCartCount(count) {
                const cartCountElement = document.getElementById('cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = count;
                    
                    // Add animation effect
                    cartCountElement.style.transform = 'scale(1.3)';
                    cartCountElement.style.transition = 'transform 0.2s ease';
                    
                    setTimeout(() => {
                        cartCountElement.style.transform = 'scale(1)';
                    }, 200);
                } else {
                    console.warn('Cart count element not found');
                }
            }

            // Simple toast notification function
            function showToast(message, type = 'success') {
                // Remove existing toasts
                const existingToasts = document.querySelectorAll('.custom-toast');
                existingToasts.forEach(toast => toast.remove());

                // Create toast element
                const toast = document.createElement('div');
                toast.className = `custom-toast alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} position-fixed`;
                toast.style.cssText = `
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 300px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    border-radius: 8px;
                    background: ${type === 'success' ? '#fff' : '#fff'};
                    border-left: 4px solid ${type === 'success' ? '#2e7d32' : '#d32f2f'};
                    color: #333;
                `;
                toast.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${type === 'success' ? 'check-circle text-success' : type === 'error' ? 'exclamation-circle text-danger' : 'info-circle'} me-3 fs-5"></i>
                        <span class="fw-semibold">${message}</span>
                        <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
                    </div>
                `;
                
                // Add to page
                document.body.appendChild(toast);
                
                // Remove after 4 seconds
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.style.animation = 'slideInFromRight 0.3s ease-out reverse';
                        setTimeout(() => toast.remove(), 300);
                    }
                }, 4000);
            }

            // Add to cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const menuItemId = this.dataset.id;
                    const originalText = this.innerHTML;

                    // Check if user is logged in first
                    @guest
                        showToast('Please log in to add items to the cart.', 'error');
                        setTimeout(() => {
                            window.location.href = '{{ route('login') }}';
                        }, 1500);
                        return;
                    @endguest

                    // Disable button during request
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>...';

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
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Success - show confirmation
                            this.innerHTML = '<i class="fas fa-check me-1"></i>Added';
                            this.classList.add('bg-success', 'text-white');
                            this.classList.remove('btn-primary'); // in case it had it
                            this.style.backgroundColor = '#2e7d32';
                            this.style.color = '#fff';

                            // Update cart count in header
                            if (data.cart_count !== undefined) {
                                updateCartCount(data.cart_count);
                            }

                            // Show success notification
                            showToast('Added to cart successfully!', 'success');

                            // Reset button after 2 seconds
                            setTimeout(() => {
                                this.innerHTML = originalText;
                                this.classList.remove('bg-success', 'text-white');
                                this.style.backgroundColor = '';
                                this.style.color = '';
                                this.disabled = false;
                            }, 2000);
                        } else {
                            throw new Error(data.message || 'Failed to add item to cart');
                        }
                    })
                    .catch(error => {
                        console.error('Cart error:', error);
                        
                        if (error.message.includes('401') || error.message.includes('Unauthenticated')) {
                            this.innerHTML = '<i class="fas fa-exclamation me-1"></i>Login';
                            showToast('Please log in to add items to the cart.', 'error');
                        } else {
                            this.innerHTML = '<i class="fas fa-exclamation me-1"></i>Error';
                            showToast('Error adding item to cart', 'error');
                        }
                        
                        this.style.backgroundColor = '#d32f2f';
                        this.style.color = '#fff';
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.backgroundColor = '';
                            this.style.color = '';
                            this.disabled = false;
                        }, 3000);
                    });
                });
            });
        });
    </script>
@endsection
