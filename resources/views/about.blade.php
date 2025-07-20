@extends('layout.app')

@section('title', 'About - Imperial Spice')
@section('active', 'about')

{{-- Add this section for page-specific styles --}}
@push('styles')
    <style>
        /* --- Timeline Styles --- */
        .timeline {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background: linear-gradient(var(--primary-color), var(--secondary-color));
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
            border-radius: 2px;
        }

        .timeline-container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        .timeline-container.left {
            left: 0;
        }

        .timeline-container.right {
            left: 50%;
        }

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: #fff;
            border: 4px solid var(--primary-color);
            top: 28px;
            border-radius: 50%;
            z-index: 1;
        }

        .timeline-container.right::after {
            left: -10px;
        }

        .timeline-content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .timeline-content h3 {
            color: var(--secondary-color);
            font-weight: 700;
        }

        .timeline-content .timeline-year {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        @media screen and (max-width: 768px) {
            .timeline::after {
                left: 31px;
            }

            .timeline-container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .timeline-container.right {
                left: 0%;
            }

            .timeline-container::after {
                left: 21px;
            }
        }

        /* --- Gallery Styles --- */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: white;
            padding: 30px 20px 15px;
            font-weight: 600;
            font-size: 1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: var(--transition);
        }

        .gallery-item:hover .overlay {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- Animated Counter --- */
        .counter-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
    </style>
@endpush


@section('content')
    {{-- Hero Section --}}
    <section class="py-5 mt-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 fw-bold" style="color: var(--secondary-color);">The Finest Indian Cuisine</h1>
                <p class="lead text-muted">A royal gastronomical adventure in the heart of New Delhi.</p>
            </div>
        </div>
    </section>

    {{-- Our Story Section --}}
    <section class="py-5 position-relative">
        <div class="floating-decoration decoration-2" style="opacity: 0.05;"></div>
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=774&q=80"
                        class="img-fluid" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);"
                        alt="The Imperial Spice Restaurant Interior">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="fw-bold mb-3" style="color: var(--secondary-color);">A Legacy of Royal Indian Dining</h2>
                    <p class="mb-3 text-secondary"><strong>The Imperial Spice</strong> is one of the most acclaimed fine
                        dining restaurants in Delhi, celebrated for taking guests on a unique gastronomical adventure. Our
                        menu is a tribute to culinary secrets passed down through generations, reimagined with a modern
                        twist.</p>
                    <p class="mb-4">We are dedicated to creating a "royal experience" for every guest, combining an
                        opulent ambiance with exquisite flavors and impeccable service. From live music to our signature
                        dishes, every detail is crafted for an unforgettable visit.</p>
                    <div class="d-flex gap-5">
                        <div class="text-center">
                            <div class="counter-value" data-count="8">0</div>
                            <h5 class="fw-bold mb-0">Years of Excellence</h5>
                            <p class="text-muted small">Serving since 2016</p>
                        </div>
                        <div class="text-center">
                            <div class="counter-value" data-count="80000">0</div>
                            <h5 class="fw-bold mb-0">Happy Guests</h5>
                            <p class="text-muted small">Creating memories</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Philosophy Section --}}
    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Our Philosophy</h2>
                <p class="text-muted">The principles that guide every dish we create.</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card p-4 h-100">
                        <i class="fas fa-scroll fs-1 mb-3 mx-auto" style="color: var(--secondary-color);"></i>
                        <h5 class="fw-bold">Generational Recipes</h5>
                        <p class="mb-0">We honor the culinary secrets passed down through generations, forming the
                            authentic soul of our menu.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card p-4 h-100">
                        <i class="fas fa-utensils fs-1 mb-3 mx-auto" style="color: var(--primary-color);"></i>
                        <h5 class="fw-bold">Modern Interpretation</h5>
                        <p class="mb-0">Our chefs skillfully apply modern techniques to traditional flavors, creating a
                            truly unique dining experience.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card p-4 h-100">
                        <i class="fas fa-concierge-bell fs-1 mb-3 mx-auto" style="color: var(--secondary-color);"></i>
                        <h5 class="fw-bold">Royal Hospitality</h5>
                        <p class="mb-0">We believe in service fit for royalty, ensuring every guest feels welcomed,
                            valued, and pampered from start to finish.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Journey Timeline Section --}}
    <section class="py-5 position-relative">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Our Journey</h2>
                <p class="text-muted">Key milestones that have shaped our story.</p>
            </div>
            <div class="timeline">
                <div class="timeline-container left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="timeline-year">2016</div>
                        <h3>Grand Opening in Connaught Place</h3>
                        <p>The Imperial Spice opens its doors, aiming to set a new standard for fine Indian dining in the
                            heart of Delhi.</p>
                    </div>
                </div>
                <div class="timeline-container right" data-aos="fade-left">
                    <div class="timeline-content">
                        <div class="timeline-year">2019</div>
                        <h3>Awarded for Excellence</h3>
                        <p>Honored with a prestigious award from the Ministry of Tourism, Govt. of India, recognizing our
                            culinary excellence.</p>
                    </div>
                </div>
                <div class="timeline-container left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="timeline-year">2022</div>
                        <h3>Introduction of Live Music</h3>
                        <p>We enhanced our royal ambiance by introducing nightly live music, creating an even more immersive
                            dining experience.</p>
                    </div>
                </div>
                <div class="timeline-container right" data-aos="fade-left">
                    <div class="timeline-content">
                        <div class="timeline-year">2024</div>
                        <h3>A Refreshed Ambiance</h3>
                        <p>We completed a renovation to further elevate our decor and guest comfort, solidifying our place
                            as a premier dining destination.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- The Team Section --}}
    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">The Talent Behind the Taste</h2>
                <p class="text-muted">Meet the creative minds who bring our culinary vision to life.</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                    <div class="card text-center p-4 h-100">
                        <img src="https://images.unsplash.com/photo-1583394293214-28ded15ee548?auto=format&fit=crop&w=150&h=150&q=80"
                            class="rounded-circle mb-3 mx-auto" alt="Executive Chef Rakesh"
                            style="border: 4px solid var(--primary-color);">
                        <h5 class="card-title fw-bold">Chef Rakesh</h5>
                        <p class="mb-2" style="color: var(--primary-color); font-weight: 600;">Executive Chef</p>
                        <p class="card-text text-muted small mb-3">With 20 years of experience, Chef Rakesh is the heart of
                            our kitchen. His philosophy, "Simplicity is the ultimate sophistication," shines through in
                            every dish.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="text-secondary"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-secondary"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card text-center p-4 h-100">
                        <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?auto=format&fit=crop&w=150&h=150&q=80"
                            class="rounded-circle mb-3 mx-auto" alt="Restaurant Manager"
                            style="border: 4px solid var(--primary-color);">
                        <h5 class="card-title fw-bold">Mr. Singh</h5>
                        <p class="mb-2" style="color: var(--primary-color); font-weight: 600;">Restaurant Manager</p>
                        <p class="card-text text-muted small mb-3">Mr. Singh orchestrates our front-of-house, ensuring that
                            every guest receives the seamless, royal hospitality that defines The Imperial Spice.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="text-secondary"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-secondary"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card text-center p-4 h-100">
                        <img src="https://images.unsplash.com/photo-1600275892312-1f44359403a4?auto=format&fit=crop&w=150&h=150&q=80"
                            class="rounded-circle mb-3 mx-auto" alt="Mixologist"
                            style="border: 4px solid var(--primary-color);">
                        <h5 class="card-title fw-bold">Priya Sharma</h5>
                        <p class="mb-2" style="color: var(--primary-color); font-weight: 600;">Head Mixologist</p>
                        <p class="card-text text-muted small mb-3">As the curator of our bar, Priya crafts inventive
                            cocktails that complement our cuisine and elevate your dining experience.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="text-secondary"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Section --}}
    <section class="py-5 position-relative">
        <div class="floating-decoration decoration-1" style="opacity: 0.05;"></div>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Glimpses of The Imperial Spice</h2>
                <p class="text-muted">A taste of the experience that awaits you.</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item" data-aos="fade-up"><img
                        src="https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&w=600&q=80"
                        alt="Restaurant Ambiance">
                    <div class="overlay">The Royal Ambiance</div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100"><img
                        src="https://images.unsplash.com/photo-1565975239537-296537453393?auto=format&fit=crop&w=600&q=80"
                        alt="Indian Kebabs">
                    <div class="overlay">Artfully Plated Kebabs</div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="200"><img
                        src="https://images.unsplash.com/photo-1596797038539-2c995a9ab644?auto=format&fit=crop&w=600&q=80"
                        alt="Cocktails at the bar">
                    <div class="overlay">Our Signature Cocktails</div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="300"><img
                        src="https://images.unsplash.com/photo-1549488344-cbb6c34cf08b?auto=format&fit=crop&w=600&q=80"
                        alt="Live Music">
                    <div class="overlay">An Evening with Live Music</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Words from Our Guests</h2>
                <p class="text-muted">Don't just take our word for it.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-quote-left fs-3 mb-3" style="color: var(--primary-light);"></i>
                            <p class="fst-italic">"The best fine dining experience in Connaught Place. The live music was
                                magical and the food was out of this world. Truly a royal treat!"</p>
                            <h6 class="fw-bold mt-4 mb-0">Rohan Mehta</h6>
                            <small class="text-muted">Google Review</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-quote-left fs-3 mb-3" style="color: var(--primary-light);"></i>
                            <p class="fst-italic">"We celebrated our anniversary here and it was perfect. The staff treated
                                us like royalty and every dish was an explosion of flavor."</p>
                            <h6 class="fw-bold mt-4 mb-0">Priya & Sameer Desai</h6>
                            <small class="text-muted">Anniversary Dinner</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-quote-left fs-3 mb-3" style="color: var(--primary-light);"></i>
                            <p class="fst-italic">"As a tourist, I wanted to taste authentic Indian food. The Imperial
                                Spice exceeded all expectations. A must-visit in Delhi."</p>
                            <h6 class="fw-bold mt-4 mb-0">Emily Carter</h6>
                            <small class="text-muted">Visitor from London</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-5" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
        <div class="container text-center text-white">
            <h2 class="display-5 fw-bold mb-3">Reserve Your Royal Experience</h2>
            <p class="lead mb-4">Book your table and let us transport you on a culinary journey you won't forget.</p>
            <a href="{{ url('/booking') }}" class="btn btn-light text-primary fw-bold"
                style="padding: 14px 40px; border-radius: 50px;">
                <i class="fas fa-calendar-alt me-2"></i>Book Your Table Now
            </a>
        </div>
    </section>

@endsection

@push('scripts')
    {{-- Existing Scripts --}}
    <script>
        // JS to update cart count (from your old file)
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const cartCountEl = document.getElementById('cartCount');
            if (cartCountEl) {
                cartCountEl.textContent = cart.length;
            }
        }
        updateCartCount();

        AOS.init({
            duration: 800,
            once: true
        });
    </script>

    {{-- NEW SCRIPT for Animated Counters --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll('.counter-value');
            const speed = 200; // The lower the slower

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const updateCount = () => {
                            const target = +counter.getAttribute('data-count');
                            const count = +counter.innerText;
                            const increment = Math.ceil(target / speed);

                            if (count < target) {
                                counter.innerText = Math.min(count + increment, target);
                                setTimeout(updateCount, 15);
                            } else {
                                counter.innerText = target.toLocaleString() + (target >= 50000 ?
                                    '+' : '');
                            }
                        };
                        updateCount();
                        observer.unobserve(counter); // Stop observing after animation
                    }
                });
            }, {
                threshold: 0.5 // Trigger when 50% of the element is visible
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endpush
