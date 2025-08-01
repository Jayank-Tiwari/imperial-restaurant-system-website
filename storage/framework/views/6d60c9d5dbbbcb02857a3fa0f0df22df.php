

<?php $__env->startSection('title', 'About - Imperial Spice'); ?>
<?php $__env->startSection('active', 'about'); ?>


<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    
    <section class="py-5 mt-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 fw-bold" style="color: var(--secondary-color);"><?php echo app('translator')->get('messages.finest_indian_cuisine'); ?></h1>
                <p class="lead text-muted"><?php echo app('translator')->get('messages.authentic_taste'); ?></p>
            </div>
        </div>
    </section>

    
    <section class="py-5 position-relative">
        <div class="floating-decoration decoration-2" style="opacity: 0.05;"></div>
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="<?php echo e(asset('assets/img/about.webp')); ?>" class="img-fluid"
                        style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);"
                        alt="The Imperial Spice Restaurant Interior">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="fw-bold mb-3" style="color: var(--secondary-color);"><?php echo app('translator')->get('messages.our_culinary_story'); ?></h2>
                    <p class="mb-3 text-secondary"><strong>The Imperial Spice</strong> <?php echo app('translator')->get('messages.is_a_celebrated_indian_restaurant'); ?></p>
                    <p class="mb-4"><?php echo app('translator')->get('messages.is_a_celebrated_indian_restaurant2'); ?></p>
                    <div class="d-flex gap-5">
                        <div class="text-center">
                            
                            <div class="counter-value" data-count="4">4</div>
                            <h5 class="fw-bold mb-0"><?php echo app('translator')->get('messages.years_of_excellence'); ?></h5>
                            <p class="text-muted small"><?php echo app('translator')->get('messages.serving_since'); ?> 2021</p>
                        </div>
                        <div class="text-center">
                            <div class="counter-value" data-count="10000">10000</div>
                            <h5 class="fw-bold mb-0"><?php echo app('translator')->get('messages.happy_guests'); ?></h5>
                            <p class="text-muted small"><?php echo app('translator')->get('messages.creating_memories'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold"><?php echo app('translator')->get('messages.our_philosophy'); ?></h2>
                <p class="text-muted"><?php echo app('translator')->get('messages.our_philosophy_description'); ?></p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card p-4 h-100">
                        <i class="fas fa-scroll fs-1 mb-3 mx-auto" style="color: var(--secondary-color);"></i>
                        <h5 class="fw-bold"><?php echo app('translator')->get('messages.generational_recipes'); ?></h5>
                        <p class="mb-0"><?php echo app('translator')->get('messages.generational_recipes_description'); ?></p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card p-4 h-100">
                        <i class="fas fa-utensils fs-1 mb-3 mx-auto" style="color: var(--primary-color);"></i>
                        <h5 class="fw-bold"><?php echo app('translator')->get('messages.modern_interpretation'); ?></h5>
                        <p class="mb-0"><?php echo app('translator')->get('messages.modern_interpretation_description'); ?></p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card p-4 h-100">
                        <i class="fas fa-concierge-bell fs-1 mb-3 mx-auto" style="color: var(--secondary-color);"></i>
                        <h5 class="fw-bold"><?php echo app('translator')->get('messages.warm_hospitality'); ?></h5>
                        <p class="mb-0"><?php echo app('translator')->get('messages.warm_hospitality_description'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5 position-relative">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold"><?php echo app('translator')->get('messages.our_journey'); ?></h2>
                <p class="text-muted"><?php echo app('translator')->get('messages.our_journey_description'); ?></p>
            </div>
            <div class="timeline">
                <div class="timeline-container left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="timeline-year">2021</div>
                        <h3><?php echo app('translator')->get('messages.grand_opening'); ?></h3>
                        <p><?php echo app('translator')->get('messages.grand_opening_description'); ?></p>
                    </div>
                </div>
                <div class="timeline-container right" data-aos="fade-left">
                    <div class="timeline-content">
                        <div class="timeline-year">2023</div>
                        <h3><?php echo app('translator')->get('messages.menu_expansion'); ?></h3>
                        <p><?php echo app('translator')->get('messages.menu_expansion_description'); ?></p>
                    </div>
                </div>
                <div class="timeline-container left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="timeline-year">2024</div>
                        <h3><?php echo app('translator')->get('messages.refreshed_ambiance'); ?></h3>
                        <p><?php echo app('translator')->get('messages.refreshed_ambiance_description'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold"><?php echo app('translator')->get('messages.the_talent_behind_the_taste'); ?></h2>
                <p class="text-muted"><?php echo app('translator')->get('messages.meet_the_creative_minds'); ?></p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                    <div class="card text-center p-4 h-100">
                        <img src="<?php echo e(asset('assets/img/chef.jpg')); ?>" class="rounded-circle mb-3 mx-auto"
                            alt="Executive Chef Diwan Singh" 
                            style="border: 4px solid var(--primary-color); width: 150px; height: 150px; object-fit: cover;">
                        <h5 class="card-title fw-bold">Chef Diwan Singh</h5>
                        <p class="mb-2" style="color: var(--primary-color); font-weight: 600;"><?php echo app('translator')->get('messages.executive_chef'); ?></p>
                        <p class="card-text text-muted small mb-3"><?php echo app('translator')->get('messages.chef_rakesh_description'); ?></p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="text-secondary"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-secondary"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card text-center p-4 h-100">
                        <img src="<?php echo e(asset('assets/img/manager.jpg')); ?>" class="rounded-circle mb-3 mx-auto"
                            alt="Restaurant Manager Pawan Singh" 
                            style="border: 4px solid var(--primary-color); width: 150px; height: 150px; object-fit: cover;">
                        <h5 class="card-title fw-bold">Mr. Pawan Singh</h5>
                        <p class="mb-2" style="color: var(--primary-color); font-weight: 600;"><?php echo app('translator')->get('messages.restaurant_manager'); ?></p>
                        <p class="card-text text-muted small mb-3"><?php echo app('translator')->get('messages.mr_singh_description'); ?></p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="text-secondary"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-secondary"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5 position-relative">
        <div class="floating-decoration decoration-1" style="opacity: 0.05;"></div>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold"><?php echo app('translator')->get('messages.glimpses_of_the_imperial_spice'); ?></h2>
                <p class="text-muted"><?php echo app('translator')->get('messages.a_taste_of_the_experience'); ?></p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item" data-aos="fade-up"><img src="<?php echo e(asset('assets/img/gallery.webp')); ?>"
                        alt="Happy guests outside the restaurant">
                    <div class="overlay"><?php echo app('translator')->get('messages.welcoming_our_guests'); ?></div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100"><img
                        src="<?php echo e(asset('assets/img/dinin.webp')); ?>" alt="Guests enjoying a group dinner">
                    <div class="overlay"><?php echo app('translator')->get('messages.a_shared_dining_experience'); ?></div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="200"><img
                        src="<?php echo e(asset('assets/img/about.webp')); ?>" alt="A group celebration at The Imperial Spice">
                    <div class="overlay"><?php echo app('translator')->get('messages.creating_lasting_memories'); ?></div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="300"><img
                        src="<?php echo e(asset('assets/img/whyus.webp')); ?>" alt="Friends dining together at our restaurant">
                    <div class="overlay"><?php echo app('translator')->get('messages.good_food_great_company'); ?></div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5" style="background-color: var(--gray-light);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold"><?php echo app('translator')->get('messages.words_from_our_guests'); ?></h2>
                <p class="text-muted"><?php echo app('translator')->get('messages.dont_just_take_our_word'); ?></p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-quote-left fs-3 mb-3" style="color: var(--primary-light);"></i>
                            <p class="fst-italic"><?php echo app('translator')->get('messages.testimonial_4'); ?></p>
                            <h6 class="fw-bold mt-4 mb-0"><?php echo app('translator')->get('messages.testimonial_4_author'); ?></h6>
                            <small class="text-muted"><?php echo app('translator')->get('messages.google_review'); ?></small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-quote-left fs-3 mb-3" style="color: var(--primary-light);"></i>
                            <p class="fst-italic"><?php echo app('translator')->get('messages.testimonial_5'); ?></p>
                            <h6 class="fw-bold mt-4 mb-0"><?php echo app('translator')->get('messages.testimonial_5_author'); ?></h6>
                            <small class="text-muted"><?php echo app('translator')->get('messages.anniversary_dinner'); ?></small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-quote-left fs-3 mb-3" style="color: var(--primary-light);"></i>
                            <p class="fst-italic"><?php echo app('translator')->get('messages.testimonial_6'); ?></p>
                            <h6 class="fw-bold mt-4 mb-0"><?php echo app('translator')->get('messages.testimonial_6_author'); ?></h6>
                            <small class="text-muted"><?php echo app('translator')->get('messages.visitor_from_paris'); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5 position-relative overflow-hidden"
        style="background: linear-gradient(135deg, hsl(15, 100%, 55%), hsl(125, 45%, 30%));">
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.04\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); z-index: 1;">
        </div>

        <div class="container text-center text-white position-relative" style="z-index: 2;">
            <h2 class="display-5 fw-bold mb-3" style="color: #FFFFFF; text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">
                <?php echo app('translator')->get('messages.reserve_your_experience'); ?>
            </h2>
            <p class="lead mb-4" style="color: #f0f0f0; text-shadow: 1px 1px 5px rgba(0,0,0,0.5);">
                <?php echo app('translator')->get('messages.book_your_table_2'); ?>
            </p>
            <a href="<?php echo e(url('/booking')); ?>" class="btn btn-light fw-bold shadow-lg"
                style="padding: 14px 40px; border-radius: 50px; color: var(--secondary-color); transition: all 0.3s ease; transform: scale(1);">
                <i class="fas fa-calendar-alt me-2"></i><?php echo app('translator')->get('messages.book_your_table_now'); ?>
            </a>
        </div>
    </section>

    <style>
        .btn-light:hover {
            transform: scale(1.05) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
        }
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/about.blade.php ENDPATH**/ ?>