function validateFileSize(){

    const file = document.getElementById('photo');

    const fileSize = (file.files[0].size);

    if(fileSize > 1 * 1024 * 1024){

        alert("File size must be less than 1 MB.");

        file.value = '';

        return false;
    }
}