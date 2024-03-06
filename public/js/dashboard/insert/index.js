const imgEls = document.querySelectorAll('img');
const inputFileEls = document.querySelectorAll('input[type="file"].input-file');
const inputRowsEl = document.querySelector('.input-rows');

inputFileEls.forEach((inputFileEl, index) => {
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
            console.log(OFREvent.target.result);
            imgEls[index].src = OFREvent.target.result;
        }
    });
})

inputRowsEl.addEventListener('change', (e) => {
    const value = e.target.value;

    if(value <= 3 && value >= 1) {
        const url = `/insert?rows=${encodeURIComponent(value)}`;
        window.location.href = url;
    }
    else {
        const url = `/insert?rows=1`;
        window.location.href = url;
    }
})