selectImg.onchange = evt => {
    preview = document.getElementById('image-preview');
    fileName = document.getElementById('file-upload-name')
    preview.style.display = 'block';
    const [file] = selectImg.files

    if (file) {
        preview.src = URL.createObjectURL(file)
        fileName.value = file['name']
    }
}
