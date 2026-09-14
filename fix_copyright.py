import os

en_file = 'resources/lang/en/messages.php'
es_file = 'resources/lang/es/messages.php'

def replace_in_file(filepath, old, new):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    content = content.replace(old, new)
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

replace_in_file(en_file, "'copyright' => '© 2024 Imperial Spice. All rights reserved.',", "'copyright' => 'All rights reserved.',")
replace_in_file(en_file, "'copyright' => 'Â© 2024 Imperial Spice. All rights reserved.',", "'copyright' => 'All rights reserved.',")

replace_in_file(es_file, "'copyright' => '© 2021 Imperial Spice. Todos los derechos reservados.',", "'copyright' => 'Todos los derechos reservados.',")
replace_in_file(es_file, "'copyright' => 'Â© 2021 Imperial Spice. Todos los derechos reservados.',", "'copyright' => 'Todos los derechos reservados.',")

print("Done")
