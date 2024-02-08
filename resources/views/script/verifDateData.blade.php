<script>
    // Get current date
    var now = new Date();

    // Format current date as dd-mm-yyyy
    var day = String(now.getDate()).padStart(2, '0');
    var month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero indexed, so we add 1
    var year = String(now.getFullYear());
    var currentDate = year + '-' + month + '-' + day;

    // Set value of input field to current date
    document.getElementById('tanggal_terima').value = currentDate;

</script>
