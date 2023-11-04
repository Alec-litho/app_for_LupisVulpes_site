let isPlushie = document.querySelector('#isPlushie');
let tradOrDigit = document.querySelector('#tradOrdigit')


isPlushie.onchange = e => {
    console.log(e);
    if(!tradOrDigit.value) {
        tradOrDigit.value = 'traditional';
        tradOrDigit.setAttribute('disabled','disabled')
    } else {
        tradOrDigit.value = '';
        tradOrDigit.removeAttribute('disabled')
    }

}