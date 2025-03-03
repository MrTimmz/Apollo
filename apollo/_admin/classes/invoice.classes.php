<?php


class Invoice extends Dbh
{

    public function showInovice($invoice_id = null)
    {
        $invoice_id = isset($_GET['view']) ? $_GET['view'] : null;

        // Start output buffering
        ob_start();

        //retrieve existing data if invoice_id is set
        if ($invoice_id) {
            $stmt = $this->connect()->prepare('SELECT * FROM services
        INNER JOIN invoices ON services.service_invoice_id = invoices.invoice_id INNER JOIN customers ON invoices.invoice_client = customers.client_id INNER JOIN invoice_settings WHERE invoice_id = ?');
            $stmt->execute(array($invoice_id));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $invoice = $rows[0];
        }
        require_once('tcpdf/tcpdf.php');
        // Create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Care by Josie');
        $pdf->SetAuthor('Care by Josie');
        $pdf->SetTitle('Factuur');
        $pdf->SetSubject('Factuur');

        // Add a page
        $pdf->AddPage();

        // Set font

        // Set HTML content

        $html = '
            <style>
                table, tr, td {  color:#858796; font-family:Nunito,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"; font-weight:400; text-align:left; line-height:8px;}
                table, thead, tr, th {padding-top:10px !important; padding-bottom:10px !important; font-size:10px;}
            </style>
            <table>
                <tbody>
                    <tr>
                        <td style="font-size:8px;">
                            <h2>' . $invoice['invoice_companyname'] . '</h2>
                            <h4 style="font-style:italic;">' . $invoice['invoice_companystreet'] . '</h4>
                            <h4 style="font-style:italic;">' . $invoice['invoice_companyzipcode'] . '&nbsp;' . $invoice['invoice_companycity'] . '</h4>
                            <h4 style="font-style:italic;">KVK: <span style="font-weight:normal !important;">' . $invoice['invoice_companyhandleregistrer'] . '</span></h4>
                            <h4 style="font-style:italic;">BTW <span style="font-weight:normal !important;">' . $invoice['invoice_companyvat'] . '</span></h4>
                            <h4 style="font-style:italic;">IBAN: <span style="font-weight:normal !important;">' . $invoice['invoice_companybank'] . '</span></h4>
                        </td>
                        <td style="font-size:8px; text-align:center;">';

        if ($invoice['invoice_status'] == 'review') {
            $html .= '<h1 style="color:red;">DRAFT</h1>
                                <img src="http://localhost/apollo/uploads/invoice/' . $invoice['invoice_settings_logo'] . '" height="115px"/>';
        } else {
            $html .= '<img src="http://localhost/apollo/uploads/invoice/' . $invoice['invoice_settings_logo'] . '" height="115px"/>';
        }
        $html .= '
                        </td>
                        <td style="font-size:12px; text-align:right; line-height:12px;">
                            <h5 style="font-weight:normal !important;">Factuur Nummer: ' . $invoice['invoice_refrence'] . '</h5>
                            <h5 style="font-weight:normal !important;">Factuur Verzonden: ' . $invoice['invoice_date'] . '</h5>
                            <h5 style="font-weight:normal !important;">Factuur te betalen:  ' . $invoice['invoice_due_date'] . '</h5>
                        </td>
                    </tr>

                </tbody>
            </table>


            <table style="background-color:#04617B; ">
                <tbody>
                    <tr style="vertical-align: top; text-align:top !important;">';
        if ($invoice['invoice_notes'] == '') {
            $html .= '<td style="height:100px; color:white;">
                    </td>';
        } else {
            $html .= '
                        <td style="height:100px; color:white; width:150px; border-right: solid 2px #ffffff; ">
                        <p>&nbsp;NOTES</p>
                    </td>
                    <td style="height:100px; color:white; width:385px; border-right: solid 2px #ffffff;">
                    &nbsp; ' . $invoice['invoice_notes'] . '
                        </td>';
        }
        $html .= '


                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr style="font-weight:bold; background-color:#cddfe5;">
                        <th class="header-cell" style="height:25px; width:288px;"><span>Diensten</span></th>
                        <th class="header-cell" style="height:25px; width:50px;"><span>Uur</span></th>
                        <th class="header-cell" style="height:25px; width:75;"><span>Uur Tarief</span></th>
                        <th class="header-cell" style="height:25px; width:50px;"><span>BTW</span></th>
                        <th class="header-cell" style="height:25px; width:75px;"><span>Totaal exc BTW</span></th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($rows as $invoice) {
            $html .= '
                        <tr>
                            <td style=" font-size:9px; line-height:12px; height:25px; border-bottom: 1px solid ##e3e6f0; width:288px;"><span>' . $invoice['service_name'] . '</span></td>
                            <td style=" font-size:9px; line-height:12px; height:25px; border-bottom: 1px solid ##e3e6f0; width:75;"><span>' . $invoice['service_hour'] . '</span></td>
                            <td style=" font-size:9px; line-height:12px; height:25px; border-bottom: 1px solid ##e3e6f0; width:50px;"><span>' . $invoice['service_price'] . '</span></td>
                            <td style=" font-size:9px; line-height:12px; height:25px; border-bottom: 1px solid ##e3e6f0; width:50px;"><span>' . $invoice['service_tax'] . '</span></td>
                            <td style=" font-size:9px; line-height:12px; height:25px; border-bottom: 1px solid ##e3e6f0; width:75px;"><span>' . $invoice['service_total_price'] . '</span></td>
                        </tr>
                        ';
        }
        $html .= '
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td style="font-size:8px; text-align:left;">
                        <span style="font-size:10px !important;" >Invoiced to:</span><h2> ' . $invoice['client_name'] . '</h2>
                            <h4 style="font-style:italic;">' . $invoice['client_address'] . '&nbsp;' . $invoice['client_zipcode'] . '</h4>
                            <span style="font-weight:normal !important;">' . $invoice['client_province'] . '&nbsp;' . $invoice['client_country'] . '</span>

                        </td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right;">
                            <h4 style="font-weight:bold !important;">Subtotal exc BTW:</h4>
                            <h4 style="font-weight:bold !important;">BTW:</h4>
                            <h4 style="font-weight:bold !important;">Total inc BTW:</h4>
                        </td>
                        <td style="text-align:right;">
                            <h4> &euro; ' . $invoice['invoice_subtotal'] . '</h4>
                            <h4> &euro; ' . $invoice['invoice_tax'] . '</h4>
                            <h4> &euro; ' . $invoice['invoice_total'] . '</h4>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td style="text-align:center;">
                         *Het totaal bedrag is inclusief het aangegeven BTW Wij verzoeken u vriendelijk om het totaal bedrag over te maken aan:
naar het rekening nummer vermeld boven aan het factuur binnen 30 dagen op naam van Care By Josie
                        </td>
                    </tr>
                </tbody>
            </table>
        ';

        // Write HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output('factuur-' . $invoice['invoice_refrence'] . '.pdf', 'D', true);

        // Flush output buffer and send PDF file to browser
        ob_end_flush();
    }

    public function getInvoicebyPayDay($invoice_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM invoices
        INNER JOIN services ON invoices.invoice_id = services.service_invoice_id
        INNER JOIN customers ON invoices.invoice_client = customers.client_id WHERE invoice_id = ?');
        $stmt->execute(array($invoice_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInvoiceById($invoice_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM invoices
        INNER JOIN customers ON invoices.invoice_client = customers.client_id
        LEFT JOIN services ON invoices.invoice_id = services.service_invoice_id
        WHERE invoice_id = ? AND service_deleted IS NULL');
        $stmt->execute(array($invoice_id));

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if services are missing (new invoice or no services added)
        if (empty($result) || empty($result[0]['service_name'])) {
            // Add a default empty row for services if none exist
            $result[] = ['service_name' => '', 'service_hour' => '', 'service_price' => '', 'service_tax' => '', 'service_total_price' => ''];
        }

        return $result;
    }


    public function getInvoice()
    {
        $sql = 'SELECT * FROM customers JOIN invoices ON customers.client_id = invoices.invoice_client';
        $stmt = $this->connect()->query($sql);

        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["client_name"] . '</td>';
            echo '<td> ' . $row["invoice_date"] . '</td>';
            echo '<td>' . $row["invoice_due_date"] . '</td>';
            echo '<td>' . $row["invoice_refrence"] . '</td>';
            echo '<td>&euro;&nbsp;' . $row["invoice_total"] . '</td>';
            if ($row["invoice_status"] == "review") {
                echo '<td>';
                echo '<a target="_window" href="invoice_template.php?view=' . $row["invoice_id"] . '" class="btn btn-secondary btn-block">' . $row["invoice_status"] . '</a></td>';
                echo ' <td><a href="?update=' . $row["invoice_id"] . '" class="btn btn-success btn-block">Change Status</a>';
                echo ' <a href="invoice.php?edit=' . $row["invoice_id"] . '" class="btn btn-warning btn-block">Edit</a></td>';
            } else {
                echo '<td><button type="button" class="btn btn-success btn-block">' . $row["invoice_status"] . '</button></td>';

                echo '<td>';
                echo '<a target="_window" href="invoice_template.php?view=' . $row["invoice_id"] . '" class="btn btn-info btn-block">Download PDF</a>';
                echo '<a target="_window" href="invoice_template.php?view=' . $row["invoice_id"] . '" class="btn btn-primary btn-block">Send Invoice</a>';
                echo '</td>';
            }
            echo '</tr>';
        }
    }

    public function changeInvoices($id)
    {
        $sql = 'UPDATE invoices SET invoice_status = "open" WHERE invoice_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "<script>location.href='invoice-overview.php';</script>";
    }

    public function getDeletedInvoice()
    {
        $sql = 'SELECT * FROM menu WHERE menu_deleted IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["menu_title"] . '</td>';
            echo '<td> ' . $row["menu_page_title"] . '</td>';
            echo '<td>' . $row["menu_order"] . '</td>';
            echo '<td>' . $row["menu_status"] . '</td>';
            echo '<td>' . $row["menu_created"] . '</td>';
            echo '<td>
                    <a href="?return=' . $row["invoice_id"] . '" class="btn btn-google btn-user btn-block chartjs-render-monitor" >Return</a>
                    <a href="?trash=' . $row["invoice_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function trashInvoice($id)
    {
        $sql = 'DELETE FROM menu  WHERE invoice_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='pages-deleted.php';</script>";
    }

    public function returnInvoice($id)
    {
        $sql = 'UPDATE menu SET menu_deleted = NULL WHERE invoice_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='pages-overview.php';</script>";
    }

    protected function setInvoice($date, $duedate, $invoicerefernce, $invoiceclient, $service, $hours, $price, $btw, $worksubtotal, $subtotaal, $totaltax, $total, $invoicecontent)
    {
        $conn = $this->connect();

        // Insert data into the invoices table
        $stmt = $conn->prepare('INSERT INTO invoices(`invoice_date`, `invoice_due_date`, `invoice_refrence`, `invoice_client`,  `invoice_subtotal`, `invoice_tax`, `invoice_total`, `invoice_notes`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

        if (!$stmt->execute(array($date, $duedate, $invoicerefernce, $invoiceclient, $subtotaal, $totaltax, $total, $invoicecontent))) {
            $stmt = null;
            exit();
        }

        // Get the ID of the last inserted row in the invoices table
        $invoice_id = $conn->lastInsertId();
        $stmt = $conn->prepare('INSERT INTO services (`service_invoice_id`, `service_name`, `service_hour`, `service_price`, `service_tax`, `service_total_price`) VALUES (?, ?, ?, ?, ?, ?)');
        foreach ($service as $key => $product) {
            $hour = $hours[$key];
            $prices = $price[$key];
            $tax = $btw[$key];
            $work = $worksubtotal[$key];
            if (!$stmt->execute(array($invoice_id, $product, $hour, $prices, $tax, $work))) {
                $stmt = null;
                exit();
            }
        }
        $stmt = null;
    }

    public function getAllClients()
    {
        $stmt = $this->connect()->query('SELECT * FROM customers');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientByInvoiceId($invoice_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM customers
        INNER JOIN invoices ON customers.client_id = invoices.invoice_client
        WHERE invoice_id = ?');
        $stmt->execute([$invoice_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateInvoices($invoice_id, $date, $duedate, $invoiceid, $invoiceclient, $service, $hours, $price, $btw, $worksubtotal, $subtotaal, $totaltax, $total, $invoicecontent, $service_id, $deletedServices)
    {
        $conn = $this->connect();

        // Update the data in the invoices table
        $stmt = $conn->prepare('UPDATE invoices SET `invoice_client`=?, `invoice_date`=?, `invoice_due_date`=?, `invoice_refrence`=?, `invoice_subtotal`=?, `invoice_tax`=?, `invoice_total`=?, `invoice_notes`=? WHERE `invoice_id`=?');
        if (!$stmt->execute(array($invoiceclient, $date, $duedate, $invoiceid, $subtotaal, $totaltax, $total, $invoicecontent, $invoice_id))) {
            $stmt = null;
            exit();
        }

        // Loop through the services and check whether to update or insert each one
        foreach ($service as $key => $product) {
            $hour = $hours[$key];
            $prices = $price[$key];
            $tax = $btw[$key];
            $work = $worksubtotal[$key];
            $service_id_value = $service_id[$key]; // Unique service ID for each service

            if (!empty($service_id_value)) {
                // Update existing service
                $stmt = $conn->prepare('UPDATE services SET `service_name`=?, `service_hour`=?, `service_price`=?, `service_tax`=?, `service_total_price`=? WHERE `service_id`=? AND `service_invoice_id`=?');
                if (!$stmt->execute(array($product, $hour, $prices, $tax, $work, $service_id_value, $invoice_id))) {
                    $stmt = null;
                    exit();
                }
            } else {
                // Insert new service (no service_id present)
                $stmt = $conn->prepare('INSERT INTO services (`service_name`, `service_hour`, `service_price`, `service_tax`, `service_total_price`, `service_invoice_id`) VALUES (?, ?, ?, ?, ?, ?)');
                if (!$stmt->execute(array($product, $hour, $prices, $tax, $work, $invoice_id))) {
                    $stmt = null;
                    exit();
                }
            }
        }

        $stmt = null;
        echo "<script>location.href='invoice-overview.php';</script>";
    }

    public function deleteService($service_id)
    {
        // Mark the service as deleted
        $sql = 'UPDATE services SET service_deleted = NOW() WHERE service_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $service_id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the invoice page (or any desired page)
        $previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'invoice.php';
        echo "<script>location.href='{$previousPage}';</script>";
        exit();  // Ensure the script halts after deletion
    }
}
