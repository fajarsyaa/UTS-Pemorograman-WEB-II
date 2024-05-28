<?php
require 'crud.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tugas UTS Pemrograman WEB II</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-5">
        <div class="mt-2 mb-2">
            <h1 class="text-center">INVENTORY</h1>
        </div>

        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#formAdd">
            Tambah Barang
        </button>
        <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#pakaiBarang">
            Pakai Barang
        </button>

        <table id="example" class="table table-striped display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dataBarang as $barang) {
                ?>
                    <tr>
                        <td><?= $barang['id'] ?></td>
                        <td><?= $barang['kode_barang'] ?></td>
                        <td><?= $barang['nama_barang'] ?></td>
                        <td><?= $barang['jumlah_barang'] ?></td>
                        <td><?= $barang['satuan_barang'] ?></td>
                        <td><?= $barang['harga_beli'] ?></td>
                        <td><?= $barang['status_barang'] == 1 ? 'Available' : 'Not-Available' ?></td>
                        <td>
                            <div class="row">
                                <button class="btn btn-success formRestock" data-toggle="modal" data-target="#restock">restock</button>
                                <button class="btn btn-warning  mx-2 formEdit" data-toggle="modal">edit</button>
                                <form action="http://localhost/tugas_pweb_2/crud.php" method="post" id="formDelete">
                                    <input type="hidden" name="idDelete" value="<?= $barang['id'] ?>">
                                    <button type="submit" class="deleteData btn btn-danger" name="delete">delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="formAdd" tabindex="-1" role="dialog" aria-labelledby="formAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="http://localhost/tugas_pweb_2/crud.php" id="formAddData">
                    <input type="hidden" name="addData" value="addData">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode">Kode Barang</label>
                            <input type="text" class="form-control" id="kode" name="kode">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan Barang</label>
                            <select class="form-control" id="satuan" name="satuan">
                                <option value="Kg">Kg</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Liter">Liter</option>
                                <option value="Meter">Meter</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Beli</label>
                            <input type="number" class="form-control" id="harga" name="harga">
                        </div>                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="subbmitAddData" name="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="formEditModal" tabindex="-1" role="dialog" aria-labelledby="formEdit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Barang</h5>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="http://localhost/tugas_pweb_2/crud.php" id="formEditBarang">                     
                    <input type="hidden" id="idEdit" name="idedit">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode">Kode Barang</label>
                            <input type="text" class="form-control" id="kodeEdit" name="kode">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="namaEdit" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlahEdit" name="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan Barang</label>
                            <select class="form-control" id="satuanEdit" name="satuan">
                                <option value="Kg">Kg</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Liter">Liter</option>
                                <option value="Meter">Meter</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Beli</label>
                            <input type="number" class="form-control" id="hargaEdit" name="harga">
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeButton" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitEdit" name="update" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Restock -->
    <div class="modal fade" id="restock" tabindex="-1" role="dialog" aria-labelledby="restock" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Restock Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="http://localhost/tugas_pweb_2/crud.php" id="formSubmitRestock">
                    <input type="hidden" name="restockID" id="idRestock">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="namaRestock" name="nama" value="barang A" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlahRestock" name="jumlah">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitRestock" name="restock" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Pakai Barang -->
    <div class="modal fade" id="pakaiBarang" tabindex="-1" role="dialog" aria-labelledby="pakaiBarang" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pakai Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="http://localhost/tugas_pweb_2/crud.php" id="formPakaiBarang">
                    <input type="hidden" name="pakaiBarang" value="ya">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="itemSelect">Pilih Barang</label>
                            <select class="form-control" id="itemSelect" name="barangId">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlahPakai">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlahPakai" name="jumlah_pakai">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitPakaiBarang" name="pakai" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js "></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script>
        $(function() {
            $('#example').DataTable();

            $('#subbmitAddData').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'http://localhost/tugas_pweb_2/crud.php',
                    type: 'POST',
                    data: $('#formAddData').serialize(),
                    success: function(response) {                       
                        alert('Data berhasil ditambahkan!');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.deleteData').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'http://localhost/tugas_pweb_2/crud.php',
                    type: 'POST',
                    data: $(this).closest('form').serialize(),
                    success: function(response) {
                        console.log(response);
                        alert('Data berhasil dihapus!');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#pakaiBarang').on('click', function() {
                var selectedItem = $('#itemSelect').val();

                $.ajax({
                    url: 'http://localhost/tugas_pweb_2/crud.php',
                    type: 'POST',
                    data: {
                        fetchAllItems: true
                    },
                    success: function(response) {
                        var items = JSON.parse(response);
                        var $select = $('#itemSelect');
                        $select.empty();
                        items.forEach(function(item) {
                            $select.append('<option value="' + item.id + '">' + item.nama_barang + '</option>');
                        });

                        if (selectedItem) {
                            $select.val(selectedItem);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#submitPakaiBarang').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'http://localhost/tugas_pweb_2/crud.php',
                    type: 'POST',
                    data: $('#formPakaiBarang').serialize(),
                    success: function(response) {
                        alert(response);
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.formEdit').on('click', function() {
                // Ambil id dari data yang di-klik
                var idEdit = $(this).closest('tr').find('td:first').text();                
                $.ajax({
                    url: 'http://localhost/tugas_pweb_2/crud.php',
                    type: 'POST',
                    data: {
                        fetchItems: true,
                        idEdit: idEdit
                    },
                    success: function(response) {  
                        console.log(response);                      
                        var item = JSON.parse(response);
                        
                        $('#idEdit').val(item.id);
                        $('#kodeEdit').val(item.kode_barang);
                        $('#namaEdit').val(item.nama_barang);
                        $('#jumlahEdit').val(item.jumlah_barang);
                        $('#hargaEdit').val(item.harga_beli);
                        $('#statusEdit').val(item.status_barang);

                        var Options = $('#satuanEdit').find('option');
                        Options.filter(function() {
                            return $(this).text() === item.satuan_barang;
                        }).prop('selected', true);

                        $('#formEditModal').modal('show');                        
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#submitEdit').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'http://localhost/tugas_pweb_2/crud.php',
                    type: 'POST',
                    data: $('#formEditBarang').serialize(),
                    success: function(response) {                                                
                        alert(response);
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.formRestock').on('click', function() {
                // Ambil id dari data yang di-klik
                var idEdit = $(this).closest('tr').find('td:first').text();                
                $.ajax({
                    url: 'http://localhost/tugas_pweb_2/crud.php',
                    type: 'POST',
                    data: {
                        fetchItems: true,
                        idEdit: idEdit
                    },
                    success: function(response) {                                         
                        var item = JSON.parse(response);
                        $('#namaRestock').val(item.nama_barang);
                        $('#jumlahRestock').val(item.jumlah_barang);
                        $('#idRestock').val(item.id);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#submitRestock').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'http://localhost/tugas_pweb_2/crud.php',
                    type: 'POST',
                    data: $('#formSubmitRestock').serialize(),
                    success: function(response) {                                                
                        alert(response);
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.closeButton').on('click', function() {
                $('#formEditModal').modal('hide');    
            });

        });
    </script>
</body>

</html>