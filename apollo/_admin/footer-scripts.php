<?php include 'includes/vitesse.php'; ?>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>


<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


<script src="js/image-upload-preview.js"></script>
<script src="js/multi_image-upload-preview.js"></script>


<script>
    // Manage table selection
    document.querySelectorAll('.table').forEach(function(table) {
        table.addEventListener('click', function() {
            // Remove "selected" class from all tables
            document.querySelectorAll('.table').forEach(function(t) {
                t.classList.remove('selected');
            });

            // Add "selected" class to the clicked table
            table.classList.add('selected');

            // Set the hidden input value to the selected table
            document.getElementById('selected_table').value = table.dataset.table;
        });
    });

    // Manage adults and children count
    document.getElementById('num_children').addEventListener('input', function() {
        var numChildren = parseInt(this.value);
        var maxAdults = 10 - numChildren;
        var numAdultsInput = document.getElementById('num_adults');

        // Adjust max adults based on children count
        numAdultsInput.max = maxAdults;
        if (numAdultsInput.value > maxAdults) {
            numAdultsInput.value = maxAdults;
        }

        var tableSelect = document.getElementById('table');

        // Disable normal tables if children are present
        if (numChildren > 0) {
            document.querySelectorAll('.Normal').forEach(function(option) {
                option.style.display = 'none';
            });
            document.querySelectorAll('.Kids').forEach(function(option) {
                option.style.display = 'block';
            });
        } else {
            // Show all tables if no children
            document.querySelectorAll('.table').forEach(function(option) {
                option.style.display = 'block';
            });
        }
    });
</script>

<script>
    document.getElementById('end_datetime').addEventListener('change', function() {
        var start = document.getElementById('start_datetime').value;
        var end = this.value;

        if (new Date(start) >= new Date(end)) {
            alert('End time must be after start time');
            this.value = ''; // Clear the invalid end time
        }
    });
</script>

<script>
        $(function() {
            function calculateTotals() {
                var total = 0;
                var totalTax = 0;
                // Loop through all rows in the tbody of the 'invoice_table'
                $("#invoice_table tbody tr").each(function() {
                    var qty = parseFloat($(this).find(".invoice_product_hour").val()) || 0;
                    var rate = parseFloat($(this).find(".invoice_product_price").val()) || 0;
                    var taxRate = parseFloat($(this).find(".invoice_product_tax").val()) || 0;

                    // Calculate subtotal and tax for the current row
                    var subtotal = qty * rate;
                    var tax = (subtotal * taxRate) / 100;

                    // Set the calculated values in the respective inputs
                    $(this).find(".calculate-sub").val(subtotal.toFixed(2));
                    $(this).find(".calculate-tax").val(tax.toFixed(2));

                    total += subtotal;
                    totalTax += tax;
                });

                // Update the totals in the respective HTML elements
                $(".invoice-sub-total").html(total.toFixed(2));
                $("#invoice_subtotal").val(total.toFixed(2));
                $(".invoice-vat").html(totalTax.toFixed(2));
                $("#invoice_vat").val(totalTax.toFixed(2));
                $(".invoice-total").html((total + totalTax).toFixed(2));
                $("#invoice_total").val((total + totalTax).toFixed(2));
            }

            // Calculate totals on input or keyup event
            $("#invoice_table").on("keyup input", ".calculate", function(event) {
                calculateTotals();
            });

            // Add new product row on invoice
            $(".add-row").click(function(e) {
                e.preventDefault();
                var newRow = $('#invoice_table tbody tr:last').clone(); // Clone the last row
                newRow.find("input").val(""); // Clear all input fields

                // Specifically clear the service_id field to prevent overwriting existing records
                newRow.find('input[name="service_id[]"]').val(''); // Clear service_id for new row

                newRow.appendTo('#invoice_table tbody'); // Append the new row to the tbody
                calculateTotals(); // Recalculate totals after adding a new row
            });

            let deletedServices = []; // Array to track deleted services

            // Remove product row
            $('#invoice_table').on('click', ".delete-row", function(e) {
                e.preventDefault();

                // Get the service ID of the row being deleted
                const serviceId = $(this).closest('tr').find('input[name="service_id[]"]').val();

                // If the service ID is not empty, add it to the deletedServices array
                if (serviceId) {
                    deletedServices.push(serviceId);
                }

                $(this).closest('tr').remove(); // Remove the closest row
                calculateTotals(); // Recalculate totals after row removal
            });

            // When the form is submitted (for update), append the deleted service IDs
            $('form').on('submit', function() {
                if (deletedServices.length > 0) {
                    // Add deleted services as a hidden input field to send to the server
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'deleted_services',
                        value: JSON.stringify(deletedServices)
                    }).appendTo(this);
                }
            });

            // Initial calculation on page load (when editing an invoice)
            calculateTotals();
        });
    </script>


    <script>
        document.getElementById('client-select').addEventListener('change', function() {
            // Get the selected option
            var selectedOption = this.options[this.selectedIndex];

            var ClientId = selectedOption.getAttribute('data-id');
            var ClientName = selectedOption.getAttribute('data-name');
            var ClientEmail = selectedOption.getAttribute('data-email');
            var ClientPhone = selectedOption.getAttribute('data-phone');
            var ClientAddress = selectedOption.getAttribute('data-address');
            var Clientzipcode = selectedOption.getAttribute('data-zipcode');
            var ClientTown = selectedOption.getAttribute('data-town');
            var ClientProvince = selectedOption.getAttribute('data-province');
            var ClientCountry = selectedOption.getAttribute('data-country');

            // Update the name input field with the selected client
            document.getElementById('client-id').value = ClientId;
            document.getElementById('client-name').value = ClientName;
            document.getElementById('client-email').value = ClientEmail;
            document.getElementById('client-phone').value = ClientPhone;
            document.getElementById('client-address').value = ClientAddress;
            document.getElementById('client-zipcode').value = Clientzipcode;
            document.getElementById('client-town').value = ClientTown;
            document.getElementById('client-province').value = ClientProvince;
            document.getElementById('client-country').value = ClientCountry;

        });

        // Trigger the event on page load
        document.getElementById('client-select').dispatchEvent(new Event('change'));
    </script>

<script>
$(document).ready(function() {
    // Check if the editor is already initialized
    if ($('#editor').data('editor-initialized') !== true) {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                window.editor = editor; // Store editor instance globally for use
                $('#editor').data('editor-initialized', true); // Mark it as initialized

                // Listen for changes in the content
                editor.model.document.on('change:data', function() {
                    var content = editor.getData(); // Get the editor content (HTML)

                    // Clean up the content: remove HTML tags and non-alphanumeric characters
                    var text = content.replace(/<[^>]+>/g, ' ')  // Remove HTML tags
                                       .replace(/[^a-zA-Z0-9\s]/g, '')  // Remove non-alphanumeric characters
                                       .toLowerCase();  // Convert to lowercase

                    // Split the cleaned-up text into words
                    var words = text.split(/\s+/);

                    // Remove stop words (small common words)
                    var stopWords = ['a', 'an', 'the', 'and', 'of', 'to', 'in', 'on', 'for', 'with'];
                    var filteredWords = words.filter(word => !stopWords.includes(word) && word.length > 2);

                    // Generate SEO keywords (comma-separated)
                    var seoKeywords = filteredWords.join(', ');

                    // Update the SEO Keywords field with the generated keywords
                    $('.seo_keywords').val(seoKeywords); // Update the input value
                });
            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
            });
    }
});

</script>
