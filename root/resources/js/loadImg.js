import {extracter} from './colorPaletteExtracter.js';

let resultIsReady = false;
const palettesBody = document.querySelector('.palettes');
const loader = document.querySelector('#loader');
const img = document.querySelector('.form-control').addEventListener('input', e => postImage(e.target));
const resultInp = document.querySelector('.result');
const imgPreview = document.querySelector('.imagePreview');
const canvas = document.querySelector('.canvas');
resultInp.addEventListener('mousedown', e => {
    if(!resultIsReady) e.preventDefault();
});


function postImage (target) {//saves image to 'imgbb.com' server
    setLoader();
    const imgName = target.value.slice(12);
    const rf = new FileReader();
    rf.readAsDataURL(target.files[0]);

    rf.onload = async function (file) {
    let image = new Image();
    image.src = file.target.result;

    image.onload = function() {
      const body = new FormData();
      body.append('image', file.target.result.split(',').pop());
      body.append('name', imgName.slice(0, imgName.lastIndexOf('.')));
      fetch('https://api.imgbb.com/1/upload?key=1e194d99cc989dab9340726349f27b2d', { method: 'POST', body })
        .then((res) => res.json()).then((res) => {
          extracter(canvas, this)//EXTRACT COLORS FROM IMAGE
            .then((result) => {
              const colors = [{r: 1, g: 1, b: 1}];
              filterColors(result,colors)//it still has same colors !!!!!!!!!
              let filtered = colors.filter(color => color !== false)
              addPalettes(filtered);
              resultIsReady = true;
              imgPreview.src = res.data.url;
              resultInp.value = res.data.url;
              setLoader()
            })
        })
    }

      }
  }
  function filterColors(result, colors) {
    result.forEach((color,i) => {
      let indx = i-1<0? 0 : i
      if(colors[indx].r!==color.r&&colors[indx].g!==color.g&&colors[indx].b!==color.b) colors.push(color);
      else colors.push(false);
      })
    return colors
  }


  function setLoader() {
    if(resultIsReady) {
        loader.classList.remove('lds-ring-show')
        loader.classList.add('lds-ring-hide')
    } else {
        loader.classList.remove('lds-ring-hide')
        loader.classList.add('lds-ring-show')
    }
  }

  function addPalettes(colors) {
    colors.forEach(color => {
      const palette = document.createElement("div");
      palette.setAttribute("style", `background-color:rgb(${color.r},${color.g},${color.b}); width:25px; height:25px; border:1px solid black`)
      palettesBody.appendChild(palette)
    })
  }
  const hslToHex = (hslColor) => {
    const hslColorCopy = { ...hslColor };
    hslColorCopy.l /= 100;
    const a =
      (hslColorCopy.s * Math.min(hslColorCopy.l, 1 - hslColorCopy.l)) / 100;
    const f = (n) => {
      const k = (n + hslColorCopy.h / 30) % 12;
      const color = hslColorCopy.l - a * Math.max(Math.min(k - 3, 9 - k, 1), -1);
      return Math.round(255 * color)
        .toString(16)
        .padStart(2, "0");
    };
    return `#${f(0)}${f(8)}${f(4)}`.toUpperCase();
  };