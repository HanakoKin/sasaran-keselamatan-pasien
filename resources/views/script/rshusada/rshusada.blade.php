<script>
    /* Inisialisasi bulan dan tahun saat ini */
    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1;

    /* Inisialisasi penamaan bulan */
    var monthNames = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    /* Inisialisasi bulan yang memiliki 30 hari */
    let evenDayMonths = [4, 6, 9, 11];

    /* Untuk menentukan jumlah hari dalam satu bulan */
    function getDay(currentMonth, currentYear) {
        let totalDay = 0;

        if (currentMonth === 2 && (currentYear % 4 == 0 && currentYear % 100 != 0) || currentYear % 400 == 0) {
            return totalDay = 29;
        } else if (currentMonth == 2 && currentYear % 4 != 0) {
            return totalDay = 28;
        } else if (evenDayMonths.includes(currentMonth)) {
            return totalDay = 30;
        } else {
            return totalDay = 31;
        }
    }

    /* Untuk menyesuaikan table header dengan jumlah hari */
    var jml_tgl = document.getElementById('jml_tgl');
    jml_tgl.colSpan = getDay(currentMonth, currentYear);

    function addHeader(totalDay) {
        $('#tableHeader').empty();
        var tableHeader = document.getElementById('tableHeader');
        for (let i = 1; i <= totalDay; i++) {
            var tableCell = document.createElement('th');
            tableCell.textContent = i;
            tableHeader.appendChild(tableCell);
        }
    }

    addHeader(getDay(currentMonth, currentYear));

    /* Inisialisasi tombol next & previous month */
    var prevBtn = document.getElementById('prevBtn');
    var nextBtn = document.getElementById('nextBtn');

    /* Trigger untuk tombol next & previous  */
    if (prevBtn) {
        prevBtn.addEventListener('click', decreaseMonth);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', increaseMonth);
    }

    function updateDisplay(month, year) {
        var h4Caption = document.getElementById('h4Caption');

        h4Caption.textContent = `Tahun ${currentYear} Bulan ${monthNames[currentMonth - 1]}`;

        $.ajax({
            url: '/showDatas-rshusada', // Replace with the actual route
            method: 'GET',
            data: {
                month: month,
                year: year
            },
            dataType: 'json', // Expect JSON as the response
            success: function(data) {
                console.log(data);
                // Clear the existing table body content
                $('#tableBody').empty();

                // Iterate over the question array
                for (let index = 0; index < data.question.length; index++) {
                    // Create a new table row
                    var tableRow = $('<tr>');

                    // Add cells to the row
                    tableRow.append($('<td>').text(index + 1));
                    tableRow.append($('<td>').append($('<label>').text(data.question[index])));

                    if (data.mainArray[index]) {
                        // Add cells for each day
                        for (let i = 1; i <= data.totalDay; i++) {
                            var value = data.mainArray[index][i - 1] || '0';
                            tableRow.append($('<td>').text(value));
                        }
                    } else {
                        // If data.mainArray[index] is undefined, add placeholder cells
                        for (let i = 1; i <= data.totalDay; i++) {
                            tableRow.append($('<td>').text('0'));
                        }
                    }

                    // Append the row to the table body
                    $('#tableBody').append(tableRow);
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    $(document).ready(function() {
        updateDisplay(monthNames[currentMonth - 1], currentYear); // Replace with your initial values
    });

    function decreaseMonth() {
        currentMonth = (currentMonth - 1) <= 0 ? 12 : currentMonth - 1;
        if (currentMonth === 12) {
            currentYear = currentYear - 1;
        }
        jml_tgl.colSpan = getDay(currentMonth, currentYear);
        addHeader(getDay(currentMonth, currentYear));
        updateDisplay(monthNames[currentMonth - 1], currentYear);
    }

    function increaseMonth() {
        currentMonth = (currentMonth + 1) > 12 ? 1 : currentMonth + 1;
        if (currentMonth === 1) {
            currentYear = currentYear + 1;
        }
        jml_tgl.colSpan = getDay(currentMonth, currentYear);
        addHeader(getDay(currentMonth, currentYear));
        updateDisplay(monthNames[currentMonth - 1], currentYear);
    }
</script>
