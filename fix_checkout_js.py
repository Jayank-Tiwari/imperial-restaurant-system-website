import os

filepath = 'resources/views/checkout/index.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace event listener setup to be fully robust
js_target = """        // Listen for Order Type (Tab) Changes and Manually Toggle Panes
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

js_replacement = """        // Robust Tab Switching Logic
        const orderRadios = document.querySelectorAll('input[name="order_type"]');
        orderRadios.forEach(radio => {
            radio.addEventListener('change', function(e) {
                try {
                    // 1. Hide all tab panes safely
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('show', 'active');
                    });
                    
                    // 2. Show the target tab pane
                    const targetId = this.getAttribute('data-target');
                    if(targetId) {
                        const targetPane = document.querySelector(targetId);
                        if (targetPane) {
                            targetPane.classList.add('show', 'active');
                        }
                    }

                    // 3. Safely execute update logic
                    if (this.id === 'type_delivery') {
                        if(typeof updateSummaryForTab === 'function') updateSummaryForTab('delivery');
                        if(typeof updateDeliveryButton === 'function') updateDeliveryButton();
                    } else if (this.id === 'type_dinein') {
                        if(typeof updateSummaryForTab === 'function') updateSummaryForTab('dinein');
                        if(typeof updateDineinButton === 'function') updateDineinButton();
                    } else if (this.id === 'type_takeaway') {
                        if(typeof updateSummaryForTab === 'function') updateSummaryForTab('takeaway');
                        if(typeof updateTakeawayButton === 'function') updateTakeawayButton();
                    }
                } catch (err) {
                    console.error("Tab switch error: ", err);
                }
            });
        });"""
content = content.replace(js_target, js_replacement)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("JS logic updated for robustness.")
