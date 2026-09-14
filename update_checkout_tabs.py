import os

filepath = 'resources/views/checkout/index.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Add CSS for the vertical tab layout's icon-box
css_target = """    .btn-check:checked + .custom-selector {"""
css_replacement = """    .icon-box {
        width: 50px;
        height: 50px;
        background-color: #f8f9fa;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        transition: all 0.2s ease;
    }

    .btn-check:checked + .custom-selector .icon-box {
        background-color: var(--primary-orange);
        color: #fff;
    }

    .btn-check:checked + .custom-selector {"""
content = content.replace(css_target, css_replacement)


# Replace the horizontal tabs with beautiful vertical rich tabs
tabs_target = """                <!-- Custom Radio Tabs -->
                <div class="row g-3 mb-5" role="tablist">
                    <div class="col-4">
                        <input type="radio" class="btn-check" name="order_type" id="type_dinein" data-bs-toggle="tab" data-bs-target="#dinein" checked>
                        <label class="custom-selector w-100 p-3 h-100 text-center" for="type_dinein">
                            <i class="fas fa-chair fs-4 mb-2 d-block"></i>
                            <span class="fw-bold d-block" style="font-size: 0.9rem;">@lang('messages.dine_in')</span>
                        </label>
                    </div>
                    <div class="col-4">
                        <input type="radio" class="btn-check" name="order_type" id="type_takeaway" data-bs-toggle="tab" data-bs-target="#takeaway">
                        <label class="custom-selector w-100 p-3 h-100 text-center" for="type_takeaway">
                            <i class="fas fa-shopping-bag fs-4 mb-2 d-block"></i>
                            <span class="fw-bold d-block" style="font-size: 0.9rem;">Takeaway</span>
                        </label>
                    </div>
                    <div class="col-4">
                        <input type="radio" class="btn-check" name="order_type" id="type_delivery" data-bs-toggle="tab" data-bs-target="#delivery">
                        <label class="custom-selector w-100 p-3 h-100 text-center" for="type_delivery">
                            <i class="fas fa-truck fs-4 mb-2 d-block"></i>
                            <span class="fw-bold d-block" style="font-size: 0.9rem;">@lang('messages.delivery')</span>
                        </label>
                    </div>
                </div>"""

tabs_replacement = """                <!-- Custom Radio Tabs (Vertical) -->
                <div class="row g-3 mb-5" role="tablist">
                    <div class="col-12">
                        <input type="radio" class="btn-check" name="order_type" id="type_dinein" data-bs-toggle="tab" data-bs-target="#dinein" checked>
                        <label class="custom-selector w-100 p-3 text-start d-flex align-items-center" for="type_dinein">
                            <div class="icon-box me-3">
                                <i class="fas fa-chair fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-dark" style="font-size: 1.1rem;">@lang('messages.dine_in')</span>
                                <small class="text-muted d-block mt-1">Order from your table and enjoy the ambiance.</small>
                            </div>
                            <i class="fas fa-check-circle ms-auto fs-5 text-transparent check-mark"></i>
                        </label>
                    </div>
                    <div class="col-12">
                        <input type="radio" class="btn-check" name="order_type" id="type_takeaway" data-bs-toggle="tab" data-bs-target="#takeaway">
                        <label class="custom-selector w-100 p-3 text-start d-flex align-items-center" for="type_takeaway">
                            <div class="icon-box me-3">
                                <i class="fas fa-shopping-bag fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-dark" style="font-size: 1.1rem;">Takeaway</span>
                                <small class="text-muted d-block mt-1">Pick up your food fresh and hot at the counter.</small>
                            </div>
                            <i class="fas fa-check-circle ms-auto fs-5 text-transparent check-mark"></i>
                        </label>
                    </div>
                    <div class="col-12">
                        <input type="radio" class="btn-check" name="order_type" id="type_delivery" data-bs-toggle="tab" data-bs-target="#delivery">
                        <label class="custom-selector w-100 p-3 text-start d-flex align-items-center" for="type_delivery">
                            <div class="icon-box me-3">
                                <i class="fas fa-truck fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-dark" style="font-size: 1.1rem;">@lang('messages.delivery')</span>
                                <small class="text-muted d-block mt-1">We will deliver your order directly to your door.</small>
                            </div>
                            <i class="fas fa-check-circle ms-auto fs-5 text-transparent check-mark"></i>
                        </label>
                    </div>
                </div>"""
content = content.replace(tabs_target, tabs_replacement)

# Add check-mark CSS
css2_target = """    .btn-check:checked + .custom-selector {"""
css2_replacement = """    .text-transparent { color: transparent; }
    .btn-check:checked + .custom-selector .check-mark {
        color: var(--primary-orange) !important;
    }

    .btn-check:checked + .custom-selector {"""
content = content.replace(css2_target, css2_replacement)


with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Checkout tabs converted to rich vertical list.")
