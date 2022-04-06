    <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "tabelmahasiswa";

    $koneksi = mysqli_connect($host, $user, $pass, $db);
    if (!$koneksi) { //cek koneksi
        die("tidak bisa terkoneksi ke database");
    }
    $nim        = "";
    $nama       = "";
    $alamat     = "";
    $kota       = "";
    $tgl_lahir  = "";
    $sukses     = "";
    $error      = "";

    if(isset($_GET['op'])){
        $op = $_GET['op'];
    }else{
        $op = "";
    }
    if($op == 'delete'){
        $nim    = $_GET['nim'];
        $sql1   = "delete from nim where nim = '$nim'";
        $q1     = mysqli_query($koneksi,$sql1);
        if($q1){
            $sukses = "Berhasil hapus data";
        }else{
            $error = "Gagal melakukan delete data";
        }
    }

    if(isset($_POST['simpan'])){ //untuk create
        $nim        = $_POST['nim'];
        $nama       = $_POST['nama'];
        $alamat     = $_POST['alamat'];
        $kota       = $_POST['kota'];
        $tgl_lahir  = $_POST['tgl_lahir'];

        if($nim && $nama && $alamat && $kota && $tgl_lahir){
            $sql1 = "insert into nim(nim,nama,alamat,kota,tgl_lahir) values ('$nim', '$nama' , '$alamat', '$kota' , '$tgl_lahir')";
            $q1   = mysqli_query($koneksi,$sql1);
            if($q1){
                $sukses = "Berhasil memasukkan data baru";
            }else{
                $error  = "Gagal memasukkan data baru";
            }
        }else{
            $error  = "Silahkan masukkan semua data";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tabel Mahasiswa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            .mx-auto {
                width: 800px;
            }

            .card {
                margin-top: 10px;
            }
        </style>
    </head>
    <html>
    <body>
        <div class="mx-auto">
            <!-- memasukkan data -->
            <div class="card">
                <div class="card-header">
                    Create / Edit
                </div>
                <div class="card-body">
                    <?php
                    if($error){
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    if($sukses){
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sukses ?>
                        </div>
                        <?php
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="kota" name="kota" value="<?php echo $kota ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $tgl_lahir ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>

            <!-- mengeluarkan data -->
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Data mahasiswa
                </div>
                <div class="card-body">
                <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            <tbody>
                                <?php 
                                $sql2   = "select * from nim order by nim desc";
                                $q2     = mysqli_query($koneksi,$sql2);
                                $urut   = 1;
                                while($r2 = mysqli_fetch_array($q2)){ 
                                    $nim        = $r2 ['nim'];
                                    $nama       = $r2 ['nama'];
                                    $alamat     = $r2 ['alamat'];
                                    $kota       = $r2 ['kota'];
                                    $tgl_lahir  = $r2 ['tgl_lahir'];
                                        
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $nim ?></td>
                                        <td scope="row"><?php echo $nama?></td>
                                        <td scope="row"><?php echo $alamat?></td>
                                        <td scope="row"><?php echo $kota?></td>
                                        <td scope="row"><?php echo $tgl_lahir?></td>
                                        <td scope="row">
                                            <a href="index.php?op=delete&nim=<?php echo $nim  ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a> 
                                            
                                        </td>
                                        
                                    </tr>

                                    <?php
                                }
                                ?>
                            </tbody>
                        </thead>
                </table>
                </div>
            </div>
        </div>
    </body>
    </html>