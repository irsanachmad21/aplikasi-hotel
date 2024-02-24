<?php 
require_once("../config/koneksi.php");

$pencarian = @$_POST['pencarian'];
$act = @$_GET['act'];
$id_pembayaran = @$_GET['id_pembayaran'];

if (empty($act)) {
  $id_pembayaran = "";
  $id_pemesanan = "";
  $id_kamar = "";
  $metode_pembayaran = "";
  $total_pembayaran = "";
  $btn = "Save";
} else {
  if ($act == "edit") {
    $sql = "SELECT * FROM tb_pembayaran where id_pembayaran='$id_pembayaran'";
    $btn = "Update";
  } else if ($act == "delete") {
    $sql = "SELECT * FROM tb_pembayaran where id_pembayaran='$id_pembayaran'";
    $btn = "Delete";
  } else {
    $sql = "SELECT * FROM tb_pembayaran";
    $btn = "Save";
  }
  $result = $mysqli->query($sql);

  while ($row = $result->fetch_assoc()) {
    $id_pembayaran = $row['id_pembayaran'];
    $id_pemesanan = $row['id_pemesanan'];
    $id_kamar = $row['id_kamar'];
    $metode_pembayaran = $row['metode_pembayaran'];
    $total_pembayaran = $row['total_pembayaran'];
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

    <?php
    $tipe_kamar = ["Standard"=> "Standard - Rp 500.000",
                    "Superior" => "Superior - Rp 1.000.000",
                    "Deluxe" => "Deluxe - Rp 2.000.000"];

    $metode_bayar = ["Tunai"=> "Tunai", "Kartu Kredit" => "Kartu Kredit"];
    ?>

    <fieldset>
        <form action="pembayaran-act.php" method="post" name="form1">
            <h2>Form Input Pembayaran</h2>
            <table align="center" cellpadding="15">
                <tr>
                    <td>Id Pembayaran</td>
                    <td>:</td>
                    <td><input type="text" name="id_pembayaran" value="<?=$id_pembayaran;?>" autocomplete="off" placeholder="Masukan Id Pembayaran"></td>

                    <td>&ensp;</td>

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
                </tr>
                    <td>Id Pemesanan</td>
                    <td>:</td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <input type="text" name="id_pemesanan" value="<?=$id_pemesanan;?>" autocomplete="off" placeholder="Masukan Id Pemesanan">
                            <input type="button" style="background:url('../../img/search.png'); background-repeat:no-repeat; background-size: cover; width: 29px; height: 29px; background-color:white;" class="buttonlogin" onclick="NewWindow('ho_get_lov_pemesanan.php?returnform=form1','lov','800','600','yes','300','10');return false;">
                            <input type="hidden" name="fk_pemesanan" id="fk_pemesanan" value="<?$fk_pemesanan;?>">
                        </div>
                    </td>

                    <td>&ensp;</td>

                    <td>Metode Pembayaran</td>
                    <td>:</td>
                    <td>
                        <select name="metode_bayar">
                            <?php 
                                foreach ($metode_bayar as $kode_bayar => $mb) {
                                    echo "<option value='$kode_bayar'>$mb</option>";
                                }
                            ?>
                        </select>
                        <input type="hidden" name="total_pembayaran" autocomplete=off>
                    </td>
                </tr>
            </table>

            <div class="tombol">
                <input type="submit" value="<?=$btn;?>">
                <input type="reset" value="Cancel">
                <a href="pembayaran-form.php"><input type="button" value="Refresh"></a>
                <input type="hidden" name="act" value="<?=$act;?>">
                <input type="hidden" name="id" value="<?=$id_pembayaran;?>">
            </div>

        </form>
    </fieldset>

    <?php 
        $sql = "SELECT tb_pembayaran.id_pembayaran, tb_pemesanan.id_pemesanan, tb_kamar.id_kamar,
        tb_pembayaran.metode_pembayaran, tb_pembayaran.total_pembayaran
        FROM tb_pembayaran
        INNER JOIN tb_pemesanan ON tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan
        INNER JOIN tb_kamar ON tb_pemesanan.id_kamar = tb_kamar.id_kamar
        WHERE tb_pembayaran.id_pembayaran LIKE '%$pencarian%' OR tb_pemesanan.id_pemesanan LIKE '%$pencarian%'
        OR tb_pemesanan.id_kamar LIKE '%$pencarian%';";

        $result = $mysqli->query($sql);
    ?>

    <div class="next-page">
        <form method="post" class="search-form">
            <input type="text" name="pencarian" id="pencarian" autocomplete="off" placeholder="Cari Data Pembayaran">
        </form>

        <div class="links">
            <p><a href="pelanggan-form.php" class="pindahform">Form Pelanggan</a></p>
            <p><a href="pemesanan-form.php" class="pindahform">Form Pemesanan</a></p>
        </div>
    </div>

    <div id="container" class="table-wrapper">
        <table id="reservasi" align=center cellspacing=0>  
            <tr>
                <th align=left>Id Pembayaran</th>
                <th align=left>Id Pemesanan</th>
                <th align=left>Id Kamar</th>
                <th align=left>Metode Pembayaran</th>
                <th align=left>Total Pembayaran</th>
                <th>Action</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id_pembayaran"]."</td>";
                echo "<td>".$row["id_pemesanan"]."</td>";
                echo "<td>".$row["id_kamar"]."</td>";
                echo "<td>".$row["metode_pembayaran"]."</td>";
                echo "<td> Rp ".$row["total_pembayaran"]."</td>";
                echo "<td align='center'>
                        <a href='pembayaran-form.php?act=edit&id_pembayaran=".$row['id_pembayaran']."'><img src='../../img/update.png' width='25px'></a>
                        <a href='pembayaran-form.php?act=delete&id_pembayaran=".$row['id_pembayaran']."'><img src='../../img/delete.png' width='25px''></a></td>";
                echo "</tr>";
            }

            $result->free_result();
            $mysqli->close();
            ?>
        </table>
    </div>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/pembayaran.js"></script>

</body>
</html>