let resultIsReady = false;
const loader = document.querySelector('#loader');
const img = document.querySelector('.form-control').addEventListener('input', e => postImage(e.target));
const resultInp = document.querySelector('.result');
resultInp.addEventListener('mousedown', e => {
    if(!resultIsReady) e.preventDefault();
});


function postImage (target) {//saves image to 'imgbb.com' server
    setLoader()
    const imgName = target.value.slice(12);
    const rf = new FileReader();
    rf.readAsDataURL(target.files[0]);
    rf.onload = async function (event) {
        const body = new FormData();
        body.append('image', event.target.result.split(',').pop())
        body.append('name', imgName.slice(0, imgName.lastIndexOf('.')))
        fetch('https://api.imgbb.com/1/upload?key=1e194d99cc989dab9340726349f27b2d', { method: 'POST', body })
          .then((res) => res.json()).then((res) => {
            resultIsReady = true
            console.log(resultInp);
            resultInp.value = res.data.url
            setLoader()
          })
      }
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