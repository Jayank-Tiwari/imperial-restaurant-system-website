@extends('layout.app')

@section('title', 'Home - Imperial Spice')
@section('active', 'home')

@section('content')

    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h1 class="display-3 fw-bold mb-4 text-white" data-aos="fade-up">
                        A Symphony of Spices, A Culinary Masterpiece
                    </h1>
                    <p class="lead mb-4 text-white-50" data-aos="fade-up" data-aos-delay="100">
                        Indulge in an unforgettable dining experience where traditional flavors meet contemporary elegance.
                        Welcome to Imperial Spice.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ url('/booking') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-calendar-check me-2"></i>Book Your Table
                        </a>
                        <a href="{{ url('/menu') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-book-open me-2"></i>Explore Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">Our Signature Creations</h2>
                <p class="text-muted">A selection of our most loved and highly recommended dishes.</p>
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
                                        style="color: var(--primary-color);">₹{{ number_format($dish->price, 2) }}</span>

                                    {{-- The button already has the required data-id --}}
                                    <button class="btn btn-sm btn-primary add-to-cart" data-id="{{ $dish->id }}">
                                        <i class="fas fa-plus me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ url('/menu') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-utensils me-2"></i>View The Full Menu
                </a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="fw-bold mb-4">An Unforgettable Dining Experience Awaits</h2>
                    <p class="text-muted mb-4">At Imperial Spice, we are dedicated to more than just food. We curate
                        experiences that delight the senses and create lasting memories. Here's what sets us apart:</p>
                    <div class="vstack gap-4">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-pepper-hot fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Authentic & Bold Flavors</h6>
                                <p class="mb-0 text-muted small">Our chefs masterfully blend traditional recipes with
                                    modern
                                    techniques to create uniquely flavorful dishes.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-gem fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Elegant & Inviting Ambiance</h6>
                                <p class="mb-0 text-muted small">Dine in a sophisticated yet comfortable setting, perfect
                                    for everything from intimate dinners to grand celebrations.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-star fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Impeccable Service</h6>
                                <p class="mb-0 text-muted small">Our attentive staff is dedicated to providing you with
                                    exceptional service, ensuring a seamless and enjoyable visit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80"
                        class="img-fluid" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);"
                        alt="Restaurant Ambiance">
                </div>
            </div>
        </div>
    </section>
    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">From Our Valued Guests</h2>
                <p class="text-muted">Don't just take our word for it. Here's what our diners have to say.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="testimonial-card card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="mb-4"><em>"Absolutely amazing! The food was exceptional and the service was
                                    impeccable. A true gem in the city. Will definitely be coming back!"</em></p>
                            <div class="d-flex align-items-center">
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3" alt="Customer">
                                <div>
                                    <h6 class="mb-0 fw-bold">Sarah Johnson</h6>
                                    <small class="text-muted">Food Blogger</small>
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
                            <p class="mb-4"><em>"The perfect venue for our anniversary dinner. The ambiance was romantic,
                                    and every dish was a masterpiece. Highly recommended!"</em></p>
                            <div class="d-flex align-items-center">
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3"
                                    alt="Customer">
                                <div>
                                    <h6 class="mb-0 fw-bold">Michael Chen</h6>
                                    <small class="text-muted">Regular Customer</small>
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
                            <p class="mb-4"><em>"The tasting menu is a must-try! A fantastic journey of flavors. The
                                    staff was incredibly knowledgeable and friendly."</em></p>
                            <div class="d-flex align-items-center">
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3"
                                    alt="Customer">
                                <div>
                                    <h6 class="mb-0 fw-bold">Emily Rodriguez</h6>
                                    <small class="text-muted">First-time Visitor</small>
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
            // --- ADD TO CART LOGIC (Synchronized with menu page) ---
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const menuItemId = this.dataset.id;
                    const originalButtonHtml = this.innerHTML;

                    if (!menuItemId) {
                        console.error('Menu item ID not found on the button!');
                        return;
                    }

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
                                // Check for authentication error
                                if (response.status === 401) {
                                    alert('Please log in to add items to your cart.');
                                    window.location.href =
                                    '{{ route('login') }}'; // Redirect to login page
                                } else {
                                    // Handle other server errors
                                    alert('An error occurred. Please try again later.');
                                }
                                throw new Error('Request failed with status ' + response
                                .status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            // UI feedback on success
                            this.innerHTML = '<i class="fas fa-check"></i> Added!';
                            this.classList.replace('btn-primary', 'btn-success');
                            this.disabled = true;

                            // Update navbar cart count if it exists and the data is returned
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
                            // Log detailed error to console without showing a generic alert
                            console.error('Cart error:', error.message);
                        });
                });
            });
        });
    </script>
@endsection