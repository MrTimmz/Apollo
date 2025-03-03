<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php $invoice_id = isset($_GET['edit']) ? $_GET['edit'] : null;
        if ($invoice_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update Invoice</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add New Invoice</h1>';
        }
        ?>
    </div>

    <?php $invoices = new Invoice();
    $row = null;
    if ($invoice_id !== null) {
        $row = $invoices->getInvoicebPayDay($invoice_id);
    }
    ?>

    <form action="includes/invoice.inc.php" method="post">
        <div class="row">
            <!-- Invoice Date Created -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Invoice Date:</div>
                                <input type="date" class="form-control required" name="invoice_date" placeholder="Invoice Date" data-date-format="" value="<?= $row['invoice_created'] ?? '' ?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h1" viewBox="0 0 16 16">
                                    <path d="M8.637 13V3.669H7.379V7.62H2.758V3.67H1.5V13h1.258V8.728h4.62V13h1.259zm5.329 0V3.669h-1.244L10.5 5.316v1.265l2.16-1.565h.062V13h1.244z" />
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Due Date -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Invoice Due Date:</div>
                                <input type="date" class="form-control required" name="invoice_duedate" placeholder="Invoice Date" data-date-format="" value="<?= $row['invoice_due_date'] ?? '' ?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>

                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h1" viewBox="0 0 16 16">
                                    <path d="M8.637 13V3.669H7.379V7.62H2.758V3.67H1.5V13h1.258V8.728h4.62V13h1.259zm5.329 0V3.669h-1.244L10.5 5.316v1.265l2.16-1.565h.062V13h1.244z" />
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice number -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Invoice Number:</div>
                                <input type="text" name="invoice_id" id="invoice_id" class="form-control required" placeholder="Invoice Number" aria-describedby="sizing-addon1" value="<?= $row['invoice_refrence'] ?? '' ?>">
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h1" viewBox="0 0 16 16">
                                    <path d="M8.637 13V3.669H7.379V7.62H2.758V3.67H1.5V13h1.258V8.728h4.62V13h1.259zm5.329 0V3.669h-1.244L10.5 5.316v1.265l2.16-1.565h.062V13h1.244z" />
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Client Information: &nbsp;</h1>
            <select class="selectpicker show-tick" id="client-select">
                <option>Select Client:</option>
                <?php
                $invoice_id = $invoice_id;
                $client = new Invoice();

                // Get all clients
                $allClients = $client->getAllClients();
                $currentClient = $client->getClientByInvoiceId($invoice_id);

                foreach ($allClients as $row) {
                    $selected = ($row['client_id'] == $currentClient['client_id']) ? 'selected' : '';
                    echo "<option value='{$row['client_id']}'
                                data-id='{$row['client_id']}'
                                data-name='{$row['client_name']}'
                                data-email='{$row['client_email']}'
                                data-phone='{$row['client_phone']}'
                                data-address='{$row['client_address']}'
                                data-town='{$row['client_town']}'
                                data-province='{$row['client_province']}'
                                data-country='{$row['client_country']}'
                                $selected>{$row['client_name']}</option>";
                }
                ?>
            </select>
        </div>



        <div class="row">

            <!-- Customer / Company Name -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Client Name:</div>
                                <input type="text" style="visibility:hidden; position:absolute;" readonly class="title inputbox long" name="id">
                                <input type="text" id="client-name" readonly class="title inputbox long" name="name">
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h1" viewBox="0 0 16 16">
                                    <path d="M8.637 13V3.669H7.379V7.62H2.758V3.67H1.5V13h1.258V8.728h4.62V13h1.259zm5.329 0V3.669h-1.244L10.5 5.316v1.265l2.16-1.565h.062V13h1.244z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Client Email -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Client Email:</div>
                                <input type="text" readonly class="title inputbox long" id="client-email" name="email" />
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h2" viewBox="0 0 16 16">
                                    <path d="M7.638 13V3.669H6.38V7.62H1.759V3.67H.5V13h1.258V8.728h4.62V13h1.259zm3.022-6.733v-.048c0-.889.63-1.668 1.716-1.668.957 0 1.675.608 1.675 1.572 0 .855-.554 1.504-1.067 2.085l-3.513 3.999V13H15.5v-1.094h-4.245v-.075l2.481-2.844c.875-.998 1.586-1.784 1.586-2.953 0-1.463-1.155-2.556-2.919-2.556-1.941 0-2.966 1.326-2.966 2.74v.049h1.223z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Phone Number -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Client Phone Number:
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <input type="text" readonly class="title inputbox long" id="client-phone" name="phone" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Adress -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Client Address:
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <input type="text" readonly class="title inputbox long" id="client-address" name="address" /> <input style="width:25% !important;" type="text" class="title" name="postal" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client City -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Client City:
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <input type="text" class="title inputbox long" id="client-town" name="town" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Province -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Client Province:
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <input type="text" class="title inputbox long" id="client-province" name="province" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Country -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Client Country:
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <input type="text" class="title inputbox long" id="client-country" name="country" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Service:</h1>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" id="invoice_table">
                    <thead>
                        <tr>
                            <th><a href="#" class="btn btn-success btn-xs add-row"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>+</a>&nbsp; Product</th>
                            <th>Hours</th>
                            <th>Price per Hour</th>
                            <th>TAX / VAT</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product</th>
                            <th>Hours</th>
                            <th>Price per Hour</th>
                            <th>TAX / VAT</th>
                            <th>Sub Total</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $service = new Invoice();
                        $invoice_id = $invoice_id;
                        if ($invoice_id !== null) {
                            $rows = $service->getInvoicebyId($invoice_id); // Fetch all rows
                            if ($rows) {
                                foreach ($rows as $row) {  // Iterate through all results
                        ?>
                                    <tr>
                                        <td>
                                            <div class="form-group form-group-sm no-margin-bottom">
                                                <a style="float:left;" href="#" class="btn btn-danger btn-xs delete-row">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>-
                                                </a>
                                                &nbsp;
                                                <input style="float:left; margin-left:0.5rem; width:85%;" type="text" class="form-control form-group-sm item-input invoice_product" name="invoice_product[]" placeholder="Enter Product Name OR Description" value="<?= $row['service_name'] ?>" />
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="form-group form-group-sm no-margin-bottom">
                                                <input type="number" class="form-control calculate invoice_product_hour" name="invoice_product_hour[]" placeholder="Work Hours" step="0.25" value="<?= $row['service_hour'] ?>" />
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="input-group input-group-sm no-margin-bottom">
                                                <span class="input-group-addon"></span>
                                                <input type="number" class="form-control calculate invoice_product_price required" name="invoice_product_price[]" placeholder="0.00" step="0.01" value="<?= $row['service_price'] ?>" />
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="input-group input-group-sm no-margin-bottom">
                                                <span class="input-group-addon"></span>
                                                <input type="text" class="form-control calculate invoice_product_tax required" name="invoice_product_tax[]" placeholder="0%" value="<?= $row['service_tax'] ?>" />
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-addon"></span>
                                                <input type="text" class="form-control calculate-sub" name="invoice_product_sub[]" readonly value="<?= $row['service_total_price'] ?>" />
                                            </div>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>


        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Color System -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Additional Notes:</h6>
                    </div>
                    <div class="card-body">
                        <textarea id="editor" name="content" value="<?= $row['invoice_notes'] ?>">
                                <!-- FCK EDITOR CONTENT -->
                            </textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4" style="float: right;padding: 2.5rem;margin: 0rem 1rem auto;">
                    <div class="row" style="text-align: right !important;">
                        <div class="col-xs-4 col-xs-offset-5">
                            <strong>Sub Total:&nbsp;</strong> &nbsp; &euro; &nbsp;
                        </div>
                        <div class="col-xs-3">
                            <span class="invoice-sub-total">0.00</span>
                            <input type="hidden" name="invoice_subtotal" id="invoice_subtotal">
                        </div>
                    </div>
                    <div class="row" style="text-align: right !important;">
                        <div class="col-xs-4 col-xs-offset-5">
                            <strong>TAX/VAT:</strong> &nbsp; &euro; &nbsp;
                        </div>
                        <div class="col-xs-3">
                            <span class="invoice-vat" data-enable-vat=">" data-vat-rate="" data-vat-method="">0.00</span>
                            <input type="hidden" name="invoice_vat" id="invoice_vat">
                        </div>
                    </div>
                    <div class="row" style="text-align: right !important;">
                        <div class="col-xs-4 col-xs-offset-5">
                            <strong>Total:</strong> &nbsp; &euro; &nbsp;
                        </div>
                        <div class="col-xs-3">
                            <span class="invoice-total">0.00</span>
                            <input type="hidden" name="invoice_total" id="invoice_total">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>


    <script>
        //count total
        //count from the table id invoice_table, and calculate from invoice_table tp tbody then tr, and then find classes.
        //then echo the total in Sub Total:
        $(function() {
            $("#invoice_table").on("keyup input", ".calculate", function(event) {
                // Initialize the 'total' and 'totalTax' variables to 0.
                var total = 0;
                var totalTax = 0;

                // Loop through all the rows in the tbody of the 'invoice_table' element.
                $("#invoice_table tbody tr").each(function() {

                    // Get the quantity, rate and tax rate values from their respective input elements in the current row.
                    var qty = parseFloat($(this).find(".invoice_product_hour").val());
                    var rate = parseFloat($(this).find(".invoice_product_price").val());
                    var taxRate = parseFloat($(this).find(".invoice_product_tax").val());

                    // Calculate the subtotal and tax amount for the current row.
                    var subtotal = qty * rate;
                    var tax = subtotal * taxRate / 100;

                    // Set the values of the 'calculate-sub' and 'calculate-tax' input elements in the current row to the calculated subtotal and tax amount respectively.
                    $(this).find(".calculate-sub").val(subtotal.toFixed(2));
                    $(this).find(".calculate-tax").val(tax.toFixed(2));

                    // If the subtotal and tax values are valid numbers, add them to the 'total' and 'totalTax' variables respectively.
                    if (!isNaN(subtotal))
                        total += subtotal;
                    if (!isNaN(tax))
                        totalTax += tax;
                });

                // Update the HTML of the elements with class 'invoice-sub-total', 'invoice-vat' and 'invoice-total' to display the calculated values for the subtotal, total tax and total amount respectively.
                $(".invoice-sub-total").html(total.toFixed(2));
                $("#invoice_subtotal").val(total.toFixed(2));
                $(".invoice-vat").html(totalTax.toFixed(2));
                $("#invoice_vat").val(totalTax.toFixed(2));
                $(".invoice-total").html((total + totalTax).toFixed(2));
                $("#invoice_total").val((total + totalTax).toFixed(2));
            });

            // add new product row on invoice
            var cloned = $('#invoice_table tr:last').clone();
            $(".add-row").click(function(e) {
                e.preventDefault();
                cloned.clone().appendTo('#invoice_table');
            });

            // remove product row
            $('#invoice_table').on('click', ".delete-row", function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
                $("#invoice_table").trigger("keyup");
            });
        });
    </script>

    <script>
        document.getElementById('client-select').addEventListener('change', function() {
            // Get the selected option
            var selectedOption = this.options[this.selectedIndex];

            var clientName = selectedOption.getAttribute('data-name');
            var ClientEmail = selectedOption.getAttribute('data-email');
            var ClientPhone = selectedOption.getAttribute('data-phone');
            var ClientAddress = selectedOption.getAttribute('data-address');
            var ClientTown = selectedOption.getAttribute('data-town');
            var ClientProvince = selectedOption.getAttribute('data-province');
            var ClientCountry = selectedOption.getAttribute('data-country');

            // Update the name input field with the selected client
            document.getElementById('client-name').value = clientName;
            document.getElementById('client-email').value = ClientEmail;
            document.getElementById('client-phone').value = ClientPhone;
            document.getElementById('client-address').value = ClientAddress;
            document.getElementById('client-town').value = ClientTown;
            document.getElementById('client-province').value = ClientProvince;
            document.getElementById('client-country').value = ClientCountry;

        });

        // Trigger the event on page load
        document.getElementById('client-select').dispatchEvent(new Event('change'));
    </script>

</div>
</div>
<!-- End of Main Content -->

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(err => {
            console.error(err.stack);
        });
</script>

<?php include "footer.php"; ?>