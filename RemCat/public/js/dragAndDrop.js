document.addEventListener('DOMContentLoaded', function() {
    const previewZone = document.querySelector('.preview-zone .box-body');
    const dropzone = document.querySelector('.dropzone');
    const dropzoneWrapper = document.querySelector('.dropzone-wrapper');
    const inputElement = dropzone;  // Assuming dropzone is the file input element

    let fileArray = [];

    function readFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const htmlPreview = `
                <div class="box" data-file-name="${file.name}">
                    <img src="${e.target.result}" alt="Imagen">
                    <p>${file.name}</p>
                    <button type="button" class="btn btn-danger btn-xs remove-preview">
                        <i class="fa fa-times"></i> Eliminar
                    </button>
                </div>`;
            previewZone.insertAdjacentHTML('beforeend', htmlPreview);
        };
        reader.readAsDataURL(file);
    }

    function handleFiles(files) {
        for (let file of files) {
            fileArray.push(file);
            readFile(file);
        }
        updateInputFiles();
        document.querySelector('.preview-zone').classList.remove('hidden');
    }

    function updateInputFiles() {
        // Clear the input element files
        inputElement.value = '';
        
        // Create a DataTransfer object to hold the files
        const dataTransfer = new DataTransfer();
        fileArray.forEach(file => dataTransfer.items.add(file));
        
        // Assign the files to the input element
        inputElement.files = dataTransfer.files;
    }

    dropzone.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });

    dropzoneWrapper.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.add('dragover');
    });

    dropzoneWrapper.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('dragover');
    });

    dropzoneWrapper.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-preview')) {
            const fileName = e.target.closest('.box').getAttribute('data-file-name');
            fileArray = fileArray.filter(file => file.name !== fileName);
            e.target.closest('.box').remove();
            updateInputFiles();
        }
    });

    /*document.getElementById('upload-form').addEventListener('submit', function(e) {
        const formData = new FormData();
        formData.append("competition_id", competition_id);
        formData.append("competition_year", competition_year);
        fileArray.forEach(file => formData.append('images[]', file));

        fetch("/api/uploadImages", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert("Imágenes subidas correctamente");
            data.images.forEach(image => {
                const htmlPreview = `
                    <div class="box">
                        <img src="${image.url}" alt="Imagen">
                        <p>${image.name}</p>
                        <button type="button" class="btn btn-danger btn-xs remove-preview">
                            <i class="fa fa-times"></i> Eliminar
                        </button>
                    </div>`;
                previewZone.insertAdjacentHTML('beforeend', htmlPreview);
            });
            fileArray = []; // Reset the file array after successful upload
            updateInputFiles(); // Ensure the input files are reset as well
        })
        .catch(error => {
            alert("Error al subir las imágenes");
            console.error('Error:', error);
        });
    });*/
});
