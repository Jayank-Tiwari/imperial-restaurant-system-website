@extends('layout.app')

@section('title', 'Home - Imperial Spice')
@section('active', 'home')

@section('content')

    <!-- =================================================
    HERO SECTION
    ================================================== -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h1 class="display-3 fw-bold mb-4 text-white" data-aos="fade-up">
                        A Symphony of Spices, A Culinary Masterpiece
                    </h1>
                    <p class="lead mb-4 text-white-50" data-aos="fade-up" data-aos-delay="100">
                        Indulge in an unforgettable dining experience where traditional flavors meet contemporary elegance. Welcome to Imperial Spice.
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

    <!-- =================================================
    FEATURED DISHES SECTION
    ================================================== -->
    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">Our Signature Creations</h2>
                <p class="text-muted">A selection of our most loved and highly recommended dishes.</p>
            </div>
            
            <div class="row g-4">
                <!-- Dish 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="card menu-item-card h-100">
                        <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=774&q=80" class="card-img-top" alt="Grilled Salmon">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Royal Saffron Salmon</h5>
                            <p class="card-text text-muted small">Tender salmon fillet grilled to perfection, infused with saffron and served with a zesty citrus glaze.</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="h5 fw-bold mb-0" style="color: var(--primary-color);">$28.99</span>
                                <button class="btn btn-sm btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Dish 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card menu-item-card h-100">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&auto=format&fit=crop&w=880&q=80" class="card-img-top" alt="Beef Tenderloin">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Maharaja's Lamb Shank</h5>
                            <p class="card-text text-muted small">Slow-cooked lamb shank in a rich, aromatic gravy with exotic spices, served with garlic naan.</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="h5 fw-bold mb-0" style="color: var(--primary-color);">$35.99</span>
                                <button class="btn btn-sm btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Dish 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card menu-item-card h-100">
                        <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" class="card-img-top" alt="Lobster Risotto">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Emerald Paneer Tikka</h5>
                            <p class="card-text text-muted small">Creamy cottage cheese marinated in a vibrant mint and coriander pesto, chargrilled in a tandoor.</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="h5 fw-bold mb-0" style="color: var(--primary-color);">$22.99</span>
                                <button class="btn btn-sm btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ url('/menu') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-utensils me-2"></i>View The Full Menu
                </a>
            </div>
        </div>
    </section>

    <!-- =================================================
    WHY CHOOSE US SECTION
    ================================================== -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="fw-bold mb-4">An Unforgettable Dining Experience Awaits</h2>
                    <p class="text-muted mb-4">At Imperial Spice, we are dedicated to more than just food. We curate experiences that delight the senses and create lasting memories. Here's what sets us apart:</p>
                    <div class="vstack gap-4">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-pepper-hot fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Authentic & Bold Flavors</h6>
                                <p class="mb-0 text-muted small">Our chefs masterfully blend traditional recipes with modern techniques to create uniquely flavorful dishes.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-gem fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Elegant & Inviting Ambiance</h6>
                                <p class="mb-0 text-muted small">Dine in a sophisticated yet comfortable setting, perfect for everything from intimate dinners to grand celebrations.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-star fs-4 mt-1 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Impeccable Service</h6>
                                <p class="mb-0 text-muted small">Our attentive staff is dedicated to providing you with exceptional service, ensuring a seamless and enjoyable visit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" class="img-fluid" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);" alt="Restaurant Ambiance">
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================
    TESTIMONIALS SECTION
    ================================================== -->
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
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="mb-4"><em>"Absolutely amazing! The food was exceptional and the service was impeccable. A true gem in the city. Will definitely be coming back!"</em></p>
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
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="mb-4"><em>"The perfect venue for our anniversary dinner. The ambiance was romantic, and every dish was a masterpiece. Highly recommended!"</em></p>
                            <div class="d-flex align-items-center">
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3" alt="Customer">
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
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-4"><em>"The tasting menu is a must-try! A fantastic journey of flavors. The staff was incredibly knowledgeable and friendly."</em></p>
                            <div class="d-flex align-items-center">
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3" alt="Customer">
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

@endsection
