const isPlushie = document.querySelector('#isPlushie');
const tradOrDigit = document.querySelector('#tradOrdigit')
const canvas = document.querySelector('.canvas');
const palettesBody = document.querySelector('.palettes');
const loader = document.querySelector('#loader');
const imgPreview = document.querySelector('.imagePreview');
const button = document.querySelector('button');
const discardBTN = document.querySelector('#btn-discard');
const resultInp = document.querySelector('.result');
const inputs = document.querySelectorAll('input');
resultInp.classList.add('user-select-none')
const model = document.querySelector('.artExists');
const modelImg = document.querySelector('.modelImg');
const btnOk = document.querySelector('#ok').onclick= () => {
    model.className = 'd-none';
    location.reload();
};
discardBTN.onclick = discard;

[...inputs].forEach(input => {
        console.log(input.parentNode.childNodes[4]);
        input.addEventListener('input', e => {//if theres an error text node  
            if(input.parentNode.childNodes[4]) e.target.parentNode.childNodes[4].remove()
        })
})
isPlushie.onchange = e => {
    if(!tradOrDigit.value) {
        tradOrDigit.value = 'traditional';
        tradOrDigit.setAttribute('readonly','readonly');
        tradOrDigit.className = 'form-control readonly';
    } else {
        tradOrDigit.value = '';
        tradOrDigit.removeAttribute('readonly')
        tradOrDigit.className = 'form-control';
    }
    console.log(tradOrDigit.value);
};
export function toggleLoader(resultIsReady) {
    if(resultIsReady) {
       loader.classList.remove('lds-ring-show')
       loader.classList.add('lds-ring-hide')
    } else {
        loader.classList.remove('lds-ring-hide')
        loader.classList.add('lds-ring-show')
    }
 };
export function addPalettes(colors) {
     palettesBody.innerHTML = ''//clear colors that left after previous image
     colors.forEach(color => {
       const palette = document.createElement("div");
       palette.setAttribute("style", `background-color:rgb(${color[0]},${color[1]},${color[2]}); width:50px; height:50px; border-radius:50%`);
       palettesBody.appendChild(palette);
     })
 };
 export function setClasses() {
    button.setAttribute("disabled",'');
    imgPreview.classList.add('loading');
 };
 export function removeClasses() {
    button.removeAttribute("disabled");
    resultInp.classList.remove('user-select-none');
    discardBTN.classList.remove('d-none');
    imgPreview.classList.remove('loading');
 };

export function setValues(res) {
    imgPreview.src = res.data.url;
    resultInp.value = res.data.url;
}
export function showModel(art) {
    modelImg.setAttribute('src', art.link);
    model.className = 'artExists'
}
function discard() {
    fetch('http://localhost/app_for_lupisvulpes-site/root/public/api/v1/color/destroy_last',{ method: 'DELETE'});
    location.reload();
}