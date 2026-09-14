@extends('layout.app')

@section('title', 'About - Imperial Spice')
@section('active', 'about')

@push('styles')
    <style>
        :root {
            --primary-orange: #d35400;
            --soft-orange: #fff3ec;
        }

        /* --- Global & Typography --- */
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

        .section-title-left {
            font-weight: 800;
            font-size: 2.5rem;
            color: #2d3436;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title-left::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary-orange);
            border-radius: 2px;
        }

        /* --- Hero Section --- */
        .about-hero {
            position: relative;
            background-image: url('{{ asset('assets/img/whyus.webp') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 120px 0 80px;
            min-height: 50vh;
            display: flex;
            align-items: center;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.5) 100%);
            z-index: 1;
        }

        .about-hero .container {
            position: relative;
            z-index: 2;
        }

        /* --- Premium Cards --- */
        .premium-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: none;
            transition: all 0.3s ease;
            height: 100%;
        }

        .premium-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(211, 84, 0, 0.1);
        }

        /* --- Stats Floating Boxes --- */
        .stat-box {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            text-align: center;
            border-bottom: 4px solid var(--primary-orange);
        }
        
        .stat-box:hover {
            transform: translateY(-5px);
        }

        /* --- Animated Counter --- */
        .counter-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-orange);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        /* --- Philosophy Icons --- */
        .philosophy-icon-box {
            width: 70px;
            height: 70px;
            background-color: var(--soft-orange);
            color: var(--primary-orange);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .premium-card:hover .philosophy-icon-box {
            background-color: var(--primary-orange);
            color: #fff;
            transform: rotateY(180deg);
        }

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
            background: var(--soft-orange);
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

        .timeline-container.left { left: 0; }
        .timeline-container.right { left: 50%; }

        .timeline-icon {
            position: absolute;
            width: 50px;
            height: 50px;
            right: -25px;
            background-color: #fff;
            border: 4px solid var(--primary-orange);
            top: 25px;
            border-radius: 50%;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(211, 84, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-orange);
            font-size: 1.2rem;
        }

        .timeline-container.right .timeline-icon { left: -25px; }

        .timeline-content {
            padding: 2rem;
            background-color: white;
            position: relative;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(211, 84, 0, 0.1);
        }

        .timeline-year {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--primary-orange);
            margin-bottom: 0.5rem;
            display: inline-block;
            background: var(--soft-orange);
            padding: 4px 12px;
            border-radius: 50px;
        }

        /* --- Gallery Styles --- */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            position: relative;
            height: 250px;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .gallery-item:hover img {
            transform: scale(1.15);
        }

        .gallery-item .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
            color: white;
            padding: 40px 20px 20px;
            font-weight: 700;
            font-size: 1.1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- CTA Section --- */
        .cta-section {
            background: linear-gradient(135deg, #d35400 0%, #e67e22 100%);
            position: relative;
            overflow: hidden;
            padding: 100px 0;
        }
        
        .cta-btn {
            background: #fff;
            color: #d35400;
            font-weight: 800;
            border-radius: 50px;
            padding: 1rem 2.5rem;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .cta-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            color: #d35400 !important;
            background-color: #fff !important;
        }

        .timeline-container.left .timeline-content { text-align: right; }
        .timeline-container.right .timeline-content { text-align: left; }

        @media screen and (max-width: 768px) {
            .display-3 { font-size: 2.2rem !important; }
            .display-4 { font-size: 1.8rem !important; }
            .section-title, .section-title-left { font-size: 2rem !important; }
            
            .timeline::after { left: 31px; }
            .timeline-container { width: 100%; padding-left: 70px; padding-right: 25px; }
            .timeline-container.right { left: 0%; }
            .timeline-container.left .timeline-icon, 
            .timeline-container.right .timeline-icon { left: 6px; }
            .timeline-container.left .timeline-content, 
            .timeline-container.right .timeline-content { text-align: left; }
        }
    </style>
@endpush


@section('content')
    {{-- Hero Section --}}
    <section class="about-hero text-center mt-5">
        <div class="container py-5" data-aos="fade-up">
            <h1 class="display-3 fw-bold text-white mb-3" style="letter-spacing: -1px;">@lang('messages.finest_indian_cuisine')</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 600px; font-size: 1.25rem;">@lang('messages.authentic_taste')</p>
        </div>
    </section>

    {{-- Our Story Section --}}
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="position-relative">
                        <img src="{{ asset('assets/img/about.webp') }}" class="img-fluid w-100"
                            style="border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);"
                            alt="The Imperial Spice Restaurant Interior">
                        <div class="position-absolute top-0 start-0 translate-middle p-3 bg-white rounded-circle shadow-lg d-none d-md-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="fas fa-leaf fa-3x" style="color: var(--primary-orange);"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                    <h2 class="section-title-left">@lang('messages.our_culinary_story')</h2>
                    <p class="mt-4 mb-3 text-secondary fs-5" style="line-height: 1.8;"><strong>The Imperial Spice</strong> @lang('messages.is_a_celebrated_indian_restaurant')</p>
                    <p class="mb-5 text-muted" style="line-height: 1.7;">@lang('messages.is_a_celebrated_indian_restaurant2')</p>
                    
                    <div class="d-flex flex-column flex-sm-row gap-4">
                        <div class="stat-box flex-fill">
                            <div class="counter-value" data-count="4">4</div>
                            <h6 class="fw-bold text-dark mb-1">@lang('messages.years_of_excellence')</h6>
                            <small class="text-muted fw-semibold text-uppercase">@lang('messages.serving_since') 2021</small>
                        </div>
                        <div class="stat-box flex-fill">
                            <div class="counter-value" data-count="10000">10000</div>
                            <h6 class="fw-bold text-dark mb-1">@lang('messages.happy_guests')</h6>
                            <small class="text-muted fw-semibold text-uppercase">@lang('messages.creating_memories')</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Philosophy Section --}}
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3" data-aos="fade-up">
                <h2 class="section-title">@lang('messages.our_philosophy')</h2>
                <p class="text-muted mt-3 fs-5">@lang('messages.our_philosophy_description')</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="premium-card">
                        <div class="philosophy-icon-box">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-3">@lang('messages.generational_recipes')</h4>
                        <p class="text-muted mb-0" style="line-height: 1.7;">@lang('messages.generational_recipes_description')</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="premium-card">
                        <div class="philosophy-icon-box">
                            <i class="fas fa-fire"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-3">@lang('messages.modern_interpretation')</h4>
                        <p class="text-muted mb-0" style="line-height: 1.7;">@lang('messages.modern_interpretation_description')</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="premium-card">
                        <div class="philosophy-icon-box">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-3">@lang('messages.warm_hospitality')</h4>
                        <p class="text-muted mb-0" style="line-height: 1.7;">@lang('messages.warm_hospitality_description')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Journey Timeline Section --}}
    <section class="py-5 bg-white position-relative" style="background-image: radial-gradient(#d35400 1px, transparent 1px); background-size: 40px 40px; background-position: 0 0; background-color: #ffffff;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.95)); z-index: 0;"></div>
        <div class="container py-5 position-relative z-1">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title bg-white px-4">@lang('messages.our_journey')</h2>
                <p class="text-muted mt-3 fs-5">@lang('messages.our_journey_description')</p>
            </div>
            <div class="timeline">
                <div class="timeline-container left position-relative z-1" data-aos="fade-right">
                    <div class="timeline-icon"><i class="fas fa-store"></i></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2021</div>
                        <h4 class="fw-bold text-dark mb-2">@lang('messages.grand_opening')</h4>
                        <p class="text-muted mb-0">@lang('messages.grand_opening_description')</p>
                    </div>
                </div>
                <div class="timeline-container right position-relative z-1" data-aos="fade-left">
                    <div class="timeline-icon"><i class="fas fa-utensils"></i></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2023</div>
                        <h4 class="fw-bold text-dark mb-2">@lang('messages.menu_expansion')</h4>
                        <p class="text-muted mb-0">@lang('messages.menu_expansion_description')</p>
                    </div>
                </div>
                <div class="timeline-container left position-relative z-1" data-aos="fade-right">
                    <div class="timeline-icon"><i class="fas fa-glass-cheers"></i></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2024</div>
                        <h4 class="fw-bold text-dark mb-2">@lang('messages.refreshed_ambiance')</h4>
                        <p class="text-muted mb-0">@lang('messages.refreshed_ambiance_description')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- The Team Section --}}
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title">@lang('messages.the_talent_behind_the_taste')</h2>
                <p class="text-muted mt-3 fs-5">@lang('messages.meet_the_creative_minds')</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                    <div class="premium-card text-center">
                        <div class="position-relative d-inline-block mb-4">
                            <img src="{{ asset('assets/img/chef.jpg') }}" class="rounded-circle shadow-sm"
                                alt="Executive Chef Diwan Singh" 
                                style="width: 160px; height: 160px; object-fit: cover; border: 5px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        </div>
                        <h4 class="fw-bold text-dark mb-1">Chef Diwan Singh</h4>
                        <p class="mb-3 text-uppercase small fw-bold" style="color: var(--primary-orange); letter-spacing: 1px;">@lang('messages.executive_chef')</p>
                        <p class="text-muted mb-4" style="line-height: 1.6;">@lang('messages.chef_rakesh_description')</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="premium-card text-center">
                        <div class="position-relative d-inline-block mb-4">
                            <img src="{{ asset('assets/img/manager.jpg') }}" class="rounded-circle shadow-sm"
                                alt="Restaurant Manager Pawan Singh" 
                                style="width: 160px; height: 160px; object-fit: cover; border: 5px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        </div>
                        <h4 class="fw-bold text-dark mb-1">Mr. Pawan Singh</h4>
                        <p class="mb-3 text-uppercase small fw-bold" style="color: var(--primary-orange); letter-spacing: 1px;">@lang('messages.restaurant_manager')</p>
                        <p class="text-muted mb-4" style="line-height: 1.6;">@lang('messages.mr_singh_description')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Section --}}
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title">@lang('messages.glimpses_of_the_imperial_spice')</h2>
                <p class="text-muted mt-3 fs-5">@lang('messages.a_taste_of_the_experience')</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item" data-aos="fade-up">
                    <img src="{{ asset('assets/img/gallery.webp') }}" alt="Happy guests outside the restaurant" loading="lazy">
                    <div class="overlay">@lang('messages.welcoming_our_guests')</div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/img/dinin.webp') }}" alt="Guests enjoying a group dinner" loading="lazy">
                    <div class="overlay">@lang('messages.a_shared_dining_experience')</div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('assets/img/about.webp') }}" alt="A group celebration at The Imperial Spice" loading="lazy">
                    <div class="overlay">@lang('messages.creating_lasting_memories')</div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="300">
                    <img src="{{ asset('assets/img/whyus.webp') }}" alt="Friends dining together at our restaurant" loading="lazy">
                    <div class="overlay">@lang('messages.good_food_great_company')</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title">@lang('messages.words_from_our_guests')</h2>
                <p class="text-muted mt-3 fs-5">@lang('messages.dont_just_take_our_word')</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="premium-card text-center position-relative">
                        <i class="fas fa-quote-left fs-1 mb-4" style="color: var(--soft-orange); opacity: 0.8; position: absolute; top: 20px; left: 30px; z-index: 0;"></i>
                        <div class="position-relative z-1">
                            <div class="mb-3" style="color: var(--primary-orange);">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4" style="line-height: 1.7;">@lang('messages.testimonial_4')</p>
                            <h6 class="fw-bold text-dark mb-1">@lang('messages.testimonial_4_author')</h6>
                            <small class="text-muted fw-semibold">@lang('messages.google_review')</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="premium-card text-center position-relative">
                        <i class="fas fa-quote-left fs-1 mb-4" style="color: var(--soft-orange); opacity: 0.8; position: absolute; top: 20px; left: 30px; z-index: 0;"></i>
                        <div class="position-relative z-1">
                            <div class="mb-3" style="color: var(--primary-orange);">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4" style="line-height: 1.7;">@lang('messages.testimonial_5')</p>
                            <h6 class="fw-bold text-dark mb-1">@lang('messages.testimonial_5_author')</h6>
                            <small class="text-muted fw-semibold">@lang('messages.anniversary_dinner')</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="premium-card text-center position-relative">
                        <i class="fas fa-quote-left fs-1 mb-4" style="color: var(--soft-orange); opacity: 0.8; position: absolute; top: 20px; left: 30px; z-index: 0;"></i>
                        <div class="position-relative z-1">
                            <div class="mb-3" style="color: var(--primary-orange);">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4" style="line-height: 1.7;">@lang('messages.testimonial_6')</p>
                            <h6 class="fw-bold text-dark mb-1">@lang('messages.testimonial_6_author')</h6>
                            <small class="text-muted fw-semibold">@lang('messages.visitor_from_paris')</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="cta-section">
        <div class="container text-center text-white position-relative z-2">
            <h2 class="display-4 fw-bold mb-4 text-white" style="text-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                @lang('messages.reserve_your_experience')
            </h2>
            <p class="lead mb-5 mx-auto" style="max-width: 600px; color: rgba(255,255,255,0.9);">
                @lang('messages.book_your_table_2')
            </p>
            <a href="{{ url('/booking') }}" class="btn cta-btn">
                <i class="fas fa-calendar-check me-2"></i> @lang('messages.book_your_table_now')
            </a>
        </div>
    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll('.counter-value');
            const speed = 50; 

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        counter.innerText = '0'; // start from 0 when JS kicks in
                        
                        const updateCount = () => {
                            const target = +counter.getAttribute('data-count');
                            const count = +counter.innerText;
                            const increment = Math.ceil(target / speed);

                            if (count < target) {
                                counter.innerText = Math.min(count + increment, target);
                                setTimeout(updateCount, 40);
                            } else {
                                counter.innerText = target.toLocaleString() + (target >= 10000 ? '+' : '');
                            }
                        };
                        updateCount();
                        observer.unobserve(counter); 
                    }
                });
            }, {
                threshold: 0.1 
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endsection

