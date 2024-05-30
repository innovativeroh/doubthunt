document.getElementById('fileInput').addEventListener('change', function(event) {
    const preview = document.getElementById('preview');
    const uploadButton = document.getElementById('uploadButton');
    preview.innerHTML = ''; // Clear previous content

    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
        uploadButton.disabled = false; // Enable the upload button
    } else {
        preview.textContent = 'No file selected';
        uploadButton.disabled = true; // Disable the upload button
    }
});