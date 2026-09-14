import os

filepath = 'resources/views/about.blade.php'

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Fix 1: Remove background-attachment: fixed which causes massive viewport scaling bugs on iOS Safari
content = content.replace('background-attachment: fixed;', '/* background-attachment: fixed removed for mobile compatibility */')

# Fix 2: Just in case, add html { overflow-x: hidden } to the responsive CSS block
css_target = """        @media screen and (max-width: 768px) {"""
css_replacement = """        html, body { overflow-x: hidden; width: 100%; position: relative; }
        @media screen and (max-width: 768px) {"""
content = content.replace(css_target, css_replacement)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("iOS fixed attachment bug removed and overflow safeguarded.")
