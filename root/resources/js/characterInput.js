const input = document.querySelector('.characters');

const characters = [
    "Litho",
    "ShowTime",
    "Writer",
    "Rags",
    "Mingue",
    "X",
    "Toony",
    "SadBlueRabbit",
    "Simon",
    "Talty",
    "Toshie",
    "Red",
    "Randy",
    "Willis"
];

// let lastVal = ''
input.addEventListener('input', function() {
    // this.value.split('').slice(lastVal.length-1,this.value.length-1)
    let currText = this.value;
    lastVal=this.value;
    let currIndx = currText.length-1<0? 1 : currText.length
    if(currText!=='') {
        characters.forEach(character => {
            if(character.search(currText)!==-1) {
                console.log(this.value,currIndx);
                this.value = character;
                this.setSelectionRange(currIndx,currIndx);
                
            }
        })
    }

});

/*Алгоритм такой 
 - Подльзователь пишет букву
 - Функция проходит по массиву и ищет к какому именне подходит эта буква
 - В инпут записывается подходящий персонаж
 - Если пользователь продолжает писать буквы то это имя уирается и ищется новое имя


*/