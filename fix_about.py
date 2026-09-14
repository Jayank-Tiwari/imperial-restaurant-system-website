import os

filepath = 'resources/views/about.blade.php'

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Change the counter HTML fallback from 0 to actual numbers
content = content.replace('<div class="counter-value" data-count="4">0</div>', '<div class="counter-value" data-count="4">4</div>')
content = content.replace('<div class="counter-value" data-count="10000">0</div>', '<div class="counter-value" data-count="10000">10000</div>')

# 2. Replace @push('scripts') with just the script tag inside the section
old_scripts = """@endsection

@push('scripts')
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll('.counter-value');
            const speed = 200; 

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const updateCount = () => {
                            const target = +counter.getAttribute('data-count');
                            const count = +counter.innerText;
                            const increment = Math.ceil(target / speed);

                            if (count < target) {
                                counter.innerText = Math.min(count + increment, target);
                                setTimeout(updateCount, 25);
                            } else {
                                counter.innerText = target.toLocaleString() + (target >= 1000 ? '+' : '');
                            }
                        };
                        updateCount();
                        observer.unobserve(counter); 
                    }
                });
            }, {
                threshold: 0.5 
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endpush"""

new_scripts = """
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll('.counter-value');
            const speed = 50; 

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        counter.innerText = '0'; // start from 0 when JS kicks in
                        
                        const updateCount = () => {
                            const target = +counter.getAttribute('data-count');
                            const count = +counter.innerText;
                            const increment = Math.ceil(target / speed);

                            if (count < target) {
                                counter.innerText = Math.min(count + increment, target);
                                setTimeout(updateCount, 40);
                            } else {
                                counter.innerText = target.toLocaleString() + (target >= 10000 ? '+' : '');
                            }
                        };
                        updateCount();
                        observer.unobserve(counter); 
                    }
                });
            }, {
                threshold: 0.1 
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endsection
"""

content = content.replace(old_scripts, new_scripts)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("About page scripts fixed.")
