import { showLoader } from './loader.js';

function validateInput(input, errorMessage) {
    const value = input.value.trim();
    if (value === '') {
        showError(input, errorMessage);
        return false;
    }
    clearError(input);
    return true;
}

function showError(input, message) {
    input.classList.add('error');
    input.placeholder = message;
}

function clearError(input) {
    input.classList.remove('error');
    restorePlaceholder(input);
}

function restorePlaceholder(input) {
    if (input.dataset.originalPlaceholder) {
        input.placeholder = input.dataset.originalPlaceholder;
    }
}

export function initFormValidation() {
    const form = document.querySelector('.comment-form');
    if (!form) return;

    const nameInput = form.querySelector('#nama_penulis');
    const commentInput = form.querySelector('#detail_komen');

    if (nameInput) {
        nameInput.dataset.originalPlaceholder = nameInput.placeholder;

        nameInput.addEventListener('blur', function() {
            validateInput(this, 'Nama harus diisi');
        });

        nameInput.addEventListener('focus', function() {
            if (this.classList.contains('error')) restorePlaceholder(this);
        });

        nameInput.addEventListener('input', function() {
            if (this.value.trim().length > 0) clearError(this);
        });
    }

    if (commentInput) {
        commentInput.dataset.originalPlaceholder = commentInput.placeholder;

        commentInput.addEventListener('blur', function() {
            validateInput(this, 'Komentar harus diisi');
        });

        commentInput.addEventListener('focus', function() {
            if (this.classList.contains('error')) restorePlaceholder(this);
        });

        commentInput.addEventListener('input', function() {
            if (this.value.trim().length > 0) clearError(this);
        });
    }

    form.addEventListener('submit', function(e) {
        let isValid = true;

        if (nameInput && !validateInput(nameInput, 'Nama harus diisi')) isValid = false;
        if (commentInput && !validateInput(commentInput, 'Komentar harus diisi')) isValid = false;

        if (!isValid) {
            e.preventDefault();
            return false;
        }

        showLoader();
    });
}
