document.addEventListener('DOMContentLoaded', function() {
    const previewZone = document.querySelector('.preview-zone .box-body');
    const dropzone = document.querySelector('.dropzone');
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

    document.getElementById('upload-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData();
        fileArray.forEach(file => formData.append('images[]', file));

        fetch("{{ route('your-upload-route') }}", {
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
    });
});
