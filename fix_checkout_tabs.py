import os
import re

filepath = 'resources/views/checkout/index.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Fix CSS for form-select padding overlap
css_target = """    .form-floating > .form-control,
    .form-floating > .form-select {
        border: 1px solid #ced4da;
        border-radius: 8px;
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }"""
css_replacement = """    .form-floating > .form-control,
    .form-floating > .form-select {
        border: 1px solid #ced4da;
        border-radius: 8px;
        height: calc(3.5rem + 2px);
    }
    .form-floating > .form-control {
        padding: 1rem 0.75rem;
    }"""
content = content.replace(css_target, css_replacement)

# 2. Remove data-bs-toggle="tab" from radio buttons to prevent Bootstrap's broken behavior
content = content.replace('data-bs-toggle="tab" data-bs-target="#dinein"', 'data-target="#dinein"')
content = content.replace('data-bs-toggle="tab" data-bs-target="#takeaway"', 'data-target="#takeaway"')
content = content.replace('data-bs-toggle="tab" data-bs-target="#delivery"', 'data-target="#delivery"')


# 3. Add manual tab toggling in the existing JS change listener
js_target = """        // Listen for Order Type (Tab) Changes using standard BS5 tab events
        document.querySelectorAll('input[name="order_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.id === 'type_delivery') {
                    updateSummaryForTab('delivery');
                    updateDeliveryButton();
                } else if (this.id === 'type_dinein') {
                    updateSummaryForTab('dinein');
                    updateDineinButton();
                } else if (this.id === 'type_takeaway') {
                    updateSummaryForTab('takeaway');
                    updateTakeawayButton();
                }
            });
        });"""

js_replacement = """        // Listen for Order Type (Tab) Changes and Manually Toggle Panes
        document.querySelectorAll('input[name="order_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // 1. Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                
                // 2. Show the target tab pane
                const targetId = this.getAttribute('data-target');
                const targetPane = document.querySelector(targetId);
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                }

                // 3. Update logic
                if (this.id === 'type_delivery') {
                    updateSummaryForTab('delivery');
                    updateDeliveryButton();
                } else if (this.id === 'type_dinein') {
                    updateSummaryForTab('dinein');
                    updateDineinButton();
                } else if (this.id === 'type_takeaway') {
                    updateSummaryForTab('takeaway');
                    updateTakeawayButton();
                }
            });
        });"""
content = content.replace(js_target, js_replacement)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Fixed tabs and floating label overlap.")
