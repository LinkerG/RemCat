document.addEventListener('DOMContentLoaded', function() {
    const previewZone = document.querySelector('.preview-zone .box-body');
    const dropzone = document.querySelector('.dropzone');
    const competition_id = document.getElementById("cid").dataset.id
    const competition_year = document.getElementById("year").dataset.year
    console.log(competition_id);
    console.log(competition_year);    
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
        document.querySelector('.preview-zone').classList.remove('hidden');
    }

    dropzone.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });

    document.querySelector('.dropzone-wrapper').addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.add('dragover');
    });

    document.querySelector('.dropzone-wrapper').addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('dragover');
    });

    document.querySelector('.dropzone-wrapper').addEventListener('drop', function(e) {
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
        })
        .catch(error => {
            alert("Error al subir las imágenes");
            console.error('Error:', error);
        });
    });*/
});
