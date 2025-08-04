@extends('layout.app')

@section('title', 'Home - Imperial Spice')
@section('active', 'home')

@push('styles')
<style>
    /* Menu Item Card Styling for Home Page */
    .menu-item-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
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
        flex-grow: 1;
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

    /* Testimonial card styling */
    .testimonial-card {
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-3px);
    }

    /* Hero section improvements */
    .hero-section {
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(0,0,0,0.6), rgba(0,0,0,0.3));
        z-index: 1;
    }

    .hero-section .container {
        position: relative;
        z-index: 2;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .menu-item-card .card-img-top {
            height: 180px;
        }
        
        .menu-item-card .card-body {
            padding: 1.25rem;
        }
        
        .display-3 {
            font-size: 2.5rem !important;
        }
    }

    /* Toast notification styles */
    .custom-toast {
        animation: slideInFromRight 0.3s ease-out;
    }

    @keyframes slideInFromRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
@endpush

@section('content')

    <section class="hero-section"
        style="background-image: url('{{ asset('assets/img/home.webp') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; height: 100vh; position: relative;">
        <div class="overlay"
            style="background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%; position: absolute; top: 0; left: 0;">
        </div>

        <div class="container h-100 position-relative z-1">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-3 fw-bold mb-4 text-white" data-aos="fade-up">
                        @lang('messages.hero_title')
                    </h1>
                    <p class="lead mb-4 text-white-50" data-aos="fade-up" data-aos-delay="100">
                        @lang('messages.hero_subtitle')
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ url('/booking') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-calendar-check me-2"></i>@lang('messages.book_a_table')
                        </a>
                        <a href="{{ url('/menu') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-book-open me-2"></i>@lang('messages.view_full_menu')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">@lang('messages.our_top_dishes')</h2>
                <p class="text-muted">@lang('messages.our_top_dishes_description')</p>
            </div>

            <div class="row g-4">
                @foreach ($dishes as $dish)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up">
                        <div class="card menu-item-card h-100">
                            <img src="{{ $dish->image ? asset($dish->image) : asset('assets/img/placeholder.jpg') }}" 
                                 class="card-img-top"
                                 alt="{{ $dish->name }}"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $dish->name }}</h5>
                                <p class="card-text text-muted small">{{ $dish->description }}</p>
                                <div class="price-section d-flex justify-content-between align-items-center">
                                    <span class="price">@lang('messages.currency'){{ number_format($dish->price, 2) }}</span>
                                    <button class="btn btn-sm btn-primary add-to-cart" data-id="{{ $dish->id }}">
                                        <i class="fas fa-plus me-1"></i>@lang('messages.add_to_cart')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ url('/menu') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-utensils me-2"></i>@lang('messages.view_full_menu')
                </a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="fw-bold mb-4">@lang('messages.unforgettable_dining_experience')</h2>
                    <p class="text-muted mb-4">@lang('messages.unforgettable_dining_experience_description')</p>
                    <div class="vstack gap-4">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-pepper-hot fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">@lang('messages.authentic_bold_flavors')</h6>
                                <p class="mb-0 text-muted small">@lang('messages.authentic_bold_flavors_desc')</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-gem fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">@lang('messages.elegant_inviting_ambiance')</h6>
                                <p class="mb-0 text-muted small">@lang('messages.elegant_inviting_ambiance_desc')</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-star fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">@lang('messages.impeccable_service')</h6>
                                <p class="mb-0 text-muted small">@lang('messages.impeccable_service_desc')</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="{{ asset('assets/img/whyus.webp') }}" class="img-fluid"
                        style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);" alt="Restaurant Ambiance">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">@lang('messages.what_our_customers_say')</h2>
                <p class="text-muted">@lang('messages.our_customers_say_description')</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="testimonial-card card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="mb-4"><em>@lang('messages.testimonial_1')</em></p>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-bold">@lang('messages.testimonial_1_author')</h6>
                                    <small class="text-muted">@lang('messages.testimonial_1_author_role')</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="mb-4"><em>@lang('messages.testimonial_2')</em></p>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-bold">@lang('messages.testimonial_2_author')</h6>
                                    <small class="text-muted">@lang('messages.testimonial_2_author_role')</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-4"><em>@lang('messages.testimonial_3')</em></p>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-bold">@lang('messages.testimonial_3_author')</h6>
                                    <small class="text-muted">@lang('messages.testimonial_3_author_role')</small>
                                </div>
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
                toast.className = `custom-toast alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} 
                                  position-fixed`;
                toast.style.cssText = `
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 300px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    border-radius: 8px;
                `;
                toast.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                        <span>${message}</span>
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
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Adding...';

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
                        console.log('Cart response:', data);
                        
                        if (data.success) {
                            // Success - show confirmation
                            this.innerHTML = '<i class="fas fa-check me-1"></i>Added!';
                            this.classList.replace('btn-primary', 'btn-success');

                            // Update cart count in header
                            if (data.cart_count !== undefined) {
                                updateCartCount(data.cart_count);
                            }

                            // Show success notification
                            showToast('Item added to cart successfully!', 'success');

                            // Reset button after 2 seconds
                            setTimeout(() => {
                                this.innerHTML = originalText;
                                this.classList.replace('btn-success', 'btn-primary');
                                this.disabled = false;
                            }, 2000);
                        } else {
                            throw new Error(data.message || 'Failed to add item to cart');
                        }
                    })
                    .catch(error => {
                        console.error('Cart error:', error);
                        
                        if (error.message.includes('401') || error.message.includes('Unauthenticated')) {
                            this.innerHTML = '<i class="fas fa-exclamation me-1"></i>Login Required';
                            showToast('Please log in to add items to the cart.', 'error');
                        } else {
                            this.innerHTML = '<i class="fas fa-exclamation me-1"></i>Error';
                            showToast('Error adding item to cart', 'error');
                        }
                        
                        this.classList.replace('btn-primary', 'btn-danger');
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.classList.replace('btn-danger', 'btn-primary');
                            this.disabled = false;
                        }, 3000);
                    });
                });
            });
        });
    </script>

@endsection
