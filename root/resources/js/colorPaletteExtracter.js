

export const extracter = async function(canvas, image) {
    canvas.width = image.width;
    canvas.height = image.height;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(image,0,0);
    const imageData = await ctx.getImageData(0,0,canvas.width, canvas.height);//long array of pixels, every four elements of array are from the RGBA color model
    const rgbValues = buildRGB(imageData.data);
    const quantColors = quantization(rgbValues, 0)
    return quantColors
}

function buildRGB(imgData) {
    const RGBvalues = [];
    for (let i = 0; i < imgData.length; i+=4) {
        const rgb = {
            r: imgData[i],
            g: imgData[i+1],
            b: imgData[i+2],
        };
        RGBvalues.push(rgb);
    }
    return RGBvalues;
}

function findBiggestColorRange(rgbValues) {
    let rMin = Number.MAX_VALUE;//1.7976931348623157e+308.
    let gMin = Number.MAX_VALUE;
    let bMin = Number.MAX_VALUE;

    let rMax = Number.MIN_VALUE;//0
    let gMax = Number.MIN_VALUE;
    let bMax = Number.MIN_VALUE;

    rgbValues.forEach(pixel => {
        rMin = Math.min(rMin, pixel.r);
        gMin = Math.min(gMin, pixel.g);
        bMin = Math.min(bMin, pixel.b);

        rMax = Math.max(rMax, pixel.r);
        gMax = Math.max(gMax, pixel.g);
        bMax = Math.max(bMax, pixel.b);
    })

    const rRange = rMax - rMin;
    const gRange = gMax - gMin;
    const bRange = bMax - bMin;

    const biggestRange = Math.max(rRange, gRange, bRange);
    if(biggestRange === rRange) {
        return "r";
    } else if(biggestRange === gRange) {
        return "g";
    } else {
        return "b";
    }
};

function quantization(rgbValues, depth) {
    const MAX_DEPTH = 5;
    if(depth === MAX_DEPTH || rgbValues.length===0) {
        const color = rgbValues.reduce((prev,curr) => {
            prev.r += curr.r;
            prev.g += curr.g;
            prev.b += curr.b;
            return prev
        },
        {
            r:0,
            g:0,
            b:0
        }
        );

        color.r = Math.round(color.r/rgbValues.length);
        color.g = Math.round(color.g/rgbValues.length);
        color.b = Math.round(color.b/rgbValues.length);
        return [color]
    }

    const colorRange = findBiggestColorRange(rgbValues);
    rgbValues.sort((p1,p2) => p1[colorRange] - p2[colorRange]);
    const mid = rgbValues.length / 2;
    return [
        ...quantization(rgbValues.slice(0,mid), depth+1),
        ...quantization(rgbValues.slice(mid+1), depth+1)
    ];
}