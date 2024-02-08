@extends('dashboard.dashboard')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Laporan Insiden</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
            <svg class="bi">
                <use xlink:href="#calendar3" /></svg>
            This week
        </button>
    </div>
</div>

<div class="col-md-7 col-lg-8">
    <form action="{{ url('/addLapin') }}" method="post" enctype="multipart/form-data" onsubmit="return validasiForm()">
        @csrf

        <h4 class="mb-3">Data Pasien</h4>
        <div class="row g-3">
            <div class="col-sm-12">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="" required>
                <div class="invalid-feedback">
                    Valid Nama is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="noRM" class="form-label">No RM</label>
                <input type="text" class="form-control" id="noRM" name="noRM" placeholder="" required>
                <div class="invalid-feedback">
                    Valid No RM is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="ruangan" class="form-label">Ruangan</label>
                <input type="text" class="form-control" id="ruangan" name="ruangan" placeholder="" required>
                <div class="invalid-feedback">
                    Valid Ruangan is required.
                </div>
            </div>

            <div class="col-md-5">
                <label for="umur" class="form-label">Umur</label>
                <select class="form-select" id="umur" name="umur" required>
                    <option selected>Pilih...</option>
                    <option value="0 - 1 bulan"> 0 - 1 bulan</option>
                    <option value="> 1 bulan - 1 tahun"> > 1 bulan - 1 tahun</option>
                    <option value="> 1 tahun - 5 tahun"> > 1 tahun - 5 tahun</option>
                    <option value="> 5 tahun - 15 tahun"> > 5 tahun - 15 tahun</option>
                    <option value="> 15 tahun - 30 tahun"> > 15 tahun - 30 tahun</option>
                    <option value="> 30 tahun - 65 tahun"> > 30 tahun - 65 tahun</option>
                    <option value="> 65 tahun"> > 65 tahun</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid Umur.
                </div>
            </div>

            <div class="col-md-6">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input id="laki-laki" name="jenis_kelamin" type="radio" class="form-check-input"
                            value="Laki-laki" required>
                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="perempuan" name="jenis_kelamin" type="radio" class="form-check-input"
                            value="Perempuan" required>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="penjamin" class="form-label">Penanggung Biaya Pasien</label>
                <div class="form-group">
                    <div class="form-check form-check-inline  ms-3">
                        <input id="pribadi" name="penjamin" type="radio" class="form-check-input" value="Pribadi"
                            required>
                        <label class="form-check-label" for="pribadi">Pribadi</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="pemerintah" name="penjamin" type="radio" class="form-check-input" value="Pemerintah"
                            required>
                        <label class="form-check-label" for="pemerintah">Pemerintah</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="bpjs" name="penjamin" type="radio" class="form-check-input" value="BPJS" required>
                        <label class="form-check-label" for="bpjs">BPJS</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="asuransi_swasta" name="penjamin" type="radio" class="form-check-input"
                            value="Asuransi Swasta" required>
                        <label class="form-check-label" for="asuransi_swasta">Asuransi Swasta</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="perusahaan" name="penjamin" type="radio" class="form-check-input" value="Perusahaan"
                            required>
                        <label class="form-check-label" for="perusahaan">Perusahaan</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="lain-lain" name="penjamin" type="radio" class="form-check-input" value="Lain-lain"
                            required>
                        <label class="form-check-label" for="lain-lain">Lain-lain</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk RS:</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
            </div>
            <div class="col-md-5">
                <label for="jam_masuk" class="form-label">Jam:</label>
                <input type="time" class="form-control" id="jam_masuk" name="jam_masuk">
            </div>

            <hr class="my-4">

            <h4 class="my-0">Rincian Kejadian</h4>

            <p class="mt-3 mb-0">1. Tanggal dan Waktu Insiden</p>

            <div class="col-md-6 mt-2">
                <label for="tanggal_kejadian" class="form-label">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian">
            </div>
            <div class="col-md-5 mt-2">
                <label for="jam_kejadian" class="form-label">Jam:</label>
                <input type="time" class="form-control" id="jam_kejadian" name="jam_kejadian">
            </div>

            <div class="col-md-12">
                <label for="insiden" class="form-label">2. Insiden</label>
                <input type="text" class="form-control" id="insiden" name="insiden" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid Insiden is required.
                </div>
            </div>

            <div class="col-md-12">
                <label for="kronologis" class="form-label">3. Kronologis Insiden</label>
                <textarea class="form-control" id="kronologis" name="kronologis" placeholder="" value=""
                    required></textarea>
                <div class="invalid-feedback">
                    Valid Kronologis Insiden is required.
                </div>
            </div>

            <div class="col-md-12">
                <label for="jenis_insiden" class="form-label">4. Jenis Insiden</label>
                <div class="form-group">
                    <div class="form-check form-check-inline  ms-3">
                        <input id="knc" name="jenis_insiden" type="radio" class="form-check-input"
                            value="Kejadian Nyaris Cedera / KNC" required>
                        <label class="form-check-label" for="knc">Kejadian Nyaris Cedera / KNC</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="ktc" name="jenis_insiden" type="radio" class="form-check-input"
                            value="Kejadian Tidak Cedera / KTC" required>
                        <label class="form-check-label" for="ktc">Kejadian Tidak Cedera / KTC</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="ktd" name="jenis_insiden" type="radio" class="form-check-input"
                            value="Kejadian Tidak Diharapkan / KTD" required>
                        <label class="form-check-label" for="ktd">Kejadian Tidak Diharapkan /
                            KTD</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="kpc" name="jenis_insiden" type="radio" class="form-check-input" value="KPC" required>
                        <label class="form-check-label" for="kpc">KPC</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="pelapor_insiden" class="form-label">5. Orang Pertama yang Melaporkan
                    Insiden</label>
                <div class="form-group">
                    <div class="form-check form-check-inline  ms-3">
                        <input id="pelapor_karyawan" name="pelapor_insiden" type="radio" class="form-check-input"
                            value="Karyawan ( Dokter / Perawat / Petugas Lainnya )" required>
                        <label class="form-check-label" for="pelapor_karyawan">Karyawan ( Dokter /
                            Perawat / Petugas Lainnya )</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="pelapor_pasien" name="pelapor_insiden" type="radio" class="form-check-input"
                            value="Pasien" required>
                        <label class="form-check-label" for="pelapor_pasien">Pasien</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="pelapor_pengunjung" name="pelapor_insiden" type="radio" class="form-check-input"
                            value="Pengunjung" required>
                        <label class="form-check-label" for="pelapor_pengunjung">Pengunjung</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="pelapor_keluarga" name="pelapor_insiden" type="radio" class="form-check-input"
                            value="Keluarga / Pendamping" required>
                        <label class="form-check-label" for="pelapor_keluarga">Keluarga / Pendamping
                            Pasien</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3 mt-2 p-0">
                        <div class="input-group">
                            <div class="input-group-text">
                                <input id="pelapor_lain" name="pelapor_insiden" class="form-check-input mt-0 ms-0"
                                    type="radio" value="" aria-label="Radio button for following text input">
                            </div>
                            <input id="ket_pelapor_lain" type="text" class="form-control"
                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                onclick="selectRadio('pelapor_lain')"
                                oninput="syncInputRadio('pelapor_lain', 'ket_pelapor_lain')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="korban_insiden" class="form-label">6. Insiden terjadi pada</label>
                <div class="form-group">
                    <div class="form-check form-check-inline  ms-3">
                        <input id="korban_pasien" name="korban_insiden" type="radio" class="form-check-input"
                            value="Pasien" required>
                        <label class="form-check-label" for="korban_pasien">Pasien</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3 p-0">
                        <div class="input-group">
                            <div class="input-group-text">
                                <input id="korban_lain" name="korban_insiden" class="form-check-input mt-0 ms-0"
                                    type="radio" value="" aria-label="Radio button for following text input">
                            </div>
                            <input id="ket_korban_lain" type="text" class="form-control"
                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                onclick="selectRadio('korban_lain')"
                                oninput="syncInputRadio('korban_lain', 'ket_korban_lain')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="layanan_insiden" class="form-label">7. Insiden menyangkut pasien</label>
                <div class="form-group">
                    <div class="form-check form-check-inline  ms-3">
                        <input id="layanan_rawat_inap" name="layanan_insiden" type="radio" class="form-check-input"
                            value="Pasien Rawat Inap" required>
                        <label class="form-check-label" for="layanan_rawat_inap">Pasien Rawat
                            Inap</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="layanan_rawat_jalan" name="layanan_insiden" type="radio" class="form-check-input"
                            value="Pasien Rawat Jalan" required>
                        <label class="form-check-label" for="layanan_rawat_jalan">Pasien Rawat
                            Jalan</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="layanan_ugd" name="layanan_insiden" type="radio" class="form-check-input"
                            value="Pasien UGD" required>
                        <label class="form-check-label" for="layanan_ugd">Pasien UGD</label>
                    </div>
                    <div class="form-check form-check-inline p-0">
                        <div class="input-group">
                            <div class="input-group-text">
                                <input id="layanan_lain" name="layanan_insiden" class="form-check-input mt-0 ms-0"
                                    type="radio" value="" aria-label="Radio button for following text input">
                            </div>
                            <input id="ket_layanan_lain" type="text" class="form-control"
                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                onclick="selectRadio('layanan_lain')"
                                oninput="syncInputRadio('layanan_lain', 'ket_layanan_lain')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="tempat_insiden" class="form-label">8. Tempat Insiden</label>
                <input type="text" class="form-control" id="tempat_insiden" name="tempat_insiden" placeholder=""
                    value="" required>
                <div class="invalid-feedback">
                    Valid Tempat Insiden is required.
                </div>
            </div>

            <div class="col-md-12">
                <label for="kasus_insiden" class="form-label">9. Insiden terjadi pada pasien ( sesuai
                    kasus penyakit / spesialisasi )</label>
                <div class="form-group">
                    <div class="form-check">
                        <input id="insiden_dalam" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Penyakit Dalam dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_dalam">Penyakit Dalam dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_anak" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Anak dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_anak">Anak dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_bedah" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Bedah dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_bedah">Bedah dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_obstetri" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Obstetri Gynekologi dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_obstetri">Obstetri Gynekologi dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_tht" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="THT dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_tht">THT dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_mata" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Mata dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_mata">Mata dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_saraf" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Saraf dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_saraf">Saraf dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_anastesi" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Anastesi dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_anastesi">Anastesi dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_kulit" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Kulit & Kelamin dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_kulit">Kulit & Kelamin dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_jantung" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Jantung dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_jantung">Jantung dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_paru" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Paru dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_paru">Paru dan
                            Subspesialiasinya</label>
                    </div>
                    <div class="form-check">
                        <input id="insiden_jiwa" name="kasus_insiden[]" type="checkbox" class="form-check-input"
                            value="Jiwa dan Subspesialisasinya">
                        <label class="form-check-label" for="insiden_jiwa">Jiwa dan
                            Subspesialiasinya</label>
                    </div>

                    <div class="form-check ps-0">
                        <div class="input-group">
                            <div class="input-group-text">
                                <input id="kasus_lain" name="kasus_insiden[]" class="form-check-input mt-0 ms-0"
                                    type="checkbox" value="" aria-label="Radio button for following text input">
                            </div>
                            <input id="ket_kasus_lain" type="text" class="form-control"
                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                onclick="selectRadio('kasus_lain')"
                                oninput="syncInputRadio('kasus_lain', 'ket_kasus_lain')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="unit_insiden" class="form-label">10. Unit / Departemen terkait yang
                    menyebabkan insiden</label>
                <input type="text" class="form-control" id="unit_insiden" name="unit_insiden" placeholder="" value=""
                    required>
                <div class="invalid-feedback">
                    Valid Unit Insiden is required.
                </div>
            </div>

            <div class="col-md-12">
                <label for="dampak_insiden" class="form-label">11. Akibat insiden terhadap
                    pasien</label>
                <div class="form-group">
                    <div class="form-check form-check-inline  ms-3">
                        <input id="dampak_kematian" name="dampak_insiden" type="radio" class="form-check-input"
                            value="Kematian" required>
                        <label class="form-check-label" for="dampak_kematian">Kematian</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="dampak_cedera_berat" name="dampak_insiden" type="radio" class="form-check-input"
                            value="Cedera Irreversibel / Cedera Berat" required>
                        <label class="form-check-label" for="dampak_cedera_berat">Cedera Irreversibel /
                            Cedera Berat</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="dampak_cedera_sedang" name="dampak_insiden" type="radio" class="form-check-input"
                            value="Cedera Reversibel / Cedera Sedang" required>
                        <label class="form-check-label" for="dampak_cedera_sedang">Cedera Reversibel /
                            Cedera Sedang</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="dampak_cedera_ringan" name="dampak_insiden" type="radio" class="form-check-input"
                            value="Cedera Ringan" required>
                        <label class="form-check-label" for="dampak_cedera_ringan">Cedera Ringan</label>
                    </div>
                    <div class="form-check form-check-inline  ms-3">
                        <input id="dampak_tidak_ada" name="dampak_insiden" type="radio" class="form-check-input"
                            value="Tidak Ada Cedera" required>
                        <label class="form-check-label" for="dampak_tidak_ada">Tidak Ada Cedera</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="tindakan_cepat" class="form-label">12. Tindakan yang dilakukan segera
                    setelah
                    kejadian, dan hasilnya</label>
                <textarea class="form-control" id="tindakan_cepat" name="tindakan_cepat" placeholder="" value=""
                    required></textarea>
                <div class="invalid-feedback">
                    Valid Tindakan Insiden is required.
                </div>
            </div>

            <div class="col-md-12">
                <label for="tindakan_insiden" class="form-label">13. Tindakan dilakukan oleh</label>
                <div class="form-group">
                    <div class="form-check ps-0">
                        <div class="input-group">
                            <div class="input-group-text">
                                <input id="tindakan_tim" name="tindakan_insiden" type="radio"
                                    class="form-check-input ms-0 mt-0 me-2" required>
                                <label class="form-check-label" for="tindakan_tim">Tim</label>
                            </div>
                            <input id="anggota_tim" name="tindakan_insiden" type="hidden" class="form-control"
                                aria-label="Text input with radio button">
                            <input id="ket_tindakan_tim" type="text" class="form-control"
                                aria-label="Text input with radio button" placeholder="Terdiri dari"
                                onclick="selectRadio('tindakan_tim')"
                                oninput="syncInputRadioSpecial('tindakan_tim', 'anggota_tim', 'ket_tindakan_tim')">
                        </div>
                    </div>
                    <div class="form-check ms-3">
                        <input id="tindakan_dokter" name="tindakan_insiden" type="radio" class="form-check-input"
                            value="Dokter" required>
                        <label class="form-check-label" for="tindakan_dokter">Dokter</label>
                    </div>
                    <div class="form-check ms-3">
                        <input id="tindakan_perawat" name="tindakan_insiden" type="radio" class="form-check-input"
                            value="Perawat" required>
                        <label class="form-check-label" for="tindakan_perawat">Perawat</label>
                    </div>
                    <div class="form-check ps-0">
                        <div class="input-group">
                            <div class="input-group-text">
                                <input id="tindakan_petugas_lain" name="tindakan_insiden"
                                    class="form-check-input mt-0 ms-0" type="radio" value=""
                                    aria-label="Radio button for following text input">
                            </div>
                            <input id="ket_tindakan_petugas_lain" type="text" class="form-control"
                                aria-label="Text input with radio button" placeholder="Petugas lainnya"
                                onclick="selectRadio('tindakan_petugas_lain')"
                                oninput="syncInputRadio('tindakan_petugas_lain', 'ket_tindakan_petugas_lain')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="kejadian_insiden" class="form-label">14. Apakah kejadian yang sama pernah
                    terjadi di Unit Kerja lain?</label>
                <div class="form-group">
                    <div class="form-check ms-3">
                        <input id="pernah_terjadi" name="kejadian_insiden" type="radio" class="form-check-input"
                            value="ya" onclick="showTextarea('keterangan_unit_kerja')" required>
                        <label class="form-check-label" for="pernah_terjadi">Ya</label>
                        <div id="keterangan_unit_kerja" class="d-none">
                            <label for="ket_kejadian_insiden">Kapan? dan Langkah / tindakan apa yang
                                telah diambil pada Unit Kerja tersebut untuk mencegah terulangnya
                                kejadian yang sama?</label>
                            <input id="des_kejadian_insiden" name="kejadian_insiden" type="hidden" class="form-control"
                                aria-label="Text input with radio button">
                            <textarea id="ket_kejadian_insiden" class="form-control"
                                oninput="syncInputRadioSpecial('pernah_terjadi', 'des_kejadian_insiden', 'ket_kejadian_insiden')"></textarea>
                        </div>
                    </div>
                    <div class="form-check ms-3">
                        <input id="tidak_terjadi" name="kejadian_insiden" type="radio" class="form-check-input"
                            value="Tidak" onclick="hideTextarea('keterangan_unit_kerja')" required>
                        <label class="form-check-label" for="tidak_terjadi">Tidak</label>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button class="w-25 btn btn-primary btn-lg my-2" type="submit">Submit</button>
            </div>
    </form>
</div>

@endsection
