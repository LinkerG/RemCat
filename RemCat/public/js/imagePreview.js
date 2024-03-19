window.addEventListener('load', function () {
    let inputsFile = document.querySelectorAll('input[type="file"]');
    
    for (let i = 0; i < inputsFile.length; i++) {
        const inputFile = inputsFile[i];
        
        inputFile.addEventListener('change', function(event) {
            let id = inputFile.id;
            let previewId = id.replace(/^image/, "preview");
            let input = event.target;
            let reader = new FileReader();
        
            reader.onload = function(){
                let dataURL = reader.result;
                let previewImage = document.getElementById(previewId);
                previewImage.src = dataURL;
            };
        
            reader.readAsDataURL(input.files[0]);
        });
    }
});
