<!-- notification to show that a reservation cant be made for that specific date time and table -->
<script>
    $(document).ready(function () {
    $('#reservation_date, #start_time, input[name="selected_table[]"]').on('change', function () {
        let reservationDate = $('#reservation_date').val();
        let startTime = $('#start_time').val();
        let selectedTables = $('input[name="selected_table[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        $.ajax({
            url: 'includes/reservations.inc.php',
            type: 'POST',
            data: { check_reservation: true, reservation_date: reservationDate, start_time: startTime, selected_tables: selectedTables },
            dataType: 'json',
            success: function (data) {
                if (data.exists) {
                    // Show error message in Bootstrap alert
                    $('#error-message').text('A reservation already exists for the selected date, time, and table. Please choose another time or table.')
                        .removeClass('d-none'); // Show the alert

                    // Uncheck all selected tables
                    $('input[name="selected_table[]"]:checked').prop('checked', false);

                    // Hide the error message after 5 seconds
                    setTimeout(function () {
                        $('#error-message').addClass('d-none'); // Hide the alert after 5 seconds
                    }, 5000);

                    // Hide the success message if there was a conflict
                    $('#success-message').addClass('d-none'); // Hide success message if there is a conflict
                } else {
                    // Show success message
                    $('#success-message').text('You can successfully make a reservation for this date, time, and table.')
                        .removeClass('d-none'); // Show the alert

                    // Hide the success message after 5 seconds
                    setTimeout(function () {
                        $('#success-message').addClass('d-none'); // Hide the alert after 5 seconds
                    }, 5000);

                    // Hide the error message if there is no conflict
                    $('#error-message').addClass('d-none'); // Hide the alert if there is no conflict
                }
            }
        });
    });
});
</script>