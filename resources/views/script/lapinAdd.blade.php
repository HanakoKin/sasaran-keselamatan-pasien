<script>
    // $(document).ready(function () {
    //     $('#ruLap').select2();

    //     // Menangani peristiwa 'select2:select' pada elemen dengan ID 'ruLap'
    //     $('#ruLap').on('select2:select', function (e) {
    //         var ruangan = e.params.data.text;
    //         var noRM = document.getElementById('noRMLap').value;

    //         // Menampilkan nilai di console.log
    //         console.log(ruangan);
    //         console.log(noRM);

    //         // Kirim permintaan ke endpoint Laravel
    //         fetch('/search-patient', {
    //                 method: 'POST',
    //                 headers: {
    //                     'Content-Type': 'application/json',
    //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
    //                         .getAttribute(
    //                             'content')
    //                 },
    //                 body: JSON.stringify({
    //                     noRM: noRM,
    //                     ruangan: ruangan
    //                 })
    //             })
    //             .then(response => {
    //                 if (!response.ok) {
    //                     throw new Error('Network response was not ok');
    //                 }
    //                 return response.json();
    //             })
    //             .then(data => {

    //                 console.log(data)

    //                 // Isi formulir dengan data yang diterima
    //                 document.getElementById('naLap').value = data.nama || '';
    //                 // document.getElementById('ruLap').value = data.ruangan || '';

    //                 // Ceklist radiobox
    //                 if (data.jenis_kelamin === 'Laki-laki') {
    //                     document.getElementById('jekel1').checked = true;
    //                 } else if (data.jenis_kelamin === 'Perempuan') {
    //                     document.getElementById('jekel2').checked = true;
    //                 }

    //                 if (data.umur.includes('bulan')) {
    //                     let angkaUmur = parseInt(data.umur.match(/\d+/)[0]);
    //                     if (angkaUmur <= 1) {
    //                         document.getElementById('umur1').checked = true;
    //                     } else {
    //                         document.getElementById('umur2').checked = true;
    //                     }
    //                 }

    //                 if (data.umur.includes('tahun')) {
    //                     let angkaUmur = parseInt(data.umur.match(/\d+/)[0]);
    //                     if (angkaUmur > 1 && angkaUmur <= 5) {
    //                         document.getElementById('umur3').checked = true;
    //                     } else if (angkaUmur > 5 && angkaUmur <= 15) {
    //                         document.getElementById('umur4').checked = true;
    //                     } else if (angkaUmur > 15 && angkaUmur <= 30) {
    //                         document.getElementById('umur5').checked = true;
    //                     } else if (angkaUmur > 30 && angkaUmur <= 65) {
    //                         document.getElementById('umur6').checked = true;
    //                     } else if (angkaUmur > 65) {
    //                         document.getElementById('umur7').checked = true;
    //                     }
    //                 }

    //                 // const umurMap = {
    //                 //     '0 - 1 bulan': 'umur1',
    //                 //     '> 1 bulan - 1 tahun': 'umur2',
    //                 //     '> 1 tahun - 5 tahun': 'umur3',
    //                 //     '> 5 tahun - 15 tahun': 'umur4',
    //                 //     '> 15 tahun - 30 tahun': 'umur5',
    //                 //     '> 30 tahun - 65 tahun': 'umur7',
    //                 //     '> 65 tahun': 'umur8'
    //                 // };

    //                 // if (data.umur && umurMap[data.umur]) {
    //                 //     document.getElementById(umurMap[data.umur]).checked = true;
    //                 // }

    //                 const penjaminMap = {
    //                     'Pribadi': 'penjamin1',
    //                     'Pemerintah': 'penjamin2',
    //                     'BPJS': 'penjamin3',
    //                     'Asuransi Swasta': 'penjamin4',
    //                     'Perusahaan': 'penjamin5',
    //                     'Lain-lain': 'penjamin6'
    //                 }

    //                 if (data.penjamin && penjaminMap[data.penjamin]) {
    //                     document.getElementById(penjaminMap[data.penjamin]).checked = true;
    //                 }

    //                 // Lanjutkan mengisi formulir tanggal & jam

    //                 document.getElementById('tamas').value = data.tanggal_masuk || '';
    //                 document.getElementById('jamas').value = data.jam_masuk || '';
    //             })
    //             .catch(error => {
    //                 console.error('There was an error!', error);

    //                 document.getElementById('naLap').value = 'Data pasien tidak ditemukan';
    //                 document.getElementById('ruLap').value = 'Data pasien tidak ditemukan';

    //                 document.getElementsByName('jenis_kelamin').forEach(radioButton => {
    //                     radioButton.checked = false;
    //                 });

    //                 document.getElementsByName('umur').forEach(radioButton => {
    //                     radioButton.checked = false;
    //                 });

    //                 document.getElementsByName('penjamin').forEach(radioButton => {
    //                     radioButton.checked = false;
    //                 });

    //                 document.getElementById('tamas').value = '';
    //                 document.getElementById('jamas').value = '';

    //             });

    //         // Lakukan pemrosesan inputan selanjutnya atau tindakan lain di sini
    //         // ...
    //     });
    // })

    document.getElementById('noRMLap').addEventListener('change', function () {

        var noRM = this.value;

        console.log(noRM)

        // Kirim permintaan ke endpoint Laravel
        fetch('/search-patient', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    noRM: noRM,
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(informasiPasien => {

                console.log(informasiPasien)

                // Isi formulir dengan data yang diterima
                document.getElementById('naLap').value = informasiPasien.nama || '';
                // document.getElementById('ruLap').value = data.ruangan || '';

                // Ceklist radiobox
                if (informasiPasien.jenis_kelamin === 'Laki-laki' || informasiPasien.jenis_kelamin ===
                    'Male') {
                    document.getElementById('jekel1').checked = true;
                } else if (informasiPasien.jenis_kelamin === 'Perempuan' || informasiPasien
                    .jenis_kelamin === 'Female') {
                    document.getElementById('jekel2').checked = true;
                }

                const umurMap = {
                    'umur1': 'umur1',
                    'umur2': 'umur2',
                    'umur3': 'umur3',
                    'umur4': 'umur4',
                    'umur5': 'umur5',
                    'umur6': 'umur6',
                    'umur7': 'umur7'
                };

                if (informasiPasien.umur && umurMap[informasiPasien.umur]) {
                    document.getElementById(umurMap[informasiPasien.umur]).checked = true;
                }

                const penjaminMap = {
                    'Pribadi': 'penjamin1',
                    'Pemerintah': 'penjamin2',
                    'BPJS': 'penjamin3',
                    'Asuransi Swasta': 'penjamin4',
                    'Perusahaan': 'penjamin5',
                    'Lain-lain': 'penjamin6'
                }

                if (informasiPasien.penjamin && penjaminMap[informasiPasien.penjamin]) {
                    document.getElementById(penjaminMap[informasiPasien.penjamin]).checked = true;
                }

                // Lanjutkan mengisi formulir tanggal & jam

                document.getElementById('tamas').value = informasiPasien.tanggal_masuk || '';
                document.getElementById('jamas').value = informasiPasien.jam_masuk || '';
            })
            .catch(error => {
                console.error('There was an error!', error);

                document.getElementById('naLap').value = 'Data pasien tidak ditemukan';
                document.getElementById('ruLap').value = 'Data pasien tidak ditemukan';

                document.getElementsByName('jenis_kelamin').forEach(radioButton => {
                    radioButton.checked = false;
                });

                document.getElementsByName('umur').forEach(radioButton => {
                    radioButton.checked = false;
                });

                document.getElementsByName('penjamin').forEach(radioButton => {
                    radioButton.checked = false;
                });

                document.getElementById('tamas').value = '';
                document.getElementById('jamas').value = '';

            });
    });

    function validasiForm() {
        var checkboxes = document.getElementsByName("kasus_insiden[]");
        var isChecked = false;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            alert("Pilih minimal satu opsi sebelum mengirimkan formulir.");
            return false;
        }

        return true;
    }

    /* Untuk mengHIGHLIGHT pilihan user sebelumnya */
    function selectRadio(radioId) {
        var radio = document.getElementById(radioId);
        radio.checked = true;
    }

    /* Untuk membuat radio button terpilih ketika user melakukan custom input */
    function syncInputRadio(radioId, inputId) {
        var radio = document.getElementById(radioId);
        var input = document.getElementById(inputId);

        console.log(radio.value)

        if (input.value.trim() !== "") {
            radio.value = input.value;
            radio.checked = true;
        } else {
            radio.value = "";
            radio.checked = false;
        }

    }

    /* Untuk membuat radio button terpilih ketika user melakukan custom input */
    function syncInputRadioSpecial(radioId, hiddenInputId, textInputId) {
        var radio = document.getElementById(radioId);
        var hiddenInput = document.getElementById(hiddenInputId);
        var textInput = document.getElementById(textInputId);

        var existingData = textInput.value.trim();

        console.log(existingData)

        if (radio.checked && radio.value === "Ya") {
            hiddenInput.value = "Ya, terjadi pada " + textInput.value;
        } else {
            hiddenInput.value = "Tim, yang terdiri dari " + textInput.value;
        }
    }

    /* Menampilkan textarea sesuai trigger */
    function showTextarea(textareaId) {
        var textarea = document.getElementById(textareaId);
        // Menggunakan kelas Bootstrap untuk menampilkan elemen
        textarea.classList.remove("d-none");
    }

    /* Menghilangkan textarea sesuai trigger */
    function hideTextarea(textareaId) {
        var textarea = document.getElementById(textareaId);
        // Menggunakan kelas Bootstrap untuk menyembunyikan elemen
        textarea.classList.add("d-none");
    }

</script>
