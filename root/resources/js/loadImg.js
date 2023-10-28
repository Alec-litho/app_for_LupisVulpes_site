const colorThief = new ColorThief();
let resultIsReady = false;
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
console.log(token);

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
            setColors(colors, colorsInput);//set array of colors as value 
            addPalettes(colors);
            button.removeAttribute("disabled")
            resultIsReady = true;
            imgPreview.src = res.data.url;
            resultInp.value = res.data.url;
            setLoader()
        })
    }}
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
          let hsv = response.colors[0].hsv
          const colorModel = {
            "originalShade": response.colors[0].hex.value,
            "baseColor": identifyBaseColor(hsv),
            "closeName": response.colors[0].name.value,
            "closeShade": response.colors[0].name.closest_named_hex,
            "hsv": [hsv.h,hsv.s,hsv.v]
          }
          return colorModel
        })
        .then(response => {
          console.log( JSON.stringify(response));
          fetch('http://localhost/app_for_lupisvulpes-site/root/public/color', {
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json, text-plain, */*",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-TOKEN": token
            },
            method: 'post',
            credentials: 'same-origin',
            body: JSON.stringify(response)
          }).then(res => console.log(res))
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
  let resultColor;
  if(hsv.s === 0) {//integers are procents
    resultColor = "white/black"
  } else {
  const baseColors = {
    "red": [[0,10],[346,360]],
    "orange": [11,30],
    "yellow": [31,50],
    "green": [51,140],
    "blue": [141,200],
    "dark-blue": [201,240],
    "violet": [241,280],
    "pink": [281,345]
  }

  for (const [key, value] of Object.entries(baseColors)) {
    if(Array.isArray(value[0])) {
      value.forEach(colorArea => {
        if(hsv.h>=colorArea[0] && hsv.h<=colorArea[1]) resultColor = key
      })
    } else {
      if(hsv.h>=value[0] && hsv.h<=value[1]) {
        resultColor = key
      }
    }
  }
  }
  
  return resultColor
}