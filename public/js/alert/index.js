const alertEl = document.querySelector('.alert');

alertEl.querySelector('span').addEventListener('click', () => {
    alertEl.classList.add('hidden');
});