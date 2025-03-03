// Get the file input field and the image preview container
var input = document.querySelector('#images');
var preview = document.querySelector('#image-preview');

// Listen for the file input change event
input.addEventListener('change', updateImagePreview);

// Function to handle the file input change event
function updateImagePreview() {
   // Remove any existing preview images from the preview
   preview.innerHTML = '';

   // Get the selected files
   var files = input.files;

   // Loop through the selected files
   for (var i = 0; i < files.length; i++) {
      // Create a new image element
      var img = document.createElement('img');
      img.classList.add('preview-image');

      // Set the image source to the selected file
      img.src = URL.createObjectURL(files[i]);

      // Create a delete button for the image
      var deleteBtn = document.createElement('button');
      deleteBtn.classList.add('btn', 'btn-danger', 'delete-image');
      deleteBtn.innerHTML = '<i class="fa fa-trash"></i>';

      // Add a click event listener to the delete button
      deleteBtn.addEventListener('click', function(e) {
         // Get the corresponding image and remove it from the preview
         var imageContainer = e.target.closest('.preview-container');
         imageContainer.remove();

         // Remove the corresponding file from the input's files array
         var newFiles = Array.from(input.files).filter(function(file) {
            return file != files[i];
         });
         input.files = newFiles;

         // Update the custom file label with the number of selected files
         var label = document.querySelector('.custom-file-label');
         if (newFiles.length > 1) {
            label.textContent = newFiles.length + ' files selected';
         } else if (newFiles.length === 1) {
            label.textContent = newFiles[0].name;
         } else {
            label.textContent = 'Choose file';
         }
      });

      // Create a container for the image and the delete button
      var container = document.createElement('div');
      container.classList.add('preview-container');
      container.appendChild(img);
      container.appendChild(deleteBtn);

      // Append the container to the preview container
      preview.appendChild(container);
   }

   // Update the custom file label with the number of selected files
   var label = document.querySelector('.custom-file-label');
   if (files.length > 1) {
      label.textContent = files.length + ' files selected';
   } else if (files.length === 1) {
      label.textContent = files[0].name;
   } else {
      label.textContent = 'Choose file';
   }
}
