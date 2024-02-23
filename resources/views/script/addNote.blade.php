<script>
    $(document).ready(function () {
        // Menentukan jumlah formulir yang sudah ada dari data database
        var existingFormsCount = $("textarea[name='catatan[]']").length;

        window.removeCatatanRow = function (index) {
            $("#catatanRow" + index).remove();
        };

        window.removeTanggalRow = function (index) {
            $("#tanggalRow" + index).remove();
        };

        // Ketika tombol "Tambah Input" ditekan
        $("#addInput").click(function () {

            // Hitung jumlah input yang sudah ada
            var inputCount = (existingFormsCount / 2) + $("textarea[name='catatan[]']").length;

            // Tambahkan input textarea baru
            $("#dynamicInputs").append('<div class="form-group"><label for="textarea' + inputCount +
                '">Catatan ' + inputCount +
                ':</label><textarea class="form-control" id="textarea' + inputCount +
                '" name="catatan[]" required></textarea></div>');

            // Tambahkan input date baru
            $("#dynamicInputs").append('<div class="form-group"><label for="date' + inputCount +
                '">Tanggal untuk Catatan ' + inputCount +
                ':</label><input type="date" class="form-control" id="date' + inputCount +
                '" name="tanggal_catatan[]" required></div>');
        });

        // Ketika tombol "Kurangi Input" ditekan
        $("#removeInput").click(function () {

            if ($("#dynamicInputs").children().length < 2) {
                var lastCatatanIndex = $("textarea[name='catatan[]']").length - 1;
                console.log(lastCatatanIndex);
                window.removeCatatanRow(lastCatatanIndex);

                var lastTanggalIndex = $("input[name='tanggal_catatan[]']").length - 1;
                console.log(lastTanggalIndex);
                window.removeTanggalRow(lastTanggalIndex);
            }

            // Hapus dua elemen terakhir dari div dengan id "dynamicInputs"
            $("#dynamicInputs").children().last().remove();
            $("#dynamicInputs").children().last().remove();


        });
    });

</script>
