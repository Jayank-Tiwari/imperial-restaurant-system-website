import os

filepath = 'resources/views/layout/footer.blade.php'

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Update text-muted to text-white-50
content = content.replace('text-muted mb-4 pe-lg-4', 'text-white-50 mb-4 pe-lg-4')

# 2. Remove social links
social_links = """                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-tripadvisor"></i></a>
                </div>"""
content = content.replace(social_links, '')

# 3. Add contact-info anchor tags styles
css_target = """    .contact-info i {
        color: #d35400;
        margin-top: 4px;
        margin-right: 15px;
        font-size: 1.1rem;
    }"""
css_replacement = """    .contact-info i {
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
    }"""
content = content.replace(css_target, css_replacement)

# 4. Make phone number and email clickable
phone_target = """                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>+34 602 18 93 06</span>
                    </li>"""
phone_replacement = """                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span><a href="tel:+34602189306">+34 602 18 93 06</a></span>
                    </li>"""
content = content.replace(phone_target, phone_replacement)

email_target = """                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>Imperialspice50@gmail.com</span>
                    </li>"""
email_replacement = """                    <li>
                        <i class="fas fa-envelope"></i>
                        <span><a href="mailto:Imperialspice50@gmail.com">Imperialspice50@gmail.com</a></span>
                    </li>"""
content = content.replace(email_target, email_replacement)

# Save
with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Footer updated successfully.")
