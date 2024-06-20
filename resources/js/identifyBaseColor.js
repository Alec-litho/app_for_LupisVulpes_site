export default function identifyBaseColor(hsv) {

    if(hsv.s === 0) {//integers are procents
      return "white/black"
    } else {
    const baseColors = {
      "red": [[0,13],[346,360]],
      "orange": [14,39],
      "yellow": [40,67],
      "green": [68,164],
      "blue": [165,200],
      "dark-blue": [201,240],
      "violet": [241,280],
      "pink": [281,345]
    }
  
    for (const [key, value] of Object.entries(baseColors)) {
      if(Array.isArray(value[0])) {
        let redCol =''
        value.forEach(colorArea => {
          if(hsv.h>=colorArea[0] && hsv.h<=colorArea[1]) redCol=key; 
        })
        if(redCol.length!==0) return redCol;
      } else {
        if(hsv.h>=value[0] && hsv.h<=value[1]) {
          return key
        }
      }
    }
    }

  }