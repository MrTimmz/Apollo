<?php
    include 'includes/class-autoload.inc.php';
    ?>
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="ckeditor.js"></script>
<script src="ckeditor.js.map"></script>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    @page {
        bleed: 1cm;
        size: A4 portrait;
        size: auto;
        /* auto is the initial value */
        margin-left: 0mm;
        /* this affects the margin in the printer settings */
        margin-bottom: 0mm;
        margin-top: 0mm;

        html {
            background-color: #FFFFFF;
            margin: 0px;
            /* this affects the margin on the html before sending to printer */
        }

        body {
            border: solid 1px blue;
            margin: 10mm 15mm 10mm 15mm;
            /* margin you want for the content */
        }
    }

    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    body {
        background: #eee;
        font-familly: roboto;
        -webkit-print-color-adjust: exact !important;
    }

    div.container { border-radius: 15px; background: white; box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2); }
    div.invoice-letter { width: auto; position: relative; min-height: 150px; background-color: #04617B; margin-right: -48px; margin-left: -48px; box-shadow: 0 4px 3px rgba(0, 0, 0, 0.4); }

    div.letter-title { margin-top: 10px; height: 130px; border-right: 2px solid #eee; }
    div.letter-content { margin-top: 10px; }

    table.invoice thead th { background-color: rgba(4, 97, 123, 0.2); border-top: none; }
    table.invoice thead tr:first-child th:first-child { border-top-left-radius: 25px; }
    table.invoice thead tr:first-child th:last-child { border-top-right-radius: 25px; }

    tr.last-row { background-color: rgba(4, 97, 123, 0.2); }
    tr.last-row th { border-bottom-left-radius: 25px; width: 30px; }
    tr.last-row td { border-bottom-right-radius: 25px; }

    div.row div.to { height: 260px; padding-right: 25px; border-right: 2px solid rgba(4, 97, 123, 0.2); }
</style>
    <?php
        if (isset($_GET['view'])) {
            $editinvoiceObj = new Invoice();
            $editinvoiceObj->showInovice($_GET['view']);
        }
    ?>