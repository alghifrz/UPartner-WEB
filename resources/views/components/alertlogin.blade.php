<style>
    /* Pesan error dengan posisi absolut */
    .error-message {
        position: absolute; /* Posisi absolut agar tidak memengaruhi tata letak */
        top: 100%; /* Tampilkan di bawah input */
        left: 0;
        color: #ff0000; /* Warna merah untuk pesan error */
        font-size: 0.875rem; /* Ukuran teks error */
        margin-top: 0.25rem; /* Jarak kecil dari input field */
    }
    .error-container {
        position: relative;
    }

    .input-error {
        border: 1px solid #ff0000;
    }
</style>
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        let valid = true;
        const email = document.getElementById('email');
        const password = document.getElementById('password');

        // Reset error messages dan gaya input
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        [email, password].forEach(input => input.classList.remove('input-error'));

        // Validasi email
        if (!email.value) {
            valid = false;
            addErrorMessage(email, 'Email harus diisi');
        } else if (!isValidEmail(email.value)) {
            valid = false;
            addErrorMessage(email, 'Format email tidak valid');
        }

        // Validasi password
        if (!password.value) {
            valid = false;
            addErrorMessage(password, 'Kata sandi harus diisi');
        }

        // Cegah submit jika tidak valid
        if (!valid) {
            e.preventDefault();
        }
    });

    function addErrorMessage(element, message) {
        const error = document.createElement('p');
        error.className = 'error-message';
        error.textContent = message;

        // Tambahkan pesan error ke parent container
        const container = element.closest('.error-container');
        container.appendChild(error);

        // Tambahkan highlight merah pada input field
        element.classList.add('input-error');
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email); // Regex validasi email
    }
</script>