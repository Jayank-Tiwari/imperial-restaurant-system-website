<style>
    .premium-footer {
        background-color: #1a1a1a;
        color: #f8f9fa;
        padding: 5rem 0 2rem 0;
        font-size: 0.95rem;
    }

    .footer-brand {
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 1.5rem;
        display: inline-block;
    }

    .footer-brand i {
        color: #d35400;
        margin-right: 10px;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.05);
        color: #fff;
        border-radius: 50%;
        margin-right: 10px;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background-color: #d35400;
        color: #fff;
        transform: translateY(-3px);
    }

    .footer-heading {
        font-size: 1.1rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background-color: #d35400;
        border-radius: 2px;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        color: #adb5bd;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .footer-links a:hover {
        color: #d35400;
        padding-left: 5px;
    }

    .contact-info li {
        display: flex;
        margin-bottom: 1rem;
        color: #adb5bd;
    }

    .contact-info i {
        color: #d35400;
        margin-top: 4px;
        margin-right: 15px;
        font-size: 1.1rem;
    }

    .contact-info a {
        color: #adb5bd;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .contact-info a:hover {
        color: #d35400;
    }
    
    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 1.5rem;
        margin-top: 3rem;
        color: #6c757d;
        font-size: 0.9rem;
    }
</style>

<!-- Footer -->
<footer class="premium-footer">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <a href="{{ route('home') }}" class="footer-brand text-decoration-none">
                    <i class="fas fa-utensils"></i>Imperial Spice
                </a>
                <p class="text-white-50 mb-4 pe-lg-4" style="line-height: 1.7;">@lang('messages.experience_culinary_excellence')</p>

            </div>

            <div class="col-lg-2">
                <h6 class="footer-heading">@lang('messages.quick_links')</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}">@lang('messages.home')</a></li>
                    <li><a href="{{ route('about') }}">@lang('messages.about')</a></li>
                    <li><a href="{{ route('menu') }}">@lang('messages.menu')</a></li>
                    <li><a href="{{ route('booking') }}">@lang('messages.reservations')</a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h6 class="footer-heading">@lang('messages.contact_info')</h6>
                <ul class="list-unstyled contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Rambla de Josep Antoni Vidal 29, 08800 Vilanova i la Geltrú, Barcelona, Spain</span>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span><a href="tel:+34602189306">+34 602 18 93 06</a></span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span><a href="mailto:Imperialspice50@gmail.com">Imperialspice50@gmail.com</a></span>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h6 class="footer-heading">@lang('messages.opening_hours')</h6>
                <ul class="list-unstyled contact-info">
                    <li>
                        <i class="far fa-clock"></i>
                        <div>
                            <strong class="text-white d-block mb-1">@lang('messages.daily')</strong>
                            <span>12:30 PM - 4:30 PM</span>
                        </div>
                    </li>
                    <li>
                        <i class="far fa-moon"></i>
                        <div>
                            <strong class="text-white d-block mb-1">@lang('messages.evening')</strong>
                            <span>6:30 PM - 11:00 PM</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Imperial Spice. @lang('messages.copyright')</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Safe date picker logic (only executes if the #date element actually exists on the page)
        const dateInput = document.getElementById('date');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);

            const maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 30);
            dateInput.setAttribute('max', maxDate.toISOString().split('T')[0]);
        }

        // Update cart count from localstorage fallback if needed
        // Note: The cart count is mostly handled by the backend session now, 
        // this is just a fallback for client-side state if needed.
        function updateCartCount() {
            try {
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                const cartCountEl = document.getElementById('cartCount'); // older element id
                if (cartCountEl) {
                    cartCountEl.textContent = cart.length;
                }
            } catch (e) {
                console.warn('Error reading cart from localstorage');
            }
        }

        updateCartCount();
    });
</script>
