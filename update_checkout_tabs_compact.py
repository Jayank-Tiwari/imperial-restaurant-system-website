import os

filepath = 'resources/views/checkout/index.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Add CSS for Segmented Control
css_target = """    .btn-check:checked + .custom-selector {"""
css_replacement = """    /* --- Segmented Control for Tabs --- */
    .segmented-control {
        display: flex;
        background-color: #f1f3f5;
        border-radius: 12px;
        padding: 6px;
    }
    .segmented-control label {
        flex: 1;
        text-align: center;
        padding: 12px 0;
        border-radius: 8px;
        color: #6c757d;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        margin: 0;
    }
    .segmented-control label:hover {
        color: #495057;
    }
    .segmented-control .btn-check:checked + label {
        background-color: #fff;
        color: var(--primary-orange);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .btn-check:checked + .custom-selector {"""
content = content.replace(css_target, css_replacement)


# Replace the vertical tabs with the ultra-compact segmented control
tabs_target = """                <!-- Custom Radio Tabs (Vertical) -->
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

tabs_replacement = """                <!-- Compact Segmented Control Tabs -->
                <div class="segmented-control mb-5" role="tablist">
                    <input type="radio" class="btn-check" name="order_type" id="type_dinein" data-bs-toggle="tab" data-bs-target="#dinein" checked>
                    <label for="type_dinein"><i class="fas fa-chair me-2"></i>@lang('messages.dine_in')</label>
                    
                    <input type="radio" class="btn-check" name="order_type" id="type_takeaway" data-bs-toggle="tab" data-bs-target="#takeaway">
                    <label for="type_takeaway"><i class="fas fa-shopping-bag me-2"></i>Takeaway</label>
                    
                    <input type="radio" class="btn-check" name="order_type" id="type_delivery" data-bs-toggle="tab" data-bs-target="#delivery">
                    <label for="type_delivery"><i class="fas fa-truck me-2"></i>@lang('messages.delivery')</label>
                </div>"""
content = content.replace(tabs_target, tabs_replacement)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Checkout tabs converted to ultra-compact segmented control.")
