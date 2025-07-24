@extends('layout.app')

@section('title', 'Home - Imperial Spice')
@section('active', 'home')

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
                            <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top"
                                alt="{{ $dish->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $dish->name }}</h5>
                                <p class="card-text text-muted small flex-grow-1">{{ $dish->description }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
                                    <span class="h5 fw-bold mb-0"
                                        style="color: var(--primary-color);">@lang('messages.currency'){{ number_format($dish->price, 2) }}</span>

                                    {{-- The button already has the required data-id --}}
                                    <button class="btn btn-sm btn-primary add-to-cart" data-id="{{ $dish->id }}">
                                        @lang('messages.add_to_cart')
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
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3" alt="Customer">
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
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3"
                                    alt="Customer">
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
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3"
                                    alt="Customer">
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

                    fetch('{{ route('cart.add') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json', // Important for Laravel to know we expect a JSON response
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                menu_item_id: menuItemId,
                                quantity: 1
                            })
                        })
                        .then(response => {
                            // If the response is not OK (e.g., 401, 403, 500), handle it as an error
                            if (!response.ok) {
                                if (response.status === 401) { // 401 Unauthorized
                                    alert(@lang('messages.login_to_add_cart'));
                                    window.location.href = '{{ route('login') }}';
                                } else {
                                    // For other errors like 500 Internal Server Error
                                    alert(@lang('messages.something_went_wrong'));
                                }
                                // This makes the promise chain jump to the .catch() block
                                throw new Error(@lang('messages.something_went_wrong') + response
                                    .status);
                            }
                            // If the response is OK, proceed to parse it as JSON
                            return response.json();
                        })
                        .then(data => {
                            // This block only runs on a successful response (status 2xx)
                            this.innerHTML = '<i class="fas fa-check"></i> Added!';
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
                            // This will catch network errors or the error thrown from the !response.ok check
                            console.error(@lang('messages.something_went_wrong'), error.message);

                            // Re-enable the button if an error occurred so the user can try again
                            this.disabled = false;
                        });
                });
            });
        });
    </script>

@endsection
