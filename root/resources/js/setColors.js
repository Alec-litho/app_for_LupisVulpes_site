import identifyBaseColor from "./identifyBaseColor.js";//finds base color of given hue
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json, text-plain, */*",
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": token
  };

export default async function setColors(colors,input, setFinish) {
    let colorsIds = await storeColors(colors, headers);//store colors in db
    console.log(colorsIds);
    let isExists = await fetch('http://localhost/app_for_lupisvulpes-site/root/public/art/if_exists',{headers:headers,method:'post',body:JSON.stringify(...colorsIds)}).then(res=>res.json())//check if art already exists
    return new Promise((resolve,reject) => {
        if(isExists.length!==0) reject({message:'art already exists',value:isExists});
        else {
            let str=''
            colorsIds.forEach((color,indx,arr) => str+= indx===arr.length-1? color.id:color.id+',')
            console.log(str);
            resolve(input.value = str);
        }
    });
  }

async function storeColors(colors, headers) {
    const colorsIds = {data:[]};
    let result = await Promise.all(colors.map(async(color, indx, arr) => {//What i want to do is call Promise.all on the array returned by map in order to convert it to a single Promise before awaiting it.
        let colorObj = await createColorObj(color)
        let colorId = await fetch('http://localhost/app_for_lupisvulpes-site/root/public/color', {headers: headers,method: 'post',body: JSON.stringify(colorObj)}).then(res=>res.json())//store obj and get its id
        console.log(colorId);
        colorsIds.data.push(colorId)
        return colorId
      })
    )
      console.log(result);
      return result
}

async function createColorObj(color) {
    const colorRGB = color.toString().trim();
    let response = await fetch(`https://www.thecolorapi.com/scheme?rgb=${colorRGB}&mode=analogic&count=2`,{headers}).then(res=>res.json());//get more accurate info about color
    console.log(response, 'response from thecolorapi');
    let hsv = response.colors[0].hsv;
    const colorModel = {
      "original_hue": response.colors[0].hex.value,
      "base_color": identifyBaseColor(hsv),
      "close_hue_name": response.colors[0].name.value,
      "close_hue": response.colors[0].name.closest_named_hex,
      "hsv": `${[hsv.h,hsv.s,hsv.v]}`
    };
    return colorModel;
}