<?php 
require_once("../config/koneksi.php");

$pencarian = @$_POST['pencarian'];
$act = @$_GET['act'];
$id_pelanggan = @$_GET['id_pelanggan'];

if (empty($act)) {
  $id_pelanggan = "";
  $nama_pelanggan = "";
  $no_telp = "";
  $alamat = "";
  $btn = "Save";
} else {
  if ($act == "edit") {
    $sql = "SELECT * FROM tb_pelanggan where id_pelanggan='$id_pelanggan'";
    $btn = "Update";
  } else if ($act == "delete") {
    $sql = "SELECT * FROM tb_pelanggan where id_pelanggan='$id_pelanggan'";
    $btn = "Delete";
  } else {
    $sql = "SELECT * FROM tb_pelanggan";
    $btn = "Save";
  }
  $result = $mysqli->query($sql);

  while ($row = $result->fetch_assoc()) {
    $id_pelanggan = $row['id_pelanggan'];
    $nama_pelanggan = $row['nama_pelanggan'];
    $no_telp = $row['no_telp'];
    $alamat = $row['alamat'];
  }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../../img/hotel.png" type="image/x-icon">
    <title>Aplikasi Hotel</title>
</head>
<body>

    <fieldset>
        <form action="pelanggan-act.php" method="post">
            <h2>Form Input Pelanggan</h2>
            <table align="center" cellpadding="15">
                <tr>
                    <td>Id Pelanggan</td>
                    <td>:</td>
                    <td><input type="text" name="id_pelanggan" value="<?=$id_pelanggan;?>" autocomplete="off" placeholder="Masukan Id Pelanggan"></td>

                    <td>&ensp;</td>

                    <td>No Telp</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="no_telp" value="<?=$no_telp;?>" autocomplete="off" placeholder="Masukan Nomor Telepon">
                    </td>
                </tr>

                <tr>
                    <td>Nama Pelanggan</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama_pelanggan" value="<?=$nama_pelanggan;?>" autocomplete="off" placeholder="Masukan Nama Pelanggan">
                    </td>

                    <td>&ensp;</td>

                    <td>Alamat</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="alamat" value="<?=$alamat;?>" autocomplete="off" placeholder="Masukan Alamat">
                    </td>
                </tr>
            </table>
            <div class="tombol">
                <input type="submit" value="<?=$btn;?>">
                <input type="reset" value="Cancel">
                <a href="pelanggan-form.php"><input type="button" value="Refresh"></a>
                <input type="hidden" name="act" value="<?=$act;?>">
                <input type="hidden" name="id" value="<?=$id_pelanggan;?>">
            </div>
        </form>
    </fieldset>

    <?php 
        $sql = "SELECT * FROM tb_pelanggan WHERE id_pelanggan LIKE '%$pencarian%' OR nama_pelanggan LIKE '%$pencarian%' OR alamat LIKE '%$pencarian%'";
        $result = $mysqli->query($sql);
    ?>

    <div class="next-page">
        <form method="post" class="search-form">
            <input type="text" name="pencarian" id="pencarian" autocomplete="off" placeholder="Cari Data Pelanggan">
        </form>

        <div class="links">
            <p><a href="pemesanan-form.php" class="pindahform">Form Pemesanan</a></p>
            <p><a href="pembayaran-form.php" class="pindahform">Form Pembayaran</a></p>
        </div>
    </div>

    <div id="container" class="table-wrapper">
        <table id="reservasi" align=center cellspacing=0>  
            <tr>
                <th align=left>Id Pelanggan</th>
                <th align=left>Nama Pelanggan</th>
                <th align=left>No Telp</th>
                <th align=left>Alamat</th>
                <th>Action</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id_pelanggan"]."</td>";
                echo "<td>".$row["nama_pelanggan"]."</td>";
                echo "<td>".$row["no_telp"]."</td>";
                echo "<td>".$row["alamat"]."</td>";
                echo "<td align='center'>
                        <a href='pelanggan-form.php?act=edit&id_pelanggan=".$row['id_pelanggan']."'><img src='../../img/update.png' width='25px'></a>
                        <a href='pelanggan-form.php?act=delete&id_pelanggan=".$row['id_pelanggan']."'><img src='../../img/delete.png' width='25px''></a></td>";
                echo "</tr>";
            }

            $result->free_result();
            $mysqli->close();
            ?>
        </table>
    </div>
    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/pelanggan.js"></script>

</body>
</html>