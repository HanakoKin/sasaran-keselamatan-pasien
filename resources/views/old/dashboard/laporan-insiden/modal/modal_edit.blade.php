{{-- <div class="modal fade" id="editModalLapin" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLapinTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="text-center">
                                <img src="https://source.unsplash.com/400x400?people" alt="User Avatar"
                                    class="img-fluid rounded-circle mb-3" style="width: 150px;">
                                <h4 class="lapinNama"></h4>
                                <p><strong>No RM: </strong><span class="lapinNoRM"></span></p>
                            </div>
                        </div>

                        <hr>

                        <!-- Form Edit -->

                        <form>
                            <div class="row">

                                <!-- Bagian 1: Informasi Pasien -->
                                <h5>Informasi Pasien</h5>

                                <!-- CLEAR -->
                                <div class="col-md-6 mb-5">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Nama
                                            <input type="text" class="form-control w-50" id="editLapinNama" name="nama"
                                                placeholder="" required>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            No RM
                                            <input type="text" class="form-control w-50" id="editLapinNoRM" name="noRM"
                                                placeholder="" required>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Jenis Kelamin
                                            <select class="form-select w-50" id="editLapinJenisKelamin"
                                                name="jenis_kelamin">
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Umur
                                            <select class="form-select w-50" id="editLapinUmur" name="umur">
                                                <option value="0 - 1 bulan"> 0 - 1 bulan</option>
                                                <option value="> 1 bulan - 1 tahun"> > 1 bulan - 1 tahun</option>
                                                <option value="> 1 tahun - 5 tahun"> > 1 tahun - 5 tahun</option>
                                                <option value="> 5 tahun - 15 tahun"> > 5 tahun - 15 tahun</option>
                                                <option value="> 15 tahun - 30 tahun"> > 15 tahun - 30 tahun</option>
                                                <option value="> 30 tahun - 65 tahun"> > 30 tahun - 65 tahun</option>
                                                <option value="> 65 tahun"> > 65 tahun</option>
                                            </select>
                                        </li>
                                    </ul>
                                </div>

                                <!-- CLEAR -->
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Ruangan
                                            <input type="text" class="form-control w-50" id="editLapinRuangan"
                                                name="ruangan" placeholder="" required>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Penanggung Biaya
                                            <select class="form-select w-50" id="editLapinPenjamin" name="penjamin">
                                                <option value="Pribadi">Pribadi</option>
                                                <option value="Pemerintah">Pemerintah</option>
                                                <option value="BPJS">BPJS</option>
                                                <option value="Asuransi Swasta">Asuransi Swasta</option>
                                                <option value="Perusahaan">Perusahaan</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tanggal Masuk RS
                                            <input type="date" class="form-control w-50" id="editLapinTanggalMasuk"
                                                name="tanggal_masuk">
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Jam Masuk RS
                                            <input type="time" class="form-control w-50" id="editLapinJamMasuk"
                                                name="jam_masuk">
                                        </li>
                                    </ul>
                                </div>

                                <hr>

                                <!-- Bagian 2: Rincian Kejadian -->
                                <h5>Rincian Kejadian</h5>

                                <!-- Stuck di lain-lain -->
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tanggal Kejadian Insiden
                                            <input type="date" class="form-control w-50" id="editLapinTanggalKejadian"
                                                name="tanggal_kejadian">
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Jam Kejadian Insiden
                                            <input type="time" class="form-control w-50" id="editLapinJamKejadian"
                                                name="jam_kejadian">
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Insiden
                                            <input type="text" class="form-control w-50" id="editLapinInsiden"
                                                name="insiden" placeholder="" required>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Kronologis Insiden
                                            <input type="text" class="form-control w-50" id="editLapinKronologis"
                                                name="kronologis" placeholder="" required>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Jenis Insiden
                                            <select class="form-select w-50" id="editLapinJenisInsiden"
                                                name="jenis_insiden">
                                                <option value="Kejadian Nyaris Cedera / KNC">Kejadian Nyaris Cedera /
                                                    KNC</option>
                                                <option value="Kejadian Tidak Cedera / KTC">Kejadian Tidak Cedera / KTC
                                                </option>
                                                <option value="Kejadian Tidak Diharapkan / KTD">Kejadian Tidak
                                                    Diharapkan / KTD</option>
                                                <option value="KPC">KPC</option>
                                            </select>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                Pelapor Insiden
                                            </span>
                                            <div class="col d-flex flex-column align-items-end">
                                                <select class="form-select mb-2" id="editLapinPelaporInsiden"
                                                    name="pelapor_insiden" style="width: 59%">
                                                    <option value="Karyawan ( Dokter / Perawat / Petugas Lainnya )">
                                                        Karyawan ( Dokter / Perawat / Petugas Lainnya )</option>
                                                    <option value="Pasien">Pasien</option>
                                                    <option value="Pengunjung">Pengunjung</option>
                                                    <option value="Keluarga / Pendamping">Keluarga / Pendamping</option>
                                                    <option value="Lain-lain" id="pelapor_lain_lain">Lain-lain
                                                    </option>
                                                    <option value="Pelapor Lain">Pelapor Lain</option>
                                                </select>
                                                <input type="text" class="form-control d-none" id="editPelaporLain"
                                                    name="pelapor_insiden" placeholder="Masukkan pelapor lain" required
                                                    style="width: 59%">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                Korban Insiden
                                            </span>
                                            <div class="col d-flex flex-column align-items-end">
                                                <select class="form-select mb-2" id="editLapinKorbanInsiden"
                                                    name="korban_insiden" style="width: 59%">
                                                    <option value="Pasien">Pasien</option>
                                                    <option value="Lain-lain" id="korban_lain_lain">Lain-lain
                                                    </option>
                                                    <option value="Korban Lain">Korban Lain</option>
                                                </select>
                                                <input type="text" class="form-control d-none" id="editKorbanLain"
                                                    name="korban_insiden" placeholder="Masukkan korban lain" required
                                                    style="width: 59%">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                Insiden menyangkut pasien
                                            </span>
                                            <div class="col d-flex flex-column align-items-end">
                                                <select class="form-select mb-2" id="editLapinLayananInsiden"
                                                    name="layanan_insiden" style="width: 69%">
                                                    <option value="Pasien Rawat Inap">Pasien Rawat Inap</option>
                                                    <option value="Pasien Rawat Jalan">Pasien Rawat Jalan</option>
                                                    <option value="Pasien UGD">Pasien UGD</option>
                                                    <option value="Lain-lain" id="layanan_lain_lain">Lain-lain</option>
                                                    <option value="Layanan Lain">Layanan Lain</option>
                                                </select>
                                                <input type="text" class="form-control d-none" id="editLayananLain"
                                                    name="layanan_insiden" placeholder="Masukkan layanan lain" required
                                                    style="width: 69%">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tempat lokasi kejadian insiden
                                            <input type="text" class="form-control w-50" id="editLapinTempatInsiden"
                                                name="tempat_insiden" placeholder="" required>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="col mt-1">
                                                <span>
                                                    Insiden terjadi pada pasien
                                                </span>
                                                <div class="col d-flex flex-column align-items-center mt-3 w-100">
                                                    <select class="form-select mb-3" id="editLapinKasusInsiden"
                                                        name="kasus_insiden" multiple style="width: 100%">
                                                        <option value="Penyakit Dalam dan Substansinya">Penyakit Dalam
                                                            dan
                                                            Substansinya</option>
                                                        <option value="Anak dan Subspesialisasinya">Anak dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Bedah dan Subspesialisasinya">Bedah dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Obstetri Gynekologi dan Subspesialisasinya">
                                                            Obstetri
                                                            Gynekologi dan Subspesialisasinya</option>
                                                        <option value="THT dan Subspesialisasinya">THT dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Mata dan Subspesialisasinya">Mata dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Saraf dan Subspesialisasinya">Saraf dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Anastesi dan Subspesialisasinya">Anastesi dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Kulit & Kelamin dan Subspesialisasinya">Kulit &
                                                            Kelamin
                                                            dan
                                                            Subspesialisasinya</option>
                                                        <option value="Jantung dan Subspesialisasinya">Jantung dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Paru dan Subspesialisasinya">Paru dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Jiwa dan Subspesialisasinya">Jiwa dan
                                                            Subspesialisasinya
                                                        </option>
                                                        <option value="Lain-lain" id="kasus_lain_lain">Lain-lain
                                                        </option>
                                                        <option value="Kasus Lain">Kasus Lain</option>
                                                    </select>
                                                    <input type="text" class="form-control d-none" id="editKasusLain"
                                                        name="kasus_insiden" placeholder="Masukkan kasus lain" required
                                                        style="width: 100%">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Unit / departemen yang terkait insiden
                                            <input type="text" class="form-control w-50" id="editLapinUnitInsiden"
                                                name="unit_insiden" placeholder="" required>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Akibat insiden terhadap korban
                                            <select class="form-select w-50" id="editLapinDampakInsiden"
                                                name="dampak_insiden">
                                                <option value="Kematian">Kematian</option>
                                                <option value="Cedera Irreversibel / Cedera Berat">Cedera Irreversibel /
                                                    Cedera Berat</option>
                                                <option value="Cedera Reversibel / Cedera Sedang">Cedera Reversibel /
                                                    Cedera Sedang</option>
                                                <option value="Cedera Ringan">Cedera Ringan</option>
                                                <option value="Tidak Ada Cedera">Tidak Ada Cedera</option>
                                            </select>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tindakan pertama yang dilakukan
                                            <input type="text" class="form-control w-50" id="editLapinTindakanCepat"
                                                name="tindakan_cepat" placeholder="" required>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                Tindakan pertama dilakukan oleh
                                            </span>
                                            <div class="col d-flex flex-column align-items-end">
                                                <select class="form-select mb-2" id="editLapinTindakanInsiden"
                                                    name="tindakan_insiden" style="width: 74%">
                                                    <option value="Tim">Tim</option>
                                                    <option value="Dokter">Dokter</option>
                                                    <option value="Perawat">Perawat</option>
                                                    <option value="Lain-lain" id="tindakan_lain_lain">Lain-lain</option>
                                                    <option value="Tindakan Lain">Tindakan Lain</option>
                                                </select>
                                                <input type="text" class="form-control d-none" id="editTindakanLain"
                                                    name="tindakan_insiden" placeholder="Masukkan tindakan lain"
                                                    required style="width: 74%">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                Insiden tersebut apakah pernah terjadi?
                                            </span>
                                            <div class="col d-flex flex-column align-items-end">
                                                <select class="form-select mb-2" id="editLapinKejadianInsiden"
                                                    name="kejadian_insiden" style="width: 82%">
                                                    <option value="Ya">Ya</option>
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Masukan Lain">Masukan Lain</option>
                                                </select>
                                                <input type="text" class="form-control d-none" id="editKejadianLain"
                                                    name="kejadian_insiden" placeholder="Masukkan kejadian lain"
                                                    required style="width: 82%">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
 --}}
