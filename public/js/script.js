const passwordInput = document.getElementById('password');
const strengthText = document.getElementById('strength-text');

passwordInput.addEventListener('input', function () {
    const password = passwordInput.value;
    const strength = getPasswordStrength(password);

    updateStrengthText(strength);
});

function getPasswordStrength(password) {
    if (password.length < 6) {
        return 0; // Weak
    } else if (password.length < 10) {
        return 30; // Medium
    } else {
        return 100; // Strong
    }
}

function updateStrengthText(strength) {
    let text = '';
    if (strength === 0) {
        text = 'Weak';
        strengthText.style.color = 'red';
    } else if (strength <= 30) {
        text = 'Medium';
        strengthText.style.color = 'orange';
    } else {
        text = 'Strong';
        strengthText.style.color = 'green';
    }
    strengthText.textContent = text;
}


