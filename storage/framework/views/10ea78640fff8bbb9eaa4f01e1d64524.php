<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-utensils me-2"></i>Imperial Spice
                </h5>
                <p><?php echo app('translator')->get('messages.experience_culinary_excellence'); ?></p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="col-lg-2">
                <h6 class="fw-bold mb-3"><?php echo app('translator')->get('messages.quick_links'); ?></h6>
                <ul class="list-unstyled">
                    <li><a href="<?php echo e(route('home')); ?>" class="text-white-50 text-decoration-none"><?php echo app('translator')->get('messages.home'); ?></a>
                    </li>
                    <li><a href="<?php echo e(route('about')); ?>" class="text-white-50 text-decoration-none"><?php echo app('translator')->get('messages.about'); ?></a>
                    </li>
                    <li><a href="<?php echo e(route('menu')); ?>" class="text-white-50 text-decoration-none"><?php echo app('translator')->get('messages.menu'); ?></a>
                    </li>
                    <li><a href="<?php echo e(route('booking')); ?>"
                            class="text-white-50 text-decoration-none"><?php echo app('translator')->get('messages.reservations'); ?></a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h6 class="fw-bold mb-3"><?php echo app('translator')->get('messages.contact_info'); ?></h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Rambla de Josep Antoni Vidal 29, 08800
                        Vilanova i la Geltrú, Barcelona, Spain</li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i>+34 602 18 93 06</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i>Imperialspice50@gmail.com</li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h6 class="fw-bold mb-3"><?php echo app('translator')->get('messages.opening_hours'); ?></h6>
                <ul class="list-unstyled">
                    <li class="mb-1"><?php echo app('translator')->get('messages.daily'); ?>: 12:30 PM - 4:30 PM</li>
                    <li class="mb-1"><?php echo app('translator')->get('messages.evening'); ?>: 6:30 PM - 11:00 PM</li>
                </ul>
            </div>
        </div>

        <hr class="my-4">

        <div class="text-center">
            <p class="mb-0"><?php echo app('translator')->get('messages.copyright'); ?></p>
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
<?php /**PATH D:\Imperial Spice\website\resources\views/layout/footer.blade.php ENDPATH**/ ?>