<script>
    $(document).ready(function () {
        $('#tableLapin').DataTable();
    });

    $('#lapinModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var lapin = button.data('lapin');

        console.log(lapin)

        $('.lapinNama').text(lapin.nama);
        $('.lapinNoRM').text(lapin.noRM);
        $('#lapinRuangan').text(lapin.ruangan);
        $('#lapinUmur').text(lapin.umur);
        $('#lapinJenisKelamin').text(lapin.jenis_kelamin);
        $('#lapinPenjamin').text(lapin.penjamin);
        $('#lapinTanggalMasuk').text(lapin.tanggal_masuk);
        $('#lapinJamMasuk').text(lapin.jam_masuk);
        $('#lapinTanggalKejadian').text(lapin.tanggal_kejadian);
        $('#lapinJamKejadian').text(lapin.jam_kejadian);
        $('#lapinInsiden').text(lapin.insiden);
        $('#lapinKronologis').text(lapin.kronologis);
        $('#lapinJenisInsiden').text(lapin.jenis_insiden);
        $('#lapinPelaporInsiden').text(lapin.pelapor_insiden);
        $('#lapinKorbanInsiden').text(lapin.korban_insiden);
        $('#lapinLayananInsiden').text(lapin.layanan_insiden);
        $('#lapinTempatInsiden').text(lapin.tempat_insiden);
        $('#lapinKasusInsiden').text(lapin.kasus_insiden);
        $('#lapinUnitInsiden').text(lapin.unit_insiden);
        $('#lapinDampakInsiden').text(lapin.dampak_insiden);
        $('#lapinTindakanCepat').text(lapin.tindakan_cepat);
        $('#lapinTindakanInsiden').text(lapin.tindakan_insiden);
        $('#lapinKejadianInsiden').text(lapin.kejadian_insiden);

    });

</script>
