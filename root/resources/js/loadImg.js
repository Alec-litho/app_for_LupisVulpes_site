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
            console.log(target.files[0]);
            extracter(canvas, this)//EXTRACT COLORS FROM IMAGE
              .then((result) => {
                console.log(result);
                addPalettes(result);
                resultIsReady = true;
                imgPreview.src = res.data.url;
                resultInp.value = res.data.url;
                setLoader()
              })

          })
      }

      }
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
    console.log(colors);
    colors.forEach(color => {
      const palette = document.createElement("div");
      palette.setAttribute("style", `background-color:rgb(${color.r},${color.g},${color.b}); width:100px; height:100px;`)
      palettesBody.appendChild(palette)
    })
  }