

// export const extracter = async function(canvas, image) {
//     canvas.width = image.width;
//     canvas.height = image.height;
//     const ctx = canvas.getContext('2d');
//     ctx.drawImage(image,0,0);
//     const imageData = await ctx.getImageData(0,0,canvas.width, canvas.height);//long array of pixels, every four elements of array are from the RGBA color model
//     const rgbValues = buildRGB(imageData.data);
//     const quantColors = quantization(rgbValues, 0)
//     return quantColors
// }

// function buildRGB(imgData) {
//     const RGBvalues = [];
//     for (let i = 0; i < imgData.length; i+=4) {
//         const rgb = {
//             r: imgData[i],
//             g: imgData[i+1],
//             b: imgData[i+2],
//         };
//         RGBvalues.push(rgb);
//     }
//     return RGBvalues;
// }

// function findBiggestColorRange(rgbValues) {
//     let rMin = Number.MAX_VALUE;//1.7976931348623157e+308.
//     let gMin = Number.MAX_VALUE;
//     let bMin = Number.MAX_VALUE;

//     let rMax = Number.MIN_VALUE;//5e-324
//     let gMax = Number.MIN_VALUE;
//     let bMax = Number.MIN_VALUE;

//     rgbValues.forEach(pixel => {
//         rMin = Math.min(rMin, pixel.r);
//         gMin = Math.min(gMin, pixel.g);
//         bMin = Math.min(bMin, pixel.b);

//         rMax = Math.max(rMax, pixel.r);
//         gMax = Math.max(gMax, pixel.g);
//         bMax = Math.max(bMax, pixel.b);
//     })
//     const rRange = rMax - rMin;
//     const gRange = gMax - gMin;
//     const bRange = bMax - bMin;
//     const biggestRange = Math.max(rRange, gRange, bRange);
//     if(biggestRange === rRange) {
//         return "r";
//     } else if(biggestRange === gRange) {
//         return "g";
//     } else {
//         return "b";
//     }
// };

// //Find the color channel ( red, green or blue) in the image with the biggest range.                          
// //Sort pixels by that channel.
// //Divide the list in half.
// //Repeat the process for each half until you have the desired number of colors.

// function quantization(rgbValues, depth) {                                  
//     const MAX_DEPTH = 3;//power -> 2^5
//     if(depth === MAX_DEPTH || rgbValues.length===0) {                      
//         const color = rgbValues.reduce((prev,curr) => {                    
//             prev.r += curr.r;
//             prev.g += curr.g;
//             prev.b += curr.b;
//             return prev//example -> {r: 3208665, g: 3208665, b: 3208665}
//         },
//         {
//             r:0,
//             g:0,
//             b:0
//         }
//         );

//         color.r = Math.round(color.r/rgbValues.length);
//         color.g = Math.round(color.g/rgbValues.length);
//         color.b = Math.round(color.b/rgbValues.length);
//         return [color]
//     }

//     const colorRange = findBiggestColorRange(rgbValues);

//     rgbValues.sort((p1,p2) => p1[colorRange] - p2[colorRange]);
//     const mid = rgbValues.length / 2;
//     return [
//         ...quantization(rgbValues.slice(0,mid), depth+1),
//         ...quantization(rgbValues.slice(mid+1), depth+1)
//     ];
// }

type Args = {
    amount: number;
    format: string;
    group: number;
    sample: number;
  }
  
  type Data = Uint8ClampedArray
  
  type Handler = (data: Data, args: Args) => Output
  
  type Hex = string
  
  type Input = (Hex | Rgb)[]
  
  type Item = Url | HTMLImageElement
  
  type Output = Hex | Rgb | (Hex | Rgb)[]
  
  type Rgb = [r: number, g: number, b: number]
  
  type Url = string
  
  const getSrc = (item: Item): string =>
    typeof item === 'string' ? item : item.src
  
  const getArgs = ({
    amount = 3,
    format = 'array',
    group = 20,
    sample = 10,
  } = {}): Args => ({ amount, format, group, sample })
  
  const format = (input: Input, args: Args): Output => {
    const list = input.map((val) => {
      const rgb = Array.isArray(val) ? val : val.split(',').map(Number) as Rgb
      return args.format === 'hex' ? rgbToHex(rgb) : rgb
    })
  
    return args.amount === 1 || list.length === 1 ? list[0] : list
  }
  
  const group = (number: number, grouping: number): number => {
    const grouped = Math.round(number / grouping) * grouping
  
    return Math.min(grouped, 255)
  }
  
  const rgbToHex = (rgb: Rgb): Hex => '#' + rgb.map((val) => {
    const hex = val.toString(16)
  
    return hex.length === 1 ? '0' + hex : hex
  }).join('')
  
  const getImageData = (src: Url): Promise<Data> =>
    new Promise((resolve, reject) => {
      const canvas = document.createElement('canvas')
      const context = <CanvasRenderingContext2D>canvas.getContext('2d')
      const img = new Image
  
      img.onload = () => {
        canvas.height = img.height
        canvas.width = img.width
        context.drawImage(img, 0, 0)
  
        const data = context.getImageData(0, 0, img.width, img.height).data
  
        resolve(data)
      }
      img.onerror = () => reject(Error('Image loading failed.'))
      img.crossOrigin = ''
      img.src = src
    })
  
  const getAverage = (data: Data, args: Args): Output => {
    const gap = 4 * args.sample
    const amount = data.length / gap
    const rgb = { r: 0, g: 0, b: 0 }
  
    for (let i = 0; i < data.length; i += gap) {
      rgb.r += data[i]
      rgb.g += data[i + 1]
      rgb.b += data[i + 2]
    }
  
    return format([[
      Math.round(rgb.r / amount),
      Math.round(rgb.g / amount),
      Math.round(rgb.b / amount)
    ]], args)
  }
  
 const getProminent = (data: Data, args: Args): Output => {
    const gap = 4 * args.sample
    const colors: { [key: string]: number } = {}
  
    for (let i = 0; i < data.length; i += gap) {
      const rgb = [
        group(data[i], args.group),
        group(data[i + 1], args.group),
        group(data[i + 2], args.group),
      ].join()
  
      colors[rgb] = colors[rgb] ? colors[rgb] + 1 : 1
    }
  
    return format(
      Object.entries(colors)
        .sort(([_keyA, valA], [_keyB, valB]) => valA > valB ? -1 : 1)
        .slice(0, args.amount)
        .map(([rgb]) => rgb),
      args
    )
  }
  
  const process = (handler: Handler, item: Item, args?: Partial<Args>): Promise<Output> =>
    new Promise((resolve, reject) =>
      getImageData(getSrc(item))
        .then((data) => resolve(handler(data, getArgs(args))))
        .catch((error) => reject(error))
  )
  
export  const average = (item: Item, args?: Partial<Args>) => process(getAverage, item, args)
export const prominent = (item: Item, args?: Partial<Args>) => process(getProminent, item, args)
  