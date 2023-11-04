function validateFileSize(){

    const file = document.getElementById("photo");

    const fileSize = (file.files[0].size);

    if(fileSize > 2 * 1024 * 1024) {

        alert("File size must be less than 2 MB.");

        file.value = '';

        return false;
    }
}