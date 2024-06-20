import { toggleLoader } from "./scripts.js";

const uploadInp = document.querySelector("#fileToUpload");
const animationLink = document.querySelector("#animationLink");
const animationPreviewContainer = document.querySelector(".animationPreviewContainer");

uploadInp.addEventListener("input", async(e) => {
    toggleLoader(false);
        const animationName = e.target.value.slice(12);
        const body = new FormData();
        body.append('fileToUpload', e.target.files[0]);
        body.append('name', animationName.slice(0, animationName.lastIndexOf('.')));
        const response = await fetch("http://localhost/app_for_lupisvulpes_site/root/public/index.php/api/v1/googledriveapi/animations/uploadAnimation", {
            method: "POST",
            headers: {
                Accept: 'application/json',
              },
            body
        });
        const data = await response.json();
        toggleLoader(true);
        console.log(e.target.value, data.id);
        animationLink.setAttribute("value", `https://drive.google.com/file/d/${data.id}`);
        const videoPreviewElement = document.createElement("video");
        videoPreviewElement.setAttribute("src", `https://drive.google.com/uc?export=download&id=${data.id}`);
        videoPreviewElement.setAttribute("controls", `controls autoplay`);

        animationPreviewContainer.insertAdjacentElement("afterbegin", videoPreviewElement);

   
});