<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Invoice overview</h6>
            <a href="invoice.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Create New Invoice</span>
            </a>
        </div>

        <div class="card-header py-3">

            <a href="invoice-settings.php" style="float:right;" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Invoice Settings</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Invoice Date</th>
                            <th>Invoice Due Date</th>
                            <th>Invoice Number</th>
                            <th>Invoice Price</th>
                            <th>Invoice Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Client</th>
                            <th>Invoice Date</th>
                            <th>Invoice Due Date</th>
                            <th>Invoice Number</th>
                            <th>Invoice Price</th>
                            <th>Invoice Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $invoiceObj = new Invoice();
                        $invoiceObj->getInvoice(); ?>

                        <?php
                        if (isset($_GET['update'])) {
                            $changeinvoice = new Invoice();
                            $changeinvoice->changeInvoices($_GET['update']);
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include "footer.php"; ?>