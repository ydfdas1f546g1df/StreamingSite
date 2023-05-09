$("input[required], textarea[required]").each(function () {
    $(this).parent().find("span").append("<span style='color: rgb(255, 100, 16);'>*</span>");
});
const cookies = document.cookie.split(';');

let token
function getCookie() {
    // console.log(cookies)
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].split('=');
        if (cookie[0] === "token") {
            token = cookie[1];
            // console.log(token)
        }
    }
}

getCookie()

// Declare global variables for easy access
const uploadForm = document.querySelector('.upload-form');
const filesInput = uploadForm.querySelector('#files')

filesInput.onchange = () => {
    // Append all the file names to the label
    uploadForm.querySelector('label').innerHTML = '';
    for (let i = 0; i < filesInput.files.length; i++) {
        uploadForm.querySelector('label').innerHTML += '<span><i class="fa-solid fa-image"></i>' + filesInput.files[i].name + '</span>';
    }
};

uploadForm.onsubmit = event => {
    event.preventDefault();
    let seriesInput = $("#series_name")
    let descInput = $("#series_desc")
    // Make sure files are selected
    if (!filesInput.files.length) {
        uploadForm.querySelector('.result').innerHTML = 'Please select a file!';
    } else {
        // Create the form object
        let uploadFormData = new FormData(uploadForm);
        // Initiate the AJAX request
        let request = new XMLHttpRequest();
        // Ensure the request method is POST
        request.open('POST', uploadForm.action);
        // Attach the progress event handler to the AJAX request
        request.upload.addEventListener('progress', event => {
            // Add the current progress to the button
            uploadForm.querySelector('button').innerHTML = 'Uploading... ' + '(' + ((event.loaded / event.total) * 100).toFixed(2) + '%)';
            // Update the progress bar
            uploadForm.querySelector('.progress').style.background = 'linear-gradient(to right, #25b350, #25b350 ' + Math.round((event.loaded / event.total) * 100) + '%, #e6e8ec ' + Math.round((event.loaded / event.total) * 100) + '%)';
            // Disable the submit button
            uploadForm.querySelector('button').disabled = true;
        });
        // The following code will execute when the request is complete
        request.onreadystatechange = () => {
            if (request.readyState === 4 && request.status === 200) {
                // Output the response message
                uploadForm.querySelector('.result').innerHTML = request.responseText;
                // Reset the form fields
                uploadForm.reset();
                // Reset the file input label
                uploadForm.querySelector('label').innerHTML = '<i class="fa-solid fa-folder-open fa-2x"></i>Select files ...';
                // Reset the progress bar
                uploadForm.querySelector('.progress').style.background = '';
                // Reset the button
                uploadForm.querySelector('button').innerHTML = 'Upload';
                // Enable the submit button
                uploadForm.querySelector('button').disabled = false;
            }
        };
        // Set form data values
        uploadFormData.set('series_name', seriesInput.val());
        uploadFormData.set('token', token);

        // Execute request
        request.send(uploadFormData);
    }
};

