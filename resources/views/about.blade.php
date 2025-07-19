 @extends('layout.app')

 @section('title', 'About - Imperial Spice')
 @section('active', 'about')

 @section('content')

     <section class="py-5 mt-5" style="background-color: var(--gray-light);">
         <div class="container">
             <div class="text-center">
                 <h1 class="display-4 fw-bold" style="color: var(--secondary-color);">Our Culinary Journey</h1>
                 <p class="lead text-muted">Discover our story, meet our team, and learn about our passion for culinary
                     excellence.</p>
             </div>
         </div>
     </section>


     <section class="py-5 position-relative">
         <div class="floating-decoration decoration-2" style="opacity: 0.05;"></div>
         <div class="container">
             <div class="row align-items-center g-5">
                 <div class="col-lg-6" data-aos="fade-right">
                     <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=774&q=80"
                         class="img-fluid" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);"
                         alt="Restaurant Interior">
                 </div>
                 <div class="col-lg-6" data-aos="fade-left">
                     <h2 class="fw-bold mb-4" style="color: var(--secondary-color);">From a Simple Dream to a Culinary
                         Destination</h2>
                     <p class="mb-4 text-secondary">Founded in 2015, Delicious Bites began as a dream to create an
                         extraordinary dining experience. What started in a small kitchen has blossomed into a beloved
                         local gem, known for our commitment to quality, innovation, and a welcoming atmosphere.</p>
                     <p class="mb-4">We believe great food connects people. That's why we pour our hearts into every
                         dish, using only the freshest, locally-sourced ingredients to craft meals that are both
                         comforting and exciting.</p>
                     <div class="d-flex gap-4">
                         <div class="text-center">
                             <i class="fas fa-award fs-2 mb-2" style="color: var(--primary-color);"></i>
                             <h5 class="fw-bold mb-0">Award Winning</h5>
                             <p class="text-muted small">Best Restaurant 2023</p>
                         </div>
                         <div class="text-center">
                             <i class="fas fa-users fs-2 mb-2" style="color: var(--primary-color);"></i>
                             <h5 class="fw-bold mb-0">50,000+</h5>
                             <p class="text-muted small">Happy Customers</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>


     <section class="py-5" style="background-color: var(--gray-light);">
         <div class="container">
             <div class="text-center mb-5">
                 <h2 class="fw-bold">The Pillars of Our Kitchen</h2>
                 <p class="text-muted">What drives us to deliver excellence every single day.</p>
             </div>
             <div class="row g-4 text-center">
                 <div class="col-md-4" data-aos="fade-up">
                     <div class="card p-4 h-100">
                         <i class="fas fa-leaf fs-1 mb-3 mx-auto" style="color: var(--secondary-color);"></i>
                         <h5 class="fw-bold">Fresh & Sustainable</h5>
                         <p class="mb-0">We are committed to using the freshest ingredients, sourced responsibly from
                             local farmers to ensure peak flavor and support our community.</p>
                     </div>
                 </div>
                 <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                     <div class="card p-4 h-100">
                         <i class="fas fa-heart fs-1 mb-3 mx-auto" style="color: var(--primary-color);"></i>
                         <h5 class="fw-bold">Made with Passion</h5>
                         <p class="mb-0">Every dish is a work of art, prepared with meticulous attention to detail
                             and a deep-rooted passion for the culinary arts.</p>
                     </div>
                 </div>
                 <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                     <div class="card p-4 h-100">
                         <i class="fas fa-handshake-angle fs-1 mb-3 mx-auto" style="color: var(--secondary-color);"></i>
                         <h5 class="fw-bold">Warm Hospitality</h5>
                         <p class="mb-0">We believe a great meal is an experience. Our team is dedicated to providing
                             warm, friendly service that makes you feel right at home.</p>
                     </div>
                 </div>
             </div>
         </div>
     </section>


     <section class="py-5 position-relative">
         <div class="floating-decoration decoration-1" style="opacity: 0.05;"></div>
         <div class="container">
             <div class="text-center mb-5">
                 <h2 class="fw-bold">The Talent Behind the Taste</h2>
                 <p class="text-muted">Meet the creative minds who bring our culinary vision to life.</p>
             </div>
             <div class="row g-4 justify-content-center">
                 <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                     <div class="card text-center p-4">
                         <img src="/placeholder.svg?height=150&width=150" class="rounded-circle mb-3 mx-auto"
                             alt="Executive Chef" style="border: 4px solid var(--primary-color);">
                         <h5 class="card-title fw-bold">Chef Marco Rodriguez</h5>
                         <p class="mb-3" style="color: var(--primary-color); font-weight: 600;">Executive Chef</p>
                         <p class="card-text text-muted small">With 15+ years in fine dining, Chef Marco's fusion
                             cuisine is the heart of our menu, blending tradition with bold innovation.</p>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                     <div class="card text-center p-4">
                         <img src="/placeholder.svg?height=150&width=150" class="rounded-circle mb-3 mx-auto"
                             alt="Pastry Chef" style="border: 4px solid var(--primary-color);">
                         <h5 class="card-title fw-bold">Chef Sarah Kim</h5>
                         <p class="mb-3" style="color: var(--primary-color); font-weight: 600;">Pastry Chef</p>
                         <p class="card-text text-muted small">Sarah's artistic desserts are legendary. Each sweet
                             creation is a perfect, delightful end to your dining experience.</p>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                     <div class="card text-center p-4">
                         <img src="/placeholder.svg?height=150&width=150" class="rounded-circle mb-3 mx-auto"
                             alt="Sous Chef" style="border: 4px solid var(--primary-color);">
                         <h5 class="card-title fw-bold">Chef David Thompson</h5>
                         <p class="mb-3" style="color: var(--primary-color); font-weight: 600;">Sous Chef</p>
                         <p class="card-text text-muted small">David's expertise in Mediterranean flavors and his
                             commitment to quality ensures every plate is consistently exceptional.</p>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <section class="py-5" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
         <div class="container text-center text-white">
             <h2 class="display-5 fw-bold mb-3">Ready to Join Us?</h2>
             <p class="lead mb-4">Experience the flavors, the passion, and the hospitality for yourself.</p>
             <a href="booking.html" class="btn btn-light text-primary fw-bold"
                 style="padding: 14px 40px; border-radius: 50px;">
                 <i class="fas fa-calendar-alt me-2"></i>Book Your Table Now
             </a>
         </div>
     </section>




     <script>
         // JS to update cart count (from your old file)
         function updateCartCount() {
             const cart = JSON.parse(localStorage.getItem('cart') || '[]');
             document.getElementById('cartCount').textContent = cart.length;
         }
         updateCartCount();
     </script>
     <script>
         AOS.init({
             duration: 800,
             once: true
         });
     </script>



 @endsection
