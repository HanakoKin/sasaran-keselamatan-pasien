<script>
    /* Untuk validasi checkbox supaya memilih salah satu */
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

        console.log(input.value.trim() !== "")
        console.log(input.value)

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

    /* function editModalLapin(url, lapin) {

        var title = "Edit data " + lapin.nama
        $('#editLapinTitle').text(title);

        $('.lapinNama').text(lapin.nama);
        $('.lapinNoRM').text(lapin.noRM);
        $('#editLapinNama').val(lapin.nama);
        $('#editLapinNoRM').val(lapin.noRM);
        $('#editLapinRuangan').val(lapin.ruangan);
        $('#editLapinUmur').val(lapin.umur);
        $('#editLapinJenisKelamin').val(lapin.jenis_kelamin);
        $('#editLapinPenjamin').val(lapin.penjamin);
        $('#editLapinTanggalMasuk').val(lapin.tanggal_masuk);
        $('#editLapinJamMasuk').val(lapin.jam_masuk);
        $('#editLapinTanggalKejadian').val(lapin.tanggal_kejadian);
        $('#editLapinJamKejadian').val(lapin.jam_kejadian);
        $('#editLapinInsiden').val(lapin.insiden);
        $('#editLapinKronologis').val(lapin.kronologis);
        $('#editLapinJenisInsiden').val(lapin.jenis_insiden);
        $('#editLapinPelaporInsiden').val(lapin.pelapor_insiden);
        $('#editLapinKorbanInsiden').val(lapin.korban_insiden);
        $('#editLapinLayananInsiden').val(lapin.layanan_insiden);
        $('#editLapinTempatInsiden').val(lapin.tempat_insiden);
        $('#editLapinKasusInsiden').val(lapin.kasus_insiden);
        $('#editLapinUnitInsiden').val(lapin.unit_insiden);
        $('#editLapinDampakInsiden').val(lapin.dampak_insiden);
        $('#editLapinTindakanCepat').val(lapin.tindakan_cepat);
        $('#editLapinTindakanInsiden').val(lapin.tindakan_insiden);
        $('#editLapinKejadianInsiden').val(lapin.kejadian_insiden);

        function setOptionSelectedById(elementId, value) {
            $(`#${elementId} option`).each(function () {
                if ($(this).val() === value) {
                    $(this).prop('selected', true);
                }
            });
        }

        setOptionSelectedById('editLapinJenisKelamin', lapin.jenis_kelamin);
        setOptionSelectedById('editLapinUmur', lapin.umur);
        setOptionSelectedById('editLapinPenjamin', lapin.penjamin);
        setOptionSelectedById('editLapinJenisInsiden', lapin.jenis_insiden);
        setOptionSelectedById('editLapinDampakInsiden', lapin.dampak_insiden);


        editPelaporLain.classList.add('d-none');
        editKorbanLain.classList.add('d-none');
        editLayananLain.classList.add('d-none');
        editTindakanLain.classList.add('d-none');

        function setPelaporLain(elementId, value) {

            let lainLainOption = editLapinPelaporInsiden.querySelector('#pelapor_lain_lain');

            let isCustomValue = !['Karyawan ( Dokter / Perawat / Petugas Lainnya )', 'Pasien', 'Pengunjung',
                'Keluarga / Pendamping', 'Pelapor Lain'
            ].includes(value);

            if (value !== 'Lain-lain' && !isCustomValue) {
                lainLainOption.classList.add('d-none');
            } else {
                lainLainOption.classList.remove('d-none');
            }

            $(`#${elementId} option`).each(function () {
                if ($(this).val() === value) {
                    $(this).prop('selected', true);
                } else if (
                    value !== 'Karyawan ( Dokter / Perawat / Petugas Lainnya )' &&
                    value !== 'Pasien' &&
                    value !== 'Pengunjung' &&
                    value !== 'Keluarga / Pendamping' &&
                    value !== 'Pelapor Lain' &&
                    $(this).val() !== 'Karyawan ( Dokter / Perawat / Petugas Lainnya )' &&
                    $(this).val() !== 'Pasien' &&
                    $(this).val() !== 'Pengunjung' &&
                    $(this).val() !== 'Keluarga / Pendamping' &&
                    $(this).val() !== 'Pelapor Lain'
                ) {
                    $(this).val(value).text(value);
                    $(this).prop('selected', true);
                }

                editLapinPelaporInsiden.addEventListener('change', function () {
                    let selectedValue = editLapinPelaporInsiden.value;
                    if (selectedValue === 'Pelapor Lain') {
                        editPelaporLain.classList.remove('d-none');
                    } else {
                        editPelaporLain.classList.add('d-none');
                    }
                });

            });

        }

        function setKorbanLain(elementId, value) {

            let lainLainOption = editLapinKorbanInsiden.querySelector('#korban_lain_lain');

            let isCustomValue = !['Pasien', 'Korban Lain'].includes(value);

            if (value !== 'Lain-lain' && !isCustomValue) {
                lainLainOption.classList.add('d-none');
            } else {
                lainLainOption.classList.remove('d-none');
            }

            $(`#${elementId} option`).each(function () {
                if ($(this).val() === value) {
                    $(this).prop('selected', true);
                } else if (
                    value !== 'Pasien' && $(this).val() !== 'Pasien' &&
                    $(this).val() !== 'Korban Lain'
                ) {
                    $(this).val(value).text(value);
                    $(this).prop('selected', true);
                }

                editLapinKorbanInsiden.addEventListener('change', function () {
                    let selectedValue = editLapinKorbanInsiden.value;
                    if (selectedValue === 'Korban Lain') {
                        editKorbanLain.classList.remove('d-none');
                    } else {
                        editKorbanLain.classList.add('d-none');
                    }
                });

            });
        }

        function setLayananLain(elementId, value) {

            let lainLainOption = editLapinLayananInsiden.querySelector('#layanan_lain_lain');

            let isCustomValue = !['Pasien Rawat Jalan', 'Pasien Rawat Inap', 'Pasien UGD', 'Layanan Lain'].includes(
                value);

            if (value !== 'Lain-lain' && !isCustomValue) {
                lainLainOption.classList.add('d-none');
            } else {
                lainLainOption.classList.remove('d-none');
            }

            $(`#${elementId} option`).each(function () {
                if ($(this).val() === value) {
                    $(this).prop('selected', true);
                } else if (
                    value !== 'Pasien Rawat Jalan' && value !== 'Pasien Rawat Inap' && value !== 'Pasien UGD' &&
                    $(this).val() !== 'Pasien Rawat Jalan' &&
                    $(this).val() !== 'Pasien Rawat Inap' &&
                    $(this).val() !== 'Pasien UGD' &&
                    $(this).val() !== 'Layanan Lain'

                ) {
                    $(this).val(value).text(value);
                    $(this).prop('selected', true);
                }

                editLapinLayananInsiden.addEventListener('change', function () {
                    let selectedValue = editLapinLayananInsiden.value;
                    if (selectedValue === 'Layanan Lain') {
                        editLayananLain.classList.remove('d-none');
                    } else {
                        editLayananLain.classList.add('d-none');
                    }
                });

            });
        }

        function setTindakanLain(elementId, value) {

            let lainLainOption = editLapinTindakanInsiden.querySelector('#tindakan_lain_lain');

            let timOption = editLapinTindakanInsiden.querySelector('option[value="Tim"]');

            let isCustomValue = !['Tim', 'Dokter', 'Perawat', 'Tindakan Lain'].includes(
                value);

            if (value !== 'Lain-lain' && !isCustomValue) {
                lainLainOption.classList.add('d-none');
            } else {
                lainLainOption.classList.remove('d-none');
            }

            $(`#${elementId} option`).each(function () {
                if ($(this).val() === value) {
                    $(this).prop('selected', true);
                } else if (
                    /^Tim, yang terdiri dari\s/.test(value)
                ) {
                    timOption.selected = true
                    lainLainOption.classList.add('d-none')
                } else if (
                    value !== 'Tim' && value !== 'Dokter' &&
                    'Perawat' &&
                    $(this).val() !== 'Tim' &&
                    $(this).val() !== 'Dokter' &&
                    $(this).val() !== 'Perawat' &&
                    $(this).val() !== 'Tindakan Lain'
                ) {
                    $(this).val(value).text(value);
                    $(this).prop('selected', true);
                }

                editLapinTindakanInsiden.addEventListener('change', function () {
                    let selectedValue = editLapinTindakanInsiden.value;
                    if (selectedValue === 'Tindakan Lain') {
                        editTindakanLain.classList.remove('d-none');
                    } else {
                        editTindakanLain.classList.add('d-none');
                    }
                });

            });
        }

        function setKejadianLain(elementId, value) {

            let kejadianOption = editLapinKejadianInsiden.querySelector('option[value="Ya"]');

            $(`#${elementId} option`).each(function () {
                if ($(this).val() === value) {
                    $(this).prop('selected', true);
                } else if (
                    /^Ya, terjadi pada\s/.test(value)
                ) {
                    kejadianOption.selected = true
                }

                editLapinKejadianInsiden.addEventListener('change', function () {
                    let selectedValue = editLapinKejadianInsiden.value;
                    if (selectedValue === 'Masukan Lain') {
                        editKejadianLain.classList.remove('d-none');
                    } else {
                        editKejadianLain.classList.add('d-none');
                    }
                });

            });
        }

        function setInsidenLain() {
            // Pilihan sebelumnya
            var previousSelectionArray = lapin.kasus_insiden.split(', ');

            var selectElement = $("#editLapinKasusInsiden");
            selectElement.val(previousSelectionArray);

            var selectedOption = selectElement.select2('data');

            if (selectedOption && selectedOption.length > 0) {
                var newOption = selectedOption.map(function (option) {
                    return option.text;
                });

                $("#editLapinKasusInsiden").select2({
                    theme: "bootstrap-5",
                    width: '100%'
                });

                $("#editLapinKasusInsiden").val(previousSelectionArray).trigger('change');

                var previousSelection = selectElement.val() || [];
                previousSelection = previousSelection.concat(newOption);
                selectElement.val(previousSelection);
            }

            selectElement.select2('destroy').select2({
                width: '100%',
                multiple: true
            });
        }

        setPelaporLain('editLapinPelaporInsiden', lapin.pelapor_insiden);
        setKorbanLain('editLapinKorbanInsiden', lapin.korban_insiden);
        setLayananLain('editLapinLayananInsiden', lapin.layanan_insiden);
        setTindakanLain('editLapinTindakanInsiden', lapin.tindakan_insiden);
        setInsidenLain('editLapinInsidenInsiden', lapin.insiden_insiden);
        setKejadianLain('editLapinKejadianInsiden', lapin.kejadian_insiden);


        $('#editFormLapin').attr('action', url);
        $('#editModalLapin').modal('show');
    } */

</script>
