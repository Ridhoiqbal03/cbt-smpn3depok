import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Modal handling
document.addEventListener('DOMContentLoaded', function() {
    // Success modal handling
    const successModal = document.getElementById('success-modal');
    if (successModal) {
        // Auto close after 5 seconds
        setTimeout(() => {
            if (successModal.style.display !== 'none') {
                closeSuccessModal();
            }
        }, 5000);
    }
});

// Function to close success modal with animation
function closeSuccessModal() {
    const modal = document.getElementById('success-modal');
    if (modal) {
        modal.classList.remove('modal-enter');
        modal.classList.add('modal-exit');
        
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }
}

// Form validation enhancement
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
    });
});

function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';
    
    // Basic validation rules
    switch(fieldName) {
        case 'name':
            if (value.length < 2) {
                isValid = false;
                errorMessage = 'Nama harus minimal 2 karakter';
            }
            break;
        case 'email':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                errorMessage = 'Format email tidak valid';
            }
            break;
        case 'password':
            if (value.length < 8) {
                isValid = false;
                errorMessage = 'Password harus minimal 8 karakter';
            }
            break;
        case 'password_confirmation':
            const password = document.querySelector('input[name="password"]');
            if (password && value !== password.value) {
                isValid = false;
                errorMessage = 'Konfirmasi password tidak cocok';
            }
            break;
    }
    
    // Update field styling
    const container = field.closest('div');
    if (container) {
        if (!isValid) {
            container.classList.add('border-red-500');
            container.classList.remove('border-[#EEEEEE]');
            
            // Remove existing error message
            const existingError = container.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
            
            // Add new error message
            const errorDiv = document.createElement('p');
            errorDiv.className = 'error-message';
            errorDiv.textContent = errorMessage;
            container.parentNode.appendChild(errorDiv);
        } else {
            container.classList.remove('border-red-500');
            container.classList.add('border-[#EEEEEE]');
            
            // Remove error message
            const existingError = container.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
        }
    }
}
