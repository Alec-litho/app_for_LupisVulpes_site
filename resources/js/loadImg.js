import setColors from "./setColors.js";
import { toggleLoader, addPalettes, setClasses, removeClasses, setValues, showModel } from "./scripts.js";
const colorThief = new ColorThief();
const colorsIdsInput = document.querySelector('.colorsIds');
document.querySelector('.form-control').addEventListener('input', e => postImage(e.target));
let resultIsReady = false;



function postImage (target) {//saves image to 'imgbb.com' server
  setClasses()
  toggleLoader();
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
        console.log(res)
          const colors = colorThief.getPalette(image);
          setColors(colors, colorsIdsInput, resultIsReady)
          .then(() => {
            resultIsReady = true
            setValues(res)
            addPalettes(colors);
            removeClasses();
            toggleLoader(resultIsReady);
          })
          .catch(art => {//already exists
            resultIsReady = true
            removeClasses();
            toggleLoader(resultIsReady);
            showModel(art.value[0])
          })
       })
  }}
}
