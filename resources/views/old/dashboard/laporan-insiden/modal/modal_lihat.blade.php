<div class="modal fade" id="lapinModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Data Pasien</h5>
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

                        <!-- Bagian 1: Informasi Pasien -->
                        <h5>Informasi Pasien</h5>
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Nama
                                    <p class="badge bg-primary badge-pill m-0"><span class="lapinNama"></span></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    No RM
                                    <p class="badge bg-primary badge-pill m-0"><span class="lapinNoRM"></span></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Jenis Kelamin
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinJenisKelamin"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Umur
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinUmur"></span></p>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6 mb-5">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Ruangan
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinRuangan"></span></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Penanggung Biaya
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinPenjamin"></span></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tanggal Masuk RS
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinTanggalMasuk"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Jam Masuk RS
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinJamMasuk"></span></p>
                                </li>
                            </ul>
                        </div>

                        <hr>

                        <!-- Bagian 2: Rincian Kejadian -->
                        <h5>Rincian Kejadian</h5>
                        <div class="col-md-12">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tanggal Kejadian Insiden
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinTanggalKejadian"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Jam Kejadian Insiden
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinJamKejadian"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Insiden
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Kronologis Insiden
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinKronologis"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Jenis Insiden
                                    <p class="badge bg-primary badge-pill m-0 w-25 text-wrap"><span
                                            id="lapinJenisInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Pelapor Insiden
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinPelaporInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Korban Insiden
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinKorbanInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Insiden menyangkut pasien
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinLayananInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tempat lokasi kejadian insiden
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinTempatInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Insiden terjadi pada pasien
                                    <p class="badge bg-primary badge-pill m-0 w-25 text-wrap"><span
                                            id="lapinKasusInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Unit / departemen yang terkait insiden
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinUnitInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Akibat insiden terhadap korban
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinDampakInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tindakan pertama yang dilakukan
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinTindakanCepat"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tindakan pertama dilakukan oleh
                                    <p class="badge bg-primary badge-pill m-0 w-25 text-wrap"><span
                                            id="lapinTindakanInsiden"></span>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Insiden tersebut apakah pernah terjadi?
                                    <p class="badge bg-primary badge-pill m-0"><span id="lapinKejadianInsiden"></span>
                                    </p>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
