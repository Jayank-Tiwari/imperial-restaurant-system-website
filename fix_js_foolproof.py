import os

filepath = 'resources/views/checkout/index.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

js_target = """        // Robust Tab Switching Logic
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

js_replacement = """        // Ultra Foolproof Tab Switching Logic
        const orderRadios = document.querySelectorAll('input[name="order_type"]');
        
        function handleTabSwitch(radio) {
            try {
                // 1. Force hide all panes via CSS display
                const panes = document.querySelectorAll('.tab-pane');
                for (let i = 0; i < panes.length; i++) {
                    panes[i].classList.remove('show', 'active');
                    panes[i].style.display = 'none';
                }
                
                // 2. Force show target pane
                const targetId = radio.getAttribute('data-target');
                if (targetId) {
                    const targetPane = document.querySelector(targetId);
                    if (targetPane) {
                        targetPane.classList.add('show', 'active');
                        targetPane.style.display = 'block';
                    }
                }

                // 3. Safely execute update logic
                if (radio.id === 'type_delivery') {
                    if (typeof updateSummaryForTab === 'function') updateSummaryForTab('delivery');
                    if (typeof updateDeliveryButton === 'function') updateDeliveryButton();
                } else if (radio.id === 'type_dinein') {
                    if (typeof updateSummaryForTab === 'function') updateSummaryForTab('dinein');
                    if (typeof updateDineinButton === 'function') updateDineinButton();
                } else if (radio.id === 'type_takeaway') {
                    if (typeof updateSummaryForTab === 'function') updateSummaryForTab('takeaway');
                    if (typeof updateTakeawayButton === 'function') updateTakeawayButton();
                }
            } catch (err) {
                console.error("Tab switch error: ", err);
            }
        }

        orderRadios.forEach(radio => {
            radio.addEventListener('change', function() { handleTabSwitch(this); });
            radio.addEventListener('click', function() { handleTabSwitch(this); });
        });
        
        // Initial setup for default checked radio
        orderRadios.forEach(radio => {
            if (radio.checked) {
                handleTabSwitch(radio);
            }
        });"""

content = content.replace(js_target, js_replacement)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Applied foolproof JS.")
