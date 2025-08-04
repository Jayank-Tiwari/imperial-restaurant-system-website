<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{asset ('assets/css/style.css')}}" rel="stylesheet">
     @stack('styles')
</head>
<body>
    @include('layout.header')

    @yield('content')


    {{-- Footer --}}
    @include('layout.footer')

<script>
// Global cart count updater
window.updateCartCount = function(count) {
    console.log('Global updateCartCount called with:', count);
    
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
        
        // Animation
        cartCountElement.style.transform = 'scale(1.3)';
        cartCountElement.style.transition = 'transform 0.2s ease';
        
        setTimeout(() => {
            cartCountElement.style.transform = 'scale(1)';
        }, 200);
        
        return true;
    }
    
    console.warn('Cart count element not found');
    return false;
};

// Ensure DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, cart element:', document.getElementById('cart-count'));
});
</script>
</body>
</html>