<?php 
require_once("../config/koneksi.php");

$pencarian = @$_POST['pencarian'];
$act = @$_GET['act'];
$id_pemesanan = @$_GET['id_pemesanan'];

if (empty($act)) {
  $id_pemesanan = "";
  $id_pelanggan = "";
  $id_kamar = "";
  $jumlah_kamar = "";
  $lama_menginap = "";
  $btn = "Save";
} else {
  if ($act == "edit") {
    $sql = "SELECT * FROM tb_pemesanan where id_pemesanan='$id_pemesanan'";
    $btn = "Update";
  } else if ($act == "delete") {
    $sql = "SELECT * FROM tb_pemesanan where id_pemesanan='$id_pemesanan'";
    $btn = "Delete";
  } else {
    $sql = "SELECT * FROM tb_pemesanan";
    $btn = "Save";
  }
  $result = $mysqli->query($sql);

  while ($row = $result->fetch_assoc()) {
    $id_pemesanan = $row['id_pemesanan'];
    $id_pelanggan = $row['id_pelanggan'];
    $id_kamar = $row['id_kamar'];
    $jumlah_kamar = $row['jumlah_kamar'];
    $lama_menginap = $row['lama_menginap'];
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
        <form action="pemesanan-act.php" method="post" name="form1">
            <h2>Form Input Pemesanan</h2>
            <table align="center" cellpadding="15">
                <tr>
                    <td>Id Pemesanan</td>
                    <td>:</td>
                    <td><input type="text" name="id_pemesanan" value="<?=$id_pemesanan;?>" autocomplete="off" placeholder="Masukan Id Pemesanan"></td>

                    <td>&ensp;</td>

                    <td>Jumlah Kamar</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="jumlah_kamar" value="<?=$jumlah_kamar;?>" autocomplete="off" placeholder="Masukan Jumlah Kamar">
                    </td>
                </tr>
                    <td>Id Pelanggan</td>
                    <td>:</td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <input type="text" name="id_pelanggan" value="<?=$id_pelanggan;?>" autocomplete="off" placeholder="Masukan Id Pelanggan">
                            <input type="button" style="background:url('../../img/search.png'); background-repeat:no-repeat; background-size: cover; width: 29px; height: 29px; background-color:white;" class="buttonlogin" onclick="NewWindow('ho_get_lov_pelanggan.php?returnform=form1','lov','800','600','yes','300','10');return false;">
                            <input type="hidden" name="fk_pelanggan" id="fk_pelanggan" value="<?$fk_pelanggan;?>">
                        </div>
                    </td>

                    <td>&ensp;</td>

                    <td>Lama Menginap</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="lama_menginap" value="<?=$lama_menginap;?>" autocomplete="off" placeholder="Masukan Lama Menginap">
                    </td>
                </tr>

                <tr>
                    <td>Id Kamar</td>
                    <td>:</td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <input type="text" name="id_kamar" value="<?=$id_kamar;?>" autocomplete="off" placeholder="Masukan Id Kamar">
                            <input type="button" style="background:url('../../img/search.png'); background-repeat:no-repeat; background-size: cover; width:29px; height: 29px; background-color:white;" class="buttonlogin" onclick="NewWindow('ho_get_lov_kamar.php?returnform=form1','lov','800','600','yes','300','10');return false;">
                            <input type="hidden" name="fk_kamar" id="fk_kamar" value="<?$fk_kamar;?>">
                            <input type="hidden" name="harga">
                        </div>
                    </td>
                </tr>
            </table>
            <div class="tombol">
                <input type="submit" value="<?=$btn;?>">
                <input type="reset" value="Cancel">
                <a href="pemesanan-form.php"><input type="button" value="Refresh"></a>
                <input type="hidden" name="act" value="<?=$act;?>">
                <input type="hidden" name="id" value="<?=$id_pemesanan;?>">
            </div>
        </form>
    </fieldset>

    <?php 
        $sql = "SELECT tb_pemesanan.id_pemesanan, tb_pelanggan.id_pelanggan, tb_pelanggan.nama_pelanggan,
                tb_pemesanan.id_kamar, tb_kamar.tipe_kamar, tb_pemesanan.jumlah_kamar, tb_pemesanan.lama_menginap
                FROM tb_pemesanan
                INNER JOIN tb_pelanggan ON tb_pemesanan.id_pelanggan = tb_pelanggan.id_pelanggan
                INNER JOIN tb_kamar ON tb_pemesanan.id_kamar = tb_kamar.id_kamar
                WHERE tb_pemesanan.id_pemesanan LIKE '%$pencarian%' OR tb_pelanggan.id_pelanggan LIKE '%$pencarian%' OR tb_pemesanan.id_kamar LIKE '%$pencarian%' OR tb_pelanggan.nama_pelanggan LIKE '%$pencarian%' OR tb_kamar.tipe_kamar LIKE '%$pencarian%';";

        // $sql_cari = "SELECT * FROM tb_pemesanan WHERE id_pemesanan LIKE '%$pencarian%' OR id_pelanggan LIKE '%$pencarian%' OR id_kamar LIKE '%$pencarian%'";

        $result = $mysqli->query($sql);
    ?>

    <div class="next-page">
        <form method="post" class="search-form">
            <input type="text" name="pencarian" id="pencarian" autocomplete="off" placeholder="Cari Data Pemesanan">
        </form>

        <div class="links">
            <p><a href="pelanggan-form.php" class="pindahform">Form Pelanggan</a></p>
            <p><a href="pembayaran-form.php" class="pindahform">Form Pembayaran</a></p>
        </div>
    </div>

    <div id="container" class="table-wrapper">
        <table id="reservasi" align=center cellspacing=0>  
            <tr>
                <th align=left>Id Pemesanan</th>
                <th align=left>Id Pelanggan</th>
                <th align=left>Nama Pelanggan</th>
                <th align=left>Id Kamar</th>
                <th align=left>Tipe Kamar</th>
                <th align=left>Jumlah Kamar</th>
                <th align=left>Lama Menginap</th>
                <th>Action</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id_pemesanan"]."</td>";
                echo "<td>".$row["id_pelanggan"]."</td>";
                echo "<td>".$row["nama_pelanggan"]."</td>";
                echo "<td>".$row["id_kamar"]."</td>";
                echo "<td>".$row["tipe_kamar"]."</td>";
                echo "<td>".$row["jumlah_kamar"]." Kamar</td>";
                echo "<td>".$row["lama_menginap"]." Hari</td>";
                echo "<td align='center'>
                        <a href='pemesanan-form.php?act=edit&id_pemesanan=".$row['id_pemesanan']."'><img src='../../img/update.png' width='25px'></a>
                        <a href='pemesanan-form.php?act=delete&id_pemesanan=".$row['id_pemesanan']."'><img src='../../img/delete.png' width='25px''></a></td>";
                echo "</tr>";
            }

            $result->free_result();
            $mysqli->close();
            ?>
        </table>
    </div>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/pemesanan.js"></script>

</body>
</html>