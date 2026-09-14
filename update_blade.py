import os

filepath = 'resources/views/welcome.blade.php'

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

replacements = {
    'Top Rated': "@lang('messages.top_rated')",
    'Explore Full Menu': "@lang('messages.explore_full_menu')",
    'Serving<br>Since': "@lang('messages.serving')<br>@lang('messages.since')",
    "showToast('Please log in to add items to the cart.', 'error');": "showToast('{{ __('messages.login_to_add_cart') }}', 'error');",
    "showToast('Added to cart successfully!', 'success');": "showToast('{{ __('messages.added_to_cart_success') }}', 'success');",
    "showToast('Error adding item to cart', 'error');": "showToast('{{ __('messages.error_adding_cart') }}', 'error');",
    "'<i class=\"fas fa-check me-1\"></i>Added'": "'<i class=\"fas fa-check me-1\"></i>{{ __('messages.added') }}'",
    "'<i class=\"fas fa-exclamation me-1\"></i>Login'": "'<i class=\"fas fa-exclamation me-1\"></i>{{ __('messages.login') }}'",
    "'<i class=\"fas fa-spinner fa-spin me-1\"></i>...'": "'<i class=\"fas fa-spinner fa-spin me-1\"></i>{{ __('messages.adding') }}'",
    '<i class="fas fa-shopping-basket me-1"></i> Add\n': '<i class="fas fa-shopping-basket me-1"></i> @lang(\'messages.cart\')\n'
}

for old, new in replacements.items():
    content = content.replace(old, new)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated blade file.")
