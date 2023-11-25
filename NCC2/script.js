src="https://code.jquery.com/jquery-3.6.0.min.js"
$(document).ready(function () {
    $('.editable').on('blur', function () {
        var newValue = $(this).text();
        var columnName = $(this).data('column');

        // Send an AJAX request to update the value in the database
        $.ajax({
            url: 'update_database.php',
            method: 'POST',
            data: {
                column: columnName,
                newValue: newValue,
                // Add any other data you need to identify the record
            },
            success: function (response) {
                // Handle the response from the server if needed
            }
        });
    });
});

