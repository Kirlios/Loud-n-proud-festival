// Email validation
const emailInput = document.getElementById('email');
const emailError = document.getElementById('emailError');

if (emailInput) {
    emailInput.addEventListener('blur', () => {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!email) {
            emailError.textContent = '';
        } else if (!emailRegex.test(email)) {
            emailError.textContent = 'Please enter a valid email address';
            emailInput.style.borderColor = 'var(--red)';
        } else {
            emailError.textContent = '';
            emailInput.style.borderColor = 'var(--border)';
        }
    });
}

// Phone validation
const phoneInput = document.getElementById('phone');
const phoneError = document.getElementById('phoneError');
const countryCode = document.getElementById('countryCode');

if (phoneInput) {
    phoneInput.addEventListener('input', () => {
        // Remove all non-numeric characters
        phoneInput.value = phoneInput.value.replace(/[^0-9\s]/g, '');
    });

    phoneInput.addEventListener('blur', () => {
        const phone = phoneInput.value.replace(/\s/g, '');
        const code = countryCode.value;
        
        if (!phone) {
            phoneError.textContent = '';
            return;
        }

        // Phone number length rules by country code
        const rules = {
            '+421': { min: 9, max: 9,  name: 'Slovak' },   // Slovakia
            '+420': { min: 9, max: 9,  name: 'Czech' },    // Czech Republic
            '+1':   { min: 10, max: 10, name: 'US/Canada' },
            '+44':  { min: 10, max: 10, name: 'UK' },
            '+49':  { min: 10, max: 11, name: 'German' },
            '+33':  { min: 9, max: 9,  name: 'French' },
            '+39':  { min: 9, max: 10, name: 'Italian' },
            '+34':  { min: 9, max: 9,  name: 'Spanish' },
            '+31':  { min: 9, max: 9,  name: 'Dutch' },
            '+48':  { min: 9, max: 9,  name: 'Polish' },
            '+43':  { min: 10, max: 13, name: 'Austrian' }
        };

        const rule = rules[code] || { min: 6, max: 15, name: '' };
        
        if (phone.length < rule.min || phone.length > rule.max) {
            phoneError.textContent = `${rule.name} phone numbers should be ${rule.min}${rule.min !== rule.max ? '-' + rule.max : ''} digits`;
            phoneInput.style.borderColor = 'var(--red)';
        } else {
            phoneError.textContent = '';
            phoneInput.style.borderColor = 'var(--border)';
        }
    });
}

// Form submission validation
const checkoutForm = document.getElementById('checkoutForm');
if (checkoutForm) {
    checkoutForm.addEventListener('submit', (e) => {
        let isValid = true;

        // Final email check
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            emailError.textContent = 'Please enter a valid email address';
            emailInput.style.borderColor = 'var(--red)';
            isValid = false;
        }

        // Final phone check
        const phone = phoneInput.value.replace(/\s/g, '');
        if (phone.length < 6 || phone.length > 15) {
            phoneError.textContent = 'Please enter a valid phone number';
            phoneInput.style.borderColor = 'var(--red)';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
}
