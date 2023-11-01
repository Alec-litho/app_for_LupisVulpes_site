import setColors from "./setColors.js";
const colorThief = new ColorThief();
let resultIsReady = false;
const canvas = document.querySelector('.canvas');
const palettesBody = document.querySelector('.palettes');
const loader = document.querySelector('#loader');
const resultInp = document.querySelector('.result');
const imgPreview = document.querySelector('.imagePreview');
const button = document.querySelector('button');
const colorsIdsInput = document.querySelector('.colorsIds');
document.querySelector('.form-control').addEventListener('input', e => postImage(e.target));
resultInp.addEventListener('mousedown', e => {if(!resultIsReady) e.preventDefault();});


function postImage (target) {//saves image to 'imgbb.com' server
  button.setAttribute("disabled",'');
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
      .then((res) => res.json())
      .then((res) => {
          const colors = colorThief.getPalette(image);
          setColors(colors, colorsIdsInput, resultIsReady)
          .then(() => {
            resultIsReady = true
            addPalettes(colors);
            button.removeAttribute("disabled")
            imgPreview.src = res.data.url;
            resultInp.value = res.data.url;
            setLoader();
          })
       })
  }}
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
    palettesBody.innerHTML = ''//clear colors that left after previous image
    colors.forEach(color => {
      const palette = document.createElement("div");
      palette.setAttribute("style", `background-color:rgb(${color[0]},${color[1]},${color[2]}); width:50px; height:50px; border-radius:50%`)
      palettesBody.appendChild(palette)
    })
}