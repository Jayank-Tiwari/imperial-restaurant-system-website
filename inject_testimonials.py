import os

filepath = 'resources/views/about.blade.php'

testimonials_html = """    {{-- Testimonials Section --}}
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title">@lang('messages.words_from_our_guests')</h2>
                <p class="text-muted mt-3 fs-5">@lang('messages.dont_just_take_our_word')</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="premium-card text-center position-relative">
                        <i class="fas fa-quote-left fs-1 mb-4" style="color: var(--soft-orange); opacity: 0.8; position: absolute; top: 20px; left: 30px; z-index: 0;"></i>
                        <div class="position-relative z-1">
                            <div class="mb-3" style="color: var(--primary-orange);">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4" style="line-height: 1.7;">@lang('messages.testimonial_4')</p>
                            <h6 class="fw-bold text-dark mb-1">@lang('messages.testimonial_4_author')</h6>
                            <small class="text-muted fw-semibold">@lang('messages.google_review')</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="premium-card text-center position-relative">
                        <i class="fas fa-quote-left fs-1 mb-4" style="color: var(--soft-orange); opacity: 0.8; position: absolute; top: 20px; left: 30px; z-index: 0;"></i>
                        <div class="position-relative z-1">
                            <div class="mb-3" style="color: var(--primary-orange);">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4" style="line-height: 1.7;">@lang('messages.testimonial_5')</p>
                            <h6 class="fw-bold text-dark mb-1">@lang('messages.testimonial_5_author')</h6>
                            <small class="text-muted fw-semibold">@lang('messages.anniversary_dinner')</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="premium-card text-center position-relative">
                        <i class="fas fa-quote-left fs-1 mb-4" style="color: var(--soft-orange); opacity: 0.8; position: absolute; top: 20px; left: 30px; z-index: 0;"></i>
                        <div class="position-relative z-1">
                            <div class="mb-3" style="color: var(--primary-orange);">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4" style="line-height: 1.7;">@lang('messages.testimonial_6')</p>
                            <h6 class="fw-bold text-dark mb-1">@lang('messages.testimonial_6_author')</h6>
                            <small class="text-muted fw-semibold">@lang('messages.visitor_from_paris')</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}"""

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

content = content.replace("    {{-- CTA Section --}}", testimonials_html)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Testimonials section added.")
