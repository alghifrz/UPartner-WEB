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
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input, select');

    form.addEventListener('submit', function (e) {
        let valid = true;

        // Reset error messages dan gaya input
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        inputs.forEach(input => input.classList.remove('input-error'));

        // Validasi Nama
        const name = document.getElementById('name');
        if (!name.value.trim()) {
            valid = false;
            addErrorMessage(name, 'Nama harus diisi');
        }



        // Validasi NIP
        // Cek apakah elemen NIP ada dan validasi
        const nip = document.getElementById('nip');
        if (nip) {
            if (!nip.value.trim()) {
                valid = false;
                addErrorMessage(nip, 'NIP harus diisi');
            } else if (!/^\d{6}$/.test(nip.value.trim())) {
                valid = false;
                addErrorMessage(nip, 'NIP harus 6 karakter dan berupa angka');
            }
        }

        // Validasi Email
        const email = document.getElementById('email');
        if (!email.value.trim()) {
            valid = false;
            addErrorMessage(email, 'Email harus diisi');
        } else if (!isValidEmail(email.value.trim())) {
            valid = false;
            addErrorMessage(email, 'Format email tidak valid');
        }

        // Validasi Program Studi
        const prodi_id = document.getElementById('prodi_id');
        if (!prodi_id.value) {
            valid = false;
            addErrorMessage(prodi_id, 'Program Studi harus dipilih');
        }

        // Validasi Kata Sandi
        const password = document.getElementById('password');
        const password_confirmation = document.getElementById('password_confirmation');
        if (!password.value.trim()) {
            valid = false;
            addErrorMessage(password, 'Kata sandi harus diisi');
        }
        if (password.value.trim() !== password_confirmation.value.trim()) {
            valid = false;
            addErrorMessage(password_confirmation, 'Konfirmasi kata sandi tidak cocok');
        }

        // Cegah submit jika tidak valid
        if (!valid) {
            e.preventDefault();
        }
    });

    // Hapus pesan error saat pengguna mulai mengetik
    inputs.forEach(input => {
        input.addEventListener('input', function () {
            const errorMessage = input.closest('.error-container').querySelector('.error-message');
            if (errorMessage) {
                errorMessage.remove();
            }
            input.classList.remove('input-error');
        });
    });

    // Fungsi untuk menambahkan pesan error
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

    // Validasi format email
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
</script>
