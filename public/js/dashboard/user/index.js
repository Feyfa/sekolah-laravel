const iconPencilEl = document.querySelector('.pencil');
const iconCloseEl = document.querySelector('span.xmark');
const btnEditEl = document.querySelector('.btn-edit');
const editModeEl = document.querySelector('.edit-mode');
const iconContainerEl = document.querySelector('.icon-container');
const imgEl = document.querySelector('img');

const inputFileEl = document.querySelector('input[type="file"].input-file');
const inputEls = document.querySelectorAll('input.input');
const selectEl = document.querySelector('select');
const textareaEls = document.querySelectorAll('textarea');

let inputValues = [];
let selectValue = '';
let textareaValues = [];

const oldInputEl = document.querySelector('input.old-input');

iconPencilEl.addEventListener('click', () => {
    iconPencilEl.classList.add('hidden');

    iconCloseEl.classList.remove('hidden');

    editModeEl.classList.remove('hidden');

    iconContainerEl.classList.remove('justify-end');
    iconContainerEl.classList.add('justify-between');

    inputFileEl.classList.remove('hidden');

    inputEls.forEach((inputEl) => { 
        inputEl.readOnly = false;
        inputEl.parentElement.classList.add('is-valid');
        inputValues.push(inputEl.value);
    });

    selectEl.disabled = false;
    selectEl.parentElement.classList.add('is-valid');
    selectValue = selectEl.value;

    textareaEls.forEach((textareaEl) => {
        textareaEl.readOnly = false;
        textareaEl.parentElement.classList.add('is-valid');
        textareaValues.push(textareaEl.value);
    });

    btnEditEl.classList.remove('hidden');
});


iconCloseEl.addEventListener('click', () => {
    imgEl.src = `/storage/${oldInputEl.value}`;

    inputFileEl.value = '';

    iconPencilEl.classList.remove('hidden');

    iconCloseEl.classList.add('hidden');

    editModeEl.classList.add('hidden');

    iconContainerEl.classList.add('justify-end');
    iconContainerEl.classList.remove('justify-between');

    inputFileEl.classList.add('hidden');
    
    inputEls.forEach((inputEl, index) => { 
        inputEl.readOnly = true;
        inputEl.parentElement.classList.remove('is-valid');
        inputEl.value = inputValues[index];
    });
    
    selectEl.disabled = true;
    selectEl.parentElement.classList.remove('is-valid');
    selectEl.value = selectValue;
    
    textareaEls.forEach((textareaEl, index) => {
        textareaEl.readOnly = true;
        textareaEl.parentElement.classList.remove('is-valid');
        textareaEl.value = textareaValues[index];
    });

    inputValues = [];
    selectValue = '';
    textareaValues = [];

    btnEditEl.classList.add('hidden');
});

inputFileEl.addEventListener('change', () => {
    // jika file bukan image
    if(!inputFileEl.files[0].type.startsWith('image/')) {
        inputFileEl.value = '';
        return alert('The foto field must be an image');
    }

    // jika file lebih besar dari 1mb
    if(inputFileEl.files[0].size > 1000000) {
        inputFileEl.value = '';
        return alert('The foto field must not be greater than 1024 kilobytes');
    }

    const oFReader = new FileReader();

    oFReader.readAsDataURL(inputFileEl.files[0]);

    oFReader.onload = function (OFREvent) {
        imgEl.src = OFREvent.target.result;
    }
});