const iconEyeEl = document.querySelector('.fa-eye');

iconEyeEl.addEventListener('click', (e) => {
    if(e.target.classList.contains('fa-eye')) {
        e.target.classList.remove('fa-eye');
        e.target.classList.add('fa-eye-slash');

        e.target.parentElement.previousElementSibling.type = 'text';
    } 
    else {
        e.target.classList.remove('fa-eye-slash');
        e.target.classList.add('fa-eye');

        e.target.parentElement.previousElementSibling.type = 'password';
    }
});






const inputEls = document.querySelectorAll('input');

inputEls.forEach((inputEl, index) => {
    inputEl.addEventListener('focus', (e) => {
        if(!inputEl.parentElement.parentElement.classList.contains('is-invalid')) {
            inputEl.parentElement.parentElement.classList.add('is-valid');
        }
    });

    inputEl.addEventListener('blur', (e) => {
        if(!inputEl.parentElement.parentElement.classList.contains('is-invalid')) {
            if(inputEl.value.trim() === '') {
                inputEl.parentElement.parentElement.classList.remove('is-valid');
            }
        }
    })  
});