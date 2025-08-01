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
            // --- ADD TO CART LOGIC ---
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const menuItemId = this.dataset.id;
                    const originalButtonHtml = this.innerHTML;

                    // Immediately disable the button to prevent multiple clicks
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>@lang('messages.adding')...';

                    fetch('{{ route('cart.add') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                menu_item_id: menuItemId,
                                quantity: 1
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                if (response.status === 401) {
                                    alert('@lang('messages.login_to_add_cart')');
                                    window.location.href = '{{ route('login') }}';
                                } else {
                                    alert('@lang('messages.something_went_wrong')');
                                }
                                throw new Error('@lang('messages.something_went_wrong')' + response.status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            this.innerHTML = '<i class="fas fa-check me-1"></i>@lang('messages.added')!';
                            this.classList.replace('btn-primary', 'btn-success');

                            // Update the cart counter in the navbar
                            const cartCountElement = document.getElementById('cartCount');
                            if (cartCountElement && data.cartCount !== undefined) {
                                cartCountElement.textContent = data.cartCount;
                            }

                            // Revert button to original state after 2 seconds
                            setTimeout(() => {
                                this.innerHTML = originalButtonHtml;
                                this.classList.replace('btn-success', 'btn-primary');
                                this.disabled = false;
                            }, 2000);
                        })
                        .catch(error => {
                            console.error('@lang('messages.something_went_wrong')', error.message);
                            this.disabled = false;
                            this.innerHTML = originalButtonHtml;
                        });
                });
            });
        });
    </script>

@endsection
