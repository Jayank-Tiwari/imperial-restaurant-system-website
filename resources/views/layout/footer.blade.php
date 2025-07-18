
    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-utensils me-2"></i>Delicious Bites
                    </h5>
                    <p>Experience culinary excellence in the heart of the city. We serve the finest dishes with passion and dedication.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="index.html" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="about.html" class="text-white-50 text-decoration-none">About</a></li>
                        <li><a href="menu.html" class="text-white-50 text-decoration-none">Menu</a></li>
                        <li><a href="booking.html" class="text-white-50 text-decoration-none">Reservations</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3">
                    <h6 class="fw-bold mb-3">Contact Info</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>123 Gourmet Street, Food City</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>(555) 123-4567</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@deliciousbites.com</li>
                    </ul>
                </div>
                
                <div class="col-lg-3">
                    <h6 class="fw-bold mb-3">Opening Hours</h6>
                    <ul class="list-unstyled">
                        <li class="mb-1">Mon - Thu: 11:00 AM - 10:00 PM</li>
                        <li class="mb-1">Fri - Sat: 11:00 AM - 11:00 PM</li>
                        <li class="mb-1">Sunday: 12:00 PM - 9:00 PM</li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Delicious Bites. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);

        // Set maximum date to 30 days from today
        const maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 30);
        document.getElementById('date').setAttribute('max', maxDate.toISOString().split('T')[0]);

        // Update cart count
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            document.getElementById('cartCount').textContent = cart.length;
        }

        // Initialize cart count
        updateCartCount();
    </script>
</body>
</html>
