<?php 

require_once("../config/koneksi.php");

$pencarian = @$_POST['pencarian'];

// $pencarian = @$_POST['pencarian'];

// $query = "SELECT * FROM tb_pemesanan WHERE id_pemesanan LIKE '%$pencarian%' OR id_pelanggan LIKE '%$pencarian%'
//             OR id_kamar LIKE '%$pencarian%'";
// $reservasi = query($query);
// $result = $mysqli->query($query);

$query = "SELECT tb_pemesanan.id_pemesanan, tb_pelanggan.id_pelanggan, tb_pelanggan.nama_pelanggan,
        tb_pemesanan.id_kamar, tb_kamar.tipe_kamar, tb_pemesanan.jumlah_kamar, tb_pemesanan.lama_menginap
        FROM tb_pemesanan
        INNER JOIN tb_pelanggan ON tb_pemesanan.id_pelanggan = tb_pelanggan.id_pelanggan
        INNER JOIN tb_kamar ON tb_pemesanan.id_kamar = tb_kamar.id_kamar
        WHERE tb_pemesanan.id_pemesanan LIKE '%$pencarian%' OR tb_pelanggan.id_pelanggan LIKE '%$pencarian%' OR tb_pemesanan.id_kamar LIKE '%$pencarian%' OR tb_pelanggan.nama_pelanggan LIKE '%$pencarian%';";

$reservasi = query($query);
$result = $mysqli->query($query);

?>

<table id="reservasi" align=center>  
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