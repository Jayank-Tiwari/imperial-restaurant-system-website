import os

filepath = 'resources/views/about.blade.php'

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Add mobile typography styles
responsive_css = """        @media screen and (max-width: 768px) {
            .display-3 { font-size: 2.2rem !important; }
            .display-4 { font-size: 1.8rem !important; }
            .section-title, .section-title-left { font-size: 2rem !important; }
            
            .timeline::after { left: 31px; }
            .timeline-container { width: 100%; padding-left: 70px; padding-right: 25px; }
            .timeline-container.right { left: 0%; }
            .timeline-container.left .timeline-icon, 
            .timeline-container.right .timeline-icon { left: 6px; }
            .timeline-container.left .timeline-content, 
            .timeline-container.right .timeline-content { text-align: left; }
        }
    </style>"""

# Find the end of the style block and replace it
content = content.replace("""        @media screen and (max-width: 768px) {
            .timeline::after { left: 31px; }
            .timeline-container { width: 100%; padding-left: 70px; padding-right: 25px; }
            .timeline-container.right { left: 0%; }
            .timeline-container.left .timeline-icon, 
            .timeline-container.right .timeline-icon { left: 6px; }
            .timeline-container.left .timeline-content, 
            .timeline-container.right .timeline-content { text-align: left; }
        }
    </style>""", responsive_css)

# 2. Fix d-flex gap-4 to wrap on mobile in Our Story section
content = content.replace('<div class="d-flex gap-4">', '<div class="d-flex flex-column flex-sm-row gap-4">')

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Responsive fixes applied.")
