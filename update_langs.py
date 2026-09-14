import os

en_file = 'resources/lang/en/messages.php'
es_file = 'resources/lang/es/messages.php'

def append_keys(filepath, keys_dict):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    last_bracket_idx = content.rfind('];')
    
    keys_str = '\n'
    for k, v in keys_dict.items():
        keys_str += f"    '{k}' => '{v}',\n"
        
    new_content = content[:last_bracket_idx] + keys_str + '\n' + content[last_bracket_idx:]
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(new_content)

en_keys = {
    'serving': 'Serving',
    'since': 'Since',
    'top_rated': 'Top Rated',
    'explore_full_menu': 'Explore Full Menu',
    'added_to_cart_success': 'Added to cart successfully!',
    'login_to_add_cart': 'Please log in to add items to the cart.',
    'error_adding_cart': 'Error adding item to cart',
}

es_keys = {
    'serving': 'Sirviendo',
    'since': 'Desde',
    'top_rated': 'Mejor Valorado',
    'explore_full_menu': 'Explorar Menú Completo',
    'added_to_cart_success': '¡Añadido al carrito con éxito!',
    'login_to_add_cart': 'Por favor, inicie sesión para añadir artículos al carrito.',
    'error_adding_cart': 'Error al añadir el artículo al carrito',
}

append_keys(en_file, en_keys)
append_keys(es_file, es_keys)
print('Keys added successfully.')
