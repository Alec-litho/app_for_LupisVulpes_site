export default function identifyBaseColor(hsv) {
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