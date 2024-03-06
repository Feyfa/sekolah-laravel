const alertEl = document.querySelector('.alert-auth');

alertEl.querySelector('span').addEventListener('click', () => {
    alertEl.classList.add('hidden');
});