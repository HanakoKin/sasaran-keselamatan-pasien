<script>
    function showLapkpcModal(lapkpc) {

        var title = "Data id : " + lapkpc.id

        console.log(lapkpc)

        $('#showTitle').text(title);
        $('#lapkpc').text(": " + lapkpc.kpc);
        $('#lapkpcTanggalDitemukan').text(": " + lapkpc.tanggal_ditemukan);
        $('#lapkpcJamDitemukan').text(": " + lapkpc.jam_ditemukan);
        $('#lapkpcPelaporInsiden').text(": " + lapkpc.pelapor_insiden);
        $('#lapkpcTempatInsiden').text(": " + lapkpc.tempat_insiden);
        $('#lapkpcUnitInsiden').text(": " + lapkpc.unit_insiden);
        $('#lapkpcTindakanCepat').text(": " + lapkpc.tindakan_cepat);
        $('#lapkpcTindakanInsiden').text(": " + lapkpc.tindakan_insiden);
        $('#lapkpcKejadianInsiden').text(": " + lapkpc.kejadian_insiden);

        $('#showLapkpc').modal('show')


    }

</script>
