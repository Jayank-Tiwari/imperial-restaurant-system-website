import os

filepath = 'resources/views/about.blade.php'

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Fix the missing icon
content = content.replace('<i class="fas fa-fire-burner"></i>', '<i class="fas fa-fire"></i>')

# 2. Fix the CTA button hover issue
css_target = """        .cta-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            color: #d35400;
        }"""
css_replacement = """        .cta-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            color: #d35400 !important;
            background-color: #fff !important;
        }"""
content = content.replace(css_target, css_replacement)

# 3. Enhance timeline CSS
timeline_css_target = """        .timeline-container::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            right: -12px;
            background-color: #fff;
            border: 4px solid var(--primary-orange);
            top: 30px;
            border-radius: 50%;
            z-index: 1;
            box-shadow: 0 4px 10px rgba(211, 84, 0, 0.3);
        }

        .timeline-container.right::after { left: -12px; }"""

timeline_css_replacement = """        .timeline-icon {
            position: absolute;
            width: 50px;
            height: 50px;
            right: -25px;
            background-color: #fff;
            border: 4px solid var(--primary-orange);
            top: 25px;
            border-radius: 50%;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(211, 84, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-orange);
            font-size: 1.2rem;
        }

        .timeline-container.right .timeline-icon { left: -25px; }"""
content = content.replace(timeline_css_target, timeline_css_replacement)

# Mobile timeline CSS tweak
mobile_css_target = """            .timeline-container::after { left: 21px; }"""
mobile_css_replacement = """            .timeline-container.left .timeline-icon, 
            .timeline-container.right .timeline-icon { left: 6px; }"""
content = content.replace(mobile_css_target, mobile_css_replacement)

# Add background pattern to journey section
journey_section_target = """    {{-- Our Journey Timeline Section --}}
    <section class="py-5 bg-white">"""
journey_section_replacement = """    {{-- Our Journey Timeline Section --}}
    <section class="py-5 bg-white position-relative" style="background-image: radial-gradient(#d35400 1px, transparent 1px); background-size: 40px 40px; background-position: 0 0; background-color: #ffffff;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.95)); z-index: 0;"></div>"""
content = content.replace(journey_section_target, journey_section_replacement)

# Update timeline content to add icons
container_left_2021_target = """                <div class="timeline-container left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="timeline-year">2021</div>"""
container_left_2021_replacement = """                <div class="timeline-container left position-relative z-1" data-aos="fade-right">
                    <div class="timeline-icon"><i class="fas fa-store"></i></div>
                    <div class="timeline-content text-end">
                        <div class="timeline-year">2021</div>"""
content = content.replace(container_left_2021_target, container_left_2021_replacement)

container_right_2023_target = """                <div class="timeline-container right" data-aos="fade-left">
                    <div class="timeline-content">
                        <div class="timeline-year">2023</div>"""
container_right_2023_replacement = """                <div class="timeline-container right position-relative z-1" data-aos="fade-left">
                    <div class="timeline-icon"><i class="fas fa-utensils"></i></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2023</div>"""
content = content.replace(container_right_2023_target, container_right_2023_replacement)

container_left_2024_target = """                <div class="timeline-container left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="timeline-year">2024</div>"""
container_left_2024_replacement = """                <div class="timeline-container left position-relative z-1" data-aos="fade-right">
                    <div class="timeline-icon"><i class="fas fa-glass-cheers"></i></div>
                    <div class="timeline-content text-end">
                        <div class="timeline-year">2024</div>"""
content = content.replace(container_left_2024_target, container_left_2024_replacement)

# Make sure z-index is correct for header text in timeline section
content = content.replace("""        <div class="container py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title">@lang('messages.our_journey')</h2>""", """        <div class="container py-5 position-relative z-1">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title bg-white px-4">@lang('messages.our_journey')</h2>""")

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("About page enhancements done.")
