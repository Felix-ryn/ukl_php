        <?php
        require_once("../misc/require.php");
        if($_SESSION['level'] !="admin"){
            header("location: ./../index.php");
        }
        ?>
    
        <!-- Panggil header -->
        <?php include("../utils/connect.php"); ?>
        <?php include("../misc/header.php"); ?>
        <div class="all-table">  
        <!-- Konten -->
        <h3>Tambah Siswa</h3>
        <form action="" method="POST">
            <table class="table table-hover table-dark" cellpadding="5">
                <tr>
                    <td>NISN :</td>
                    <td><input class="form-control" type="text" name="nisn"></td>
                </tr>
                <tr>
                    <td>NIS :</td>
                    <td><input class="form-control" type="text" name="nis"></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><input class="form-control" type="text" name="nama"></td>
                </tr>
                <tr>
                    <td>ID Kelas :</td>
                    <td>
                    <select name="nama_kelas" class="form-control">
                <?php
                include "connect.php";
                $qry_kelas = mysqli_query($conn, "select * from kelas");
                while ($data_kelas = mysqli_fetch_array($qry_kelas)) {
                    echo '<option value="' . $data_kelas['id_kelas'] . '">' . $data_kelas['nama_kelas'].'</option>';
                 } ?>
                    </select>   
                    </td>
                </tr>
                <tr>
                    <td>Alamat :</td>
                    <td><input class="form-control" type="text" name="alamat"></td>
                </tr>
                <tr>
                    <td>No. Telp :</td>
                    <td><input class="form-control" type="text" name="no_tlp"></td>
                </tr>
                <tr>
                <td>Angkatan :</td>
                    <td>
                    <div class="select">
                        <select class="custom-select" id="inlineFormCustomSelectPref" name="id_spp">
                            <?php
                            $tblspp = mysqli_query($conn, "SELECT * FROM spp");
                            while($r = mysqli_fetch_assoc($tblspp)){ ?>
                                <option value="<?= $r['id_spp']; ?>"><?= $r['id_spp'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    </td>
        
                </tr>
                <tr>
                    <td colspan="2">
                    <button class="btn btn-outline-secondary" onclick="history.back()" type="button">Kembali</button>
                    <button class="btn btn-outline-secondary" type="submit" name="simpan">Simpan</button>
                </td>
                </tr>
            </table>
        </form>
    </div>

        <!-- Panggil footer -->
        <?php
        include("../misc/footer.php") 
        ?>

    <?php
    // Proses Simpan
    if(isset($_POST['simpan'])){
        $nisn = $_POST['nisn'];
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $nama_kelas = $_POST['nama_kelas'];
        $alamat = $_POST['alamat'];
        $no_tlp = $_POST['no_tlp'];
        $id_spp = $_POST['id_spp'];

        $cek =mysqli_num_rows( mysqli_query($conn, "SELECT * FROM siswa where nisn='".$nisn."'"));
        if($cek > 0){
            echo "<script>alert('nisn telah digunakan ');location.href='tambah_siswa.php'</script>";
        }else{
            

        

        $simpan = mysqli_query($conn, "INSERT INTO siswa VALUE('$nisn', '$nis', '$nama', '$nama_kelas', '$alamat', '$no_tlp', '$id_spp')");
        
        $num=mysqli_affected_rows($conn);
        if($simpan){
            echo "<script>alert('Data Berhasil Ditambahkan !');location.href='siswa.php';</script>";
             header("location: siswa.php");
        }else{
            $error = mysqli_error($conn);
            echo $error;
            echo "<script>alert('Data gagal disimpan : '$error' !');location.href='tambah_siswa.php'</script>";
        }
       
        }
    }

    























  
    
                