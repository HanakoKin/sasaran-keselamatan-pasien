<script>
    document.getElementById('noRegLap').addEventListener('change', function () {

        var noReg = this.value;

        console.log(noReg)

        fetch('http://10.1.10.7:6070/BipubApi/api/Token', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'ConsId': 'husadati@gmail.com',
                'SecretKey': 'husadaTI.123',
            }
        }).then(tokenResponse => {
            if (tokenResponse.status === 401) {
                throw new Error('Unauthorized: Failed to generate token');
            }

            return tokenResponse.text();

        }).then(tokenData => {

            fetch('/search-patient', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Authorization': 'Bearer ' + tokenData,
                    },
                    body: JSON.stringify({
                        noReg: noReg,
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
                    document.getElementById('naLap').value = informasiPasien.pasienName || '';

                    document.getElementById('noRMLap').value = informasiPasien.pasienId || '';

                    document.getElementById('talah').value = informasiPasien.birthDate || '';

                    // Ceklist radiobox
                    if (informasiPasien.gender === 'Laki-laki' || informasiPasien.gender ===
                        'Male') {
                        document.getElementById('jekel1').checked = true;
                    } else if (informasiPasien.gender === 'Perempuan' || informasiPasien
                        .gender === 'Female') {
                        document.getElementById('jekel2').checked = true;
                    }
                    document.getElementById('umur').value = informasiPasien.umur || '';
                    document.getElementById('penjamin').value = informasiPasien.penjamin || '';

                    // Lanjutkan mengisi formulir tanggal & jam
                    document.getElementById('tamas').value = informasiPasien.regDate || '';
                    document.getElementById('jamas').value = informasiPasien.regTime || '';
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

        })
    });

</script>
