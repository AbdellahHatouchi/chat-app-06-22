let eye = document.getElementById('eye');
let inputPassword = document.getElementById('password');
eye.onclick = () => {
    if (inputPassword.type === 'password') {
        eye.className = 'fa-solid fa-eye';
        inputPassword.type = 'text';
    } else {
        eye.className = 'fa-solid fa-eye-slash';
        inputPassword.type = 'password';
    }
}

