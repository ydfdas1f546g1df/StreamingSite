$("input[required]").each(function () {
    $(this).parent().find("span").append("<span style='color: rgb(255, 100, 16);'>*</span>");
});

// $(document).ready(function() {
//     var uploadForm = document.querySelector('#uploadForm');
//     var filesInput = document.querySelector('#filesInput');
//     var seriesInput = document.querySelector('#seriesInput');
//     var seasonInput = document.querySelector('#seasonInput');
//     var episodeInput = document.querySelector('#episodeInput');
//     var episodeNameInput = document.querySelector('#episodeNameInput');
//
//     // Update label with file names
//     $('#filesInput').on('change', function() {
//         $('#uploadForm label').html('');
//         for (var i = 0; i < filesInput.files.length; i++) {
//             $('#uploadForm label').append('<span><i class="fa-solid fa-file"></i>' + filesInput.files[i].name + '</span>');
//         }
//     });
//
//     // Handle form submission
//     $('#uploadForm').submit(function(event) {
//         event.preventDefault();
//
//         // Check if files are selected
//         if (!filesInput.files.length) {
//             $('#uploadForm .result').html('Please select a file!');
//         } else {
//             // Create form data object
//             let uploadFormData = new FormData(uploadForm);
//
//             uploadFormData.set('series_name', seriesInput.value);
//             uploadFormData.set('season_number', seasonInput.value);
//             uploadFormData.set('episode_number', episodeInput.value);
//             uploadFormData.set('episode_name', episodeNameInput.value);
//             // Initiate AJAX request
//             $.ajax({
//                 url: "/api/uploadFile.php",
//                 type: 'POST',
//                 data: uploadFormData,
//                 processData: false,
//                 contentType: false,
//                 xhr: function() {
//                     var xhr = new XMLHttpRequest();
//                     // Add progress event listener
//                     xhr.upload.addEventListener('progress', function(event) {
//                         // Update button text with current progress
//                         $('#uploadForm button').html('Uploading... ' + '(' + ((event.loaded/event.total)*100).toFixed(2) + '%)');
//                         // Update progress bar
//                         $('#uploadForm .progress').css('background', 'linear-gradient(to right, #25b350, #25b350 ' + Math.round((event.loaded/event.total)*100) + '%, #e6e8ec ' + Math.round((event.loaded/event.total)*100) + '%)');
//                         // Disable submit button
//                         $('#uploadForm button').prop('disabled', true);
//                     });
//                     return xhr;
//                 },
//                 success: function(response) {
//                     // Output response message
//                     $('#uploadForm .result').html(response);
//                     // Reset form fields
//                     uploadForm.reset();
//                     // Reset file input label
//                     $('#uploadForm label').html('<i class="fa-solid fa-folder-open fa-2x"></i>Select files ...');
//                     // Reset progress bar
//                     $('#uploadForm .progress').css('background', '');
//                     // Reset button
//                     $('#uploadForm button').html('Upload');
//                     // Enable submit button
//                     $('#uploadForm button').prop('disabled', false);
//                 }
//             });
//
//             // Set form data values
//         }
//     });
// });

// Declare global variables for easy access
const uploadForm = document.querySelector('.upload-form');
const filesInput = uploadForm.querySelector('#files');
const seriesInput = uploadForm.querySelector('[name="series_name"]');
const seasonInput = uploadForm.querySelector('#season_number');
const episodeInput = uploadForm.querySelector('#episode_number');
const episodeNameInput = uploadForm.querySelector('#episode_name');

filesInput.onchange = () => {
    // Append all the file names to the label
    uploadForm.querySelector('label').innerHTML = '';
    for (let i = 0; i < filesInput.files.length; i++) {
        uploadForm.querySelector('label').innerHTML += '<span><i class="fa-solid fa-file"></i>' + filesInput.files[i].name + '</span>';
    }
};

uploadForm.onsubmit = event => {
    event.preventDefault();
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
            uploadForm.querySelector('button').innerHTML = 'Uploading... ' + '(' + ((event.loaded/event.total)*100).toFixed(2) + '%)';
            // Update the progress bar
            uploadForm.querySelector('.progress').style.background = 'linear-gradient(to right, #25b350, #25b350 ' + Math.round((event.loaded/event.total)*100) + '%, #e6e8ec ' + Math.round((event.loaded/event.total)*100) + '%)';
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
        uploadFormData.set('series_name', seriesInput.value);
        uploadFormData.set('season_number', seasonInput.value);
        uploadFormData.set('episode_number', episodeInput.value);
        uploadFormData.set('episode_name', episodeNameInput.value);
        // Execute request
        request.send(uploadFormData);
    }
};

