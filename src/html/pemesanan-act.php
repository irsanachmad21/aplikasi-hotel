<?php 

require_once("../config/koneksi.php");

$id_pemesanan = $_POST['id_pemesanan'];
$id_pelanggan = $_POST['id_pelanggan'];
$id_kamar = $_POST['id_kamar'];
$jumlah_kamar = $_POST['jumlah_kamar'];
$lama_menginap = $_POST['lama_menginap'];
$act = $_POST['act'];
$id = $_POST['id'];

if ($act == "edit") {
    $sql = "UPDATE tb_pemesanan SET id_pemesanan='$id_pemesanan', id_pelanggan='$id_pelanggan', id_kamar='$id_kamar', jumlah_kamar='$jumlah_kamar', lama_menginap='$lama_menginap' WHERE id_pemesanan='$id_pemesanan'";
} else if ($act == "delete") {
    $sql = "DELETE FROM tb_pemesanan WHERE id_pemesanan='$id_pemesanan'";
} else {
    $stmt = $mysqli->prepare("INSERT INTO tb_pemesanan VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $a, $b, $c, $d, $e);

    // set parameters and execute
    $a = $id_pemesanan;
    $b = $id_pelanggan;
    $c = $id_kamar;
    $d = $jumlah_kamar;
    $e = $lama_menginap;
    
    if ($stmt->execute()) {
        echo "<script>alert('Sukses');window.open('pemesanan-form.php','_self');</script>";
    }
}

if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $mysqli->error;
}

echo "<script>alert('Sukses');window.open('pemesanan-form.php','_self');</script>";
$mysqli->close();
?>

?>