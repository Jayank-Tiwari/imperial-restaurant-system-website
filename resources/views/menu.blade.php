@extends('layout.app')

@section('title', 'Menu - Imperial Spice')
@section('active', 'menu')

@section('content')

<!-- Hero Section -->
<section class="py-5 mt-5" style="background-image: url('{{ asset('assets/img/menu-page.png') }}'); background-size: cover; background-position: center;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white">Our Menu</h1>
        <p class="lead text-white">Discover our carefully crafted dishes made with the finest ingredients</p>
    </div>
</section>

<!-- Filter Buttons -->
<section class="py-4 bg-white sticky-top shadow-sm">
    <div class="container text-center">
        <div class="btn-group" role="group" id="menuFilter">
            <button type="button" class="btn btn-outline-primary active" data-filter="all">All Items</button>
            @foreach($menuItems->keys() as $cat)
                <button type="button" class="btn btn-outline-primary" data-filter="{{ $cat }}">{{ ucfirst($cat) }}</button>
            @endforeach
        </div>
    </div>
</section>

<!-- Menu Items -->
<section class="py-5">
    <div class="container">
        <div class="row g-4" id="menuItems">
            @forelse($menuItems as $category => $items)
                @foreach($items as $item)
                    <div class="col-lg-4 col-md-6 menu-item" data-category="{{ $category }}" data-id="{{ $item->id }}">
                        <div class="card menu-item-card h-100">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('placeholder.svg') }}" class="card-img-top" alt="{{ $item->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text flex-grow-1">{{ $item->description }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="h5 text-primary mb-0">₹{{ number_format($item->price, 2) }}</span>
                                    <button class="btn btn-primary btn-sm add-to-cart">
                                        <i class="fas fa-plus me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @empty
                <p class="text-center text-muted">No menu items available.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Scripts -->
<script>
    // Filter functionality
    document.querySelectorAll('#menuFilter button').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelectorAll('#menuFilter button').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            document.querySelectorAll('.menu-item').forEach(item => {
                const match = filter === 'all' || item.dataset.category === filter;
                item.style.display = match ? 'block' : 'none';
                item.classList.toggle('fade-in', match);
            });
        });
    });

    // Add to cart via backend
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const itemDiv = this.closest('.menu-item');
            const menuItemId = itemDiv.dataset.id;

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
            .then(response => response.json())
            .then(data => {
                this.innerHTML = '<i class="fas fa-check me-1"></i>Added';
                this.classList.replace('btn-primary', 'btn-success');

                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-plus me-1"></i>Add to Cart';
                    this.classList.replace('btn-success', 'btn-primary');
                }, 2000);
            })
            .catch(error => {
                console.error('Cart error:', error);
                alert('Please log in to add items to the cart.');
            });
        });
    });

    // Animation
    const style = document.createElement('style');
    style.textContent = `
        .fade-in { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
</script>

@endsection
