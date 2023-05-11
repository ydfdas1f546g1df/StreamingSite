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

$(document).ready(function() {
    const dropArea = $('.drop-area');

    // Prevent default drag behaviors
    $(document).on('dragenter dragover dragleave drop', function(event) {
        event.preventDefault();
        event.stopPropagation();
        // console.log(1)
    });

    // Highlight the drop area when a file is dragged over it
    dropArea.on('dragenter dragover', function() {
        dropArea.addClass('dragover');
        // console.log(2)

    });

    // Remove the highlight when a file is dragged out of the drop area
    dropArea.on('dragleave drop', function() {
        dropArea.removeClass('dragover');

    });

    // Handle dropped files
    dropArea.on('drop', function(event) {
        event.preventDefault();
        const files = event.originalEvent.dataTransfer.files;
        // Handle the dropped files as needed
        console.log(files);
        // Update the file input value with the dropped file(s)
        $('#files').prop('files', files);
        uploadForm.querySelector('label').innerHTML = '';
        for (let i = 0; i < filesInput.files.length; i++) {
            uploadForm.querySelector('label').innerHTML += '<span><i class="fa-solid fa-image fa-2x"></i>' + filesInput.files[i].name + '</span>';
        }
    });
});

uploadForm.onsubmit = event => {
    event.preventDefault();
    let seriesInput = $("#series_name")
    let descInput = $("#series_desc")
    console.log(descInput.val())
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
                uploadForm.querySelector('button').innerHTML = 'Create Series';

                $("#imagePreview").attr("src", "#")
                $("#imagePreview").attr("style", "display: none;")
                // Enable the submit button
                uploadForm.querySelector('button').disabled = false;
            }
        };
        // Set form data values
        uploadFormData.set('series_name', seriesInput.val());
        uploadFormData.set('token', token);
        uploadFormData.set('desc', descInput.val());

        // Execute request
        request.send(uploadFormData);
    }
};


const fileInput = document.getElementById('files');
const imagePreview = document.getElementById('image-preview');

fileInput.addEventListener('change', function () {
    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener('load', function () {
            imagePreview.src = reader.result;
            $(imagePreview).attr("style", "display: flex;")
        });
        reader.readAsDataURL(file);
    } else {
        imagePreview.src = '#';
    }
});

