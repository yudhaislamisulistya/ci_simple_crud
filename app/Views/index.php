<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Sederhana Dengan Codeigniter By Yudha</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/dataTables.css') ?>">

    <style>
        .loader {
            display: none;
        }

        .tombolSubmit {
            display: contents;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Contoh Data Mahasiswa Sederhana</h2>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#modalTambahMahasiswa">
                            Tambah
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalTambahMahasiswa" tabindex="-1"
                            aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahMahasiswaLabel">Tambah Mahasiswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" id="namaMahasiswa"
                                                placeholder="Yudha Islami Sulistya">
                                        </div>
                                        <div class="form-group">
                                            <label>Stambuk</label>
                                            <input type="text" class="form-control" id="stambukMahasiswa"
                                                placeholder="13020170214">
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <input type="text" class="form-control" id="kelasMahasiswa"
                                                placeholder="A5">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="tombolSubmit">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="simpanMahasiswa">Save
                                                changes</button>
                                        </div>
                                        <div class="loader">
                                            <img src="<?= base_url('images/loading.gif') ?>" alt="" width="50"
                                                height="auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalUbahMahasiswa" tabindex="-1"
                            aria-labelledby="modalUbahMahasiswaLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalUbahMahasiswaLabel">Tambah Mahasiswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="idUbahMahasiswa">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" id="namaUbahMahasiswa"
                                                placeholder="Yudha Islami Sulistya">
                                        </div>
                                        <div class="form-group">
                                            <label>Stambuk</label>
                                            <input type="text" class="form-control" id="stambukUbahMahasiswa"
                                                placeholder="13020170214">
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <input type="text" class="form-control" id="kelasUbahMahasiswa"
                                                placeholder="A5">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="tombolSubmit">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="ubahMahasiswa">Save
                                                changes</button>
                                        </div>
                                        <div class="loader">
                                            <img src="<?= base_url('images/loading.gif') ?>" alt="" width="50"
                                                height="auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="datatable-data-mahasiswa">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Stambuk</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Tanggal Ubah</th>
                                    <th scope="col">Tanggal Update</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="<?= base_url('js/jquery.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('js/datatables.js') ?>"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#datatable-data-mahasiswa').DataTable();

        function getDataTable(params) {
            table.destroy();
            table = $('#datatable-data-mahasiswa').DataTable({
                ajax: {
                    url: "<?= base_url('tampil-mahasiswa') ?>",
                },
                "columns": [{
                        data: "nama"
                    },
                    {
                        data: "stambuk"
                    },
                    {
                        data: "kelas"
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "updated_at"
                    },
                    {
                        sortable: false,
                        "render": function (data, type, full, meta) {
                            return `
                                        <td>
                                            <button data-toggle="modal" data-target="#modalUbahMahasiswa" id="lihatDataMahasiswa" data-id="` +
                                full.id + `" class="btn btn-info btn-small">Ubah</button>
                                            <button id="hapusMahasiswa" data-id="` + full.id + `" class="btn btn-danger btn-small">Hapus</button>
                                        </td>
                                    `;
                        }
                    },
                ]
            })
        }

        $(document).ready(function () {
            getDataTable();
        });
        $('#simpanMahasiswa').on('click', function () {
            $('.loader').show();
            $('.tombolSubmit').hide();
            var namaMahasiswa = $('#namaMahasiswa').val();
            var stambukMahasiswa = $('#stambukMahasiswa').val();
            var kelasMahasiswa = $('#kelasMahasiswa').val();
            axios.post("<?= base_url('simpan-mahasiswa') ?>", {
                    nama: namaMahasiswa,
                    stambuk: stambukMahasiswa,
                    kelas: kelasMahasiswa,
                })
                .then(res => {
                    console.log(res.data);
                    $('.loader').hide();
                    $('.tombolSubmit').show();
                    if (res.data.status == 200) {
                        Swal.fire(
                            'Status!',
                            res.data.message,
                            'success'
                        )
                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire(
                            'Status!',
                            res.data.message,
                            'error'
                        )
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        });

        $(document).on("click", '#hapusMahasiswa', function () {
            var id = $(this).data("id");
            console.log(id);
            Swal.fire({
            title: 'Apakah Benar Mau Menghapus?',
            text: "Data Yang Dihapus Tidak Dapat Dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus!'
            }).then((result) => {
            if (result.value) {
                axios.delete("<?= base_url("hapus-mahasiswa") ?>/" + id)
                .then(res => {
                    console.log(res.data);
                    if (res.data.status == 200) {
                            Swal.fire(
                                'Status!',
                                'Data Berhasil Dihapus!',
                                'success'
                            )
                            table.ajax.reload( null, false );
                        }else{
                            Swal.fire(
                                'Status!',
                                'Data Gagal Dihapus!',
                                'error'
                            )
                        }
                })
                .catch(err => {
                    console.error(err); 
                })
            }else{
                Swal.fire(
                'Status!',
                'Data Gagal Dihapus.',
                'error'
                )
            }
        })
        });

        $(document).on("click", '#lihatDataMahasiswa', function () {
            var id = $(this).data("id");
            console.log(id);
            axios.get("<?= base_url("lihat-mahasiswa") ?>/ " + id)
            .then(res => {
                console.log(res.data);
                $('#idUbahMahasiswa').val(res.data[0].id);
                $('#namaUbahMahasiswa').val(res.data[0].nama);
                $('#stambukUbahMahasiswa').val(res.data[0].stambuk);
                $('#kelasUbahMahasiswa').val(res.data[0].kelas);
            })
            .catch(err => {
                console.error(err); 
            })
        });

        $('#ubahMahasiswa').on('click', function () {
            $('.loader').show();
            $('.tombolSubmit').hide();
            var idUbahMahasiswa = $('#idUbahMahasiswa').val();
            var namaMahasiswa = $('#namaUbahMahasiswa').val();
            var stambukMahasiswa = $('#stambukUbahMahasiswa').val();
            var kelasMahasiswa = $('#kelasUbahMahasiswa').val();
            axios.put("<?= base_url('ubah-mahasiswa') ?>/" + idUbahMahasiswa, {
                    nama: namaMahasiswa,
                    stambuk: stambukMahasiswa,
                    kelas: kelasMahasiswa,
                })
                .then(res => {
                    $('.loader').hide();
                    $('.tombolSubmit').show();
                    if (res.data.status == 200) {
                        Swal.fire(
                            'Status!',
                            res.data.message,
                            'success'
                        )
                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire(
                            'Status!',
                            res.data.message,
                            'error'
                        )
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        });
    </script>
</body>

</html>