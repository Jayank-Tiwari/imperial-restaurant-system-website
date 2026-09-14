import os

filepath = 'resources/views/about.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Add responsive text alignment for left timeline items
css_target = """        @media screen and (max-width: 768px) {
            .timeline::after { left: 31px; }
            .timeline-container { width: 100%; padding-left: 70px; padding-right: 25px; }
            .timeline-container.right { left: 0%; }
            .timeline-container.left .timeline-icon, 
            .timeline-container.right .timeline-icon { left: 6px; }
        }"""
css_replacement = """        .timeline-container.left .timeline-content { text-align: right; }
        .timeline-container.right .timeline-content { text-align: left; }

        @media screen and (max-width: 768px) {
            .timeline::after { left: 31px; }
            .timeline-container { width: 100%; padding-left: 70px; padding-right: 25px; }
            .timeline-container.right { left: 0%; }
            .timeline-container.left .timeline-icon, 
            .timeline-container.right .timeline-icon { left: 6px; }
            .timeline-container.left .timeline-content, 
            .timeline-container.right .timeline-content { text-align: left; }
        }"""
content = content.replace(css_target, css_replacement)

# Remove hardcoded text-end classes
content = content.replace('<div class="timeline-content text-end">', '<div class="timeline-content">')

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("CSS text alignment fixed.")
