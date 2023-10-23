const colorThief = new ColorThief();
let resultIsReady = false;
const colorsInput = document.querySelector('.colors');
const palettesBody = document.querySelector('.palettes');
const loader = document.querySelector('#loader');
const resultInp = document.querySelector('.result');
const imgPreview = document.querySelector('.imagePreview');
const canvas = document.querySelector('.canvas');
const button = document.querySelector('button');
document.querySelector('.form-control').addEventListener('input', e => postImage(e.target));
resultInp.addEventListener('mousedown', e => {
    if(!resultIsReady) e.preventDefault();
});


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
        .then((res) => res.json()).then((res) => {
            const colors = colorThief.getPalette(image);
            console.log(colors);
            setColors(colors, colorsInput);//set array of colors as value 
            addPalettes(colors);
            button.removeAttribute("disabled")
            resultIsReady = true;
            imgPreview.src = res.data.url;
            resultInp.value = res.data.url;
            setLoader()
        })
    }

      }
  }
  function setColors(colors,input) {

    let result = '';
    colors.forEach(color => {
      const colorRGB = color.toString().trim();
      console.log(colorRGB);
      fetch(`https://www.thecolorapi.com/scheme?rgb=${colorRGB}&mode=analogic&count=2`,{headers:{
        "Content-Type": "application/json"
      }})
        .then(response => response.json())
        .then(response => {
          const colorModel = {
            "originalShade": response.colors[0].hex.value,
            "baseColor": identifyBaseColor(response.colors[0].hsv),
            "closeName": response.colors[0].name.value,
            "closeShade": response.colors[0].name.closest_named_hex
          }
          console.log(colorModel);
        })
    });
    input.value = result;
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
function identifyBaseColor(hsv) {
  
  let baseColor;
  if(hsv.s === 0 || hsv.s<10) {//integers are procents
    //then its either black or white
  if(hsv.v > 50) {/*white*/}
  else {/*black*/}
  }
  // let hsvFormat = {
  //   "h": hsv.h,
  //   "s": 100,
  //   "v": 100
  // }
  const baseColors = {
    "red": 0,//color : degree
    "orange": 25,
    "yellow": 50,
    "green": 100,
    "blue": 175,
    "dark-blue": 235,
    "violet": 270,
    "pink": 310
  }
  const degreeArr = [0, 25, 50, 100, 175, 235, 270, 310]
  degreeArr.forEach((degree, indx, arr) => {
    let curr = indx;
    let next = indx+1
    if(hsv.h>arr[curr] && hsv.h<arr[next]) {

      let firstNum = hsv.h-arr[curr];
      let secondNum = arr[next]-hsv.h;
      let degree = firstNum>secondNum? arr[next] : arr[curr] //the number that is less than another number is result 
      baseColor = Object.keys(baseColors).find(key => baseColors[key] === degree);
      console.log(firstNum,secondNum);
    }
  })
  console.log(hsv, baseColor);
  return baseColor;
}
