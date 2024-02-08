<script>
    /* Fungsi untuk menampilkan pilihan sebelumnya (khusus select) */
    function setOptionSelectedById(elementId, value) {
        $(`#${elementId} option`).each(function () {
            if ($(this).val() === value) {
                $(this).prop('selected', true);
            }
        });
    }

    /* Untuk mengubah &gt; menjadi >, dan sebagainya */
    var decodedUmur = decodeEntities("{{ $lapin->umur }}");
    setOptionSelectedById('editLapinUmur', decodedUmur);

    function decodeEntities(encodedString) {
        var textarea = document.createElement('textarea');
        textarea.innerHTML = encodedString;
        return textarea.value;
    }

    /* Untuk menampilkan inputan user di radio button yang memiliki custom input */
    function displayCustomInputRadio() {

        // Dapatkan elemen radio button
        let pelapor_lain = document.getElementById("pelapor_lain");
        let layanan_lain = document.getElementById("layanan_lain");
        let kasus_lain = document.getElementById("kasus_lain");
        let korban_lain = document.getElementById("korban_lain");
        let tindakan_tim = document.getElementById("tindakan_tim");
        let tindakan_petugas_lain = document.getElementById("tindakan_petugas_lain");
        let pernah_terjadi = document.getElementById("pernah_terjadi");

        // Dapatkan elemen input text
        let ket_pelapor_lain = document.getElementById("ket_pelapor_lain");
        let ket_layanan_lain = document.getElementById("ket_layanan_lain");
        let ket_kasus_lain = document.getElementById("ket_kasus_lain");
        let ket_korban_lain = document.getElementById("ket_korban_lain");
        let ket_tindakan_tim = document.getElementById("ket_tindakan_tim");
        let ket_tindakan_petugas_lain = document.getElementById("ket_tindakan_petugas_lain");
        let ket_kejadian_insiden = document.getElementById("ket_kejadian_insiden");
        let anggota_tim = document.getElementById("anggota_tim");
        let des_kejadian_insiden = document.getElementById("des_kejadian_insiden");

        // Ambil data yang akan diubah kalimatnya
        let data_kejadian_insiden = "{{ $lapin->kejadian_insiden }}";
        let data_tindakan_insiden = "{{ $lapin->tindakan_insiden }}";
        let data_kasus_insiden = "{{ $lapin->kasus_insiden }}";

        // Ubah ke array
        let kasusInsidenArray = data_kasus_insiden.split(', ');
        let ignoredValues = ["Penyakit Dalam dan Subspesialisasinya", "Anak dan Subspesialisasinya",
            "Bedah dan Subspesialisasinya", "Obstetri Gynekologi dan Subspesialisasinya",
            "THT dan Subspesialisasinya", "Mata dan Subspesialisasinya", "Saraf dan Subspesialisasinya",
            "Anastesi dan Subspesialisasinya", "Kulit &amp; Kelamin dan Subspesialisasinya",
            "Jantung dan Subspesialisasinya", "Paru dan Subspesialisasinya", "Jiwa dan Subspesialisasinya"
        ];

        // Mencari yang tidak ada di dalam array (asumsikan mencari inputan user)
        let filteredArray = kasusInsidenArray.filter(function (value) {
            return !ignoredValues.includes(value);
        });

        // Ubah kalimat pada data
        let fixed_ket_tindakan_tim = data_tindakan_insiden.replace("Tim, yang terdiri dari ", "");
        let fixed_ket_kejadian_insiden = data_kejadian_insiden.replace("Ya, terjadi pada ", "")

        // Tampilkan textarea yang hidden
        let keterangan_unit_kerja = document.getElementById("keterangan_unit_kerja");

        if (pelapor_lain.checked) {
            ket_pelapor_lain.value = "{{ $lapin->pelapor_insiden }}";
            pelapor_lain.value = "{{ $lapin->pelapor_insiden }}"
        }

        if (layanan_lain.checked) {
            ket_layanan_lain.value = "{{ $lapin->layanan_insiden }}";
            layanan_lain.value = "{{ $lapin->layanan_insiden }}";
        }

        if (kasus_lain.checked) {
            ket_kasus_lain.value = filteredArray;
            kasus_lain.value = filteredArray;
        }

        if (korban_lain.checked) {
            ket_korban_lain.value = "{{ $lapin->korban_insiden }}";
            korban_lain.value = "{{ $lapin->korban_insiden }}";
        }

        if (tindakan_tim.checked) {
            ket_tindakan_tim.value = fixed_ket_tindakan_tim;
            anggota_tim.value = fixed_ket_tindakan_tim;
        }

        if (tindakan_petugas_lain.checked) {
            ket_tindakan_petugas_lain.value = "{{ $lapin->tindakan_insiden }}";
            tindakan_petugas_lain.value = "{{ $lapin->tindakan_insiden }}";
        }

        if (pernah_terjadi.checked) {
            keterangan_unit_kerja.classList.remove("d-none");
            ket_kejadian_insiden.textContent = fixed_ket_kejadian_insiden;
            des_kejadian_insiden.value = fixed_ket_kejadian_insiden;
        } else if (!pernah_terjadi.checked) {
            keterangan_unit_kerja.classList.add("d-none");
        }

    }

    /* Manjalankan fungsi ketika halaman diakses */
    document.addEventListener("DOMContentLoaded", function () {
        displayCustomInputRadio();
    });

</script>
