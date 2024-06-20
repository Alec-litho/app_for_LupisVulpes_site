const previewLink = document.querySelector("#previewLink");
const preview = document.querySelector(".preview");
preview.addEventListener("input", (e) => {
    const imgName = e.target.value.slice(12);
    const rf = new FileReader();
    rf.readAsDataURL(e.target.files[0]);
    rf.onload = async function (file) {
        let image = new Image();
        image.src = file.target.result;
        image.onload = function() {
            const body = new FormData();
            body.append('image', file.target.result.split(',').pop());
            body.append('name', imgName.slice(0, imgName.lastIndexOf('.')));
            fetch('https://api.imgbb.com/1/upload?key=1e194d99cc989dab9340726349f27b2d', { method: 'POST', body })
            .then(res => res.json())
            .then(res => previewLink.setAttribute("value", res.data.url))
            .catch(err => console.log(err))
        }
    }
})