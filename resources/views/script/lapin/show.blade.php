<script>
    function showLapinModal(lapin) {

        var title = "Data : " + lapin.nama;
        var unit = "Unit : " + lapin.unit_kerja;

        console.log(lapin.nama);

        $('#showTitle').text(title);
        $('#showUnit').text(unit);
        $('#namaTitle').text(lapin.nama);
        $('#noRMTitle').text(lapin.noRM);
        $('#lapinNama').text(": " + lapin.nama);
        $('#lapinNoRM').text(": " + lapin.noRM);
        $('#lapinRuangan').text(": " + lapin.ruangan);
        $('#lapinUmur').text(": " + lapin.umur);
        $('#lapinJenisKelamin').text(": " + lapin.jenis_kelamin);
        $('#lapinPenjamin').text(": " + lapin.penjamin);
        $('#lapinTanggalMasuk').text(": " + formatDate(lapin.tanggal_masuk));
        $('#lapinJamMasuk').text(": " + removeSeconds(lapin.jam_masuk));
        $('#showLapin').modal('show')

        function formatDate(dateString) {
            var date = new Date(dateString);

            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();

            var formattedDay = day < 10 ? '0' + day : day;
            var formattedMonth = month < 10 ? '0' + month : month;

            var formattedDate = formattedDay + '-' + formattedMonth + '-' + year;

            return formattedDate;
        }

        function removeSeconds(timeString) {
            var splitTime = timeString.split(':');
            var hour = splitTime[0];
            var minute = splitTime[1];

            var formattedTime = hour + ':' + minute;

            return formattedTime;
        }

    }
</script>
