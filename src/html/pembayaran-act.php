<?php 

require_once("../config/koneksi.php");

$id_pembayaran = $_POST['id_pembayaran'];
$id_pemesanan = $_POST['id_pemesanan'];
$id_kamar = $_POST['id_kamar'];
$metode_pembayaran = $_POST['metode_bayar'];
$total_pembayaran = $_POST['total_pembayaran'];
$act = $_POST['act'];
$id = $_POST['id'];

// Query untuk mengambil data dari tb_kamar
$sql = "SELECT lama_menginap, jumlah_kamar FROM tb_pemesanan WHERE id_pemesanan = '$id_pemesanan';";
$result = $mysqli->query($sql);

if ($result) {
    // Jika query berhasil dieksekusi
    $row = $result->fetch_assoc();
    $lama_menginap = $row['lama_menginap'];
    $jumlah_kamar = $row['jumlah_kamar'];

    // Gunakan nilai $lama_menginap dan $jumlah_kamar sesuai kebutuhan Anda
} else {
    // Jika query gagal
    echo "Error: " . $mysqli->error;
}

if ($id_kamar === "K001") {
    $total_pembayaran = number_format(500000 * intval($lama_menginap) * intval($jumlah_kamar));
} else if ($id_kamar === "K002") {
    $total_pembayaran = number_format(1000000 * intval($lama_menginap) * intval($jumlah_kamar));
} else {
    $total_pembayaran = number_format(2000000 * intval($lama_menginap) * intval($jumlah_kamar));
}

if ($act == "edit") {
    $sql = "UPDATE tb_pembayaran SET id_pembayaran='$id_pembayaran', id_pemesanan='$id_pemesanan', id_kamar='$id_kamar', metode_pembayaran='$metode_pembayaran', total_pembayaran='$total_pembayaran' WHERE id_pembayaran='$id_pembayaran';";
} else if ($act == "delete") {
    $sql = "DELETE FROM tb_pembayaran WHERE id_pembayaran='$id_pembayaran'";
} else {
    $stmt = $mysqli->prepare("INSERT INTO tb_pembayaran VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $a, $b, $c, $d, $e);

    // set parameters and execute
    $a = $id_pembayaran;
    $b = $id_pemesanan;
    $c = $id_kamar;
    $d = $metode_pembayaran;
    $e = $total_pembayaran;
    
    if ($stmt->execute()) {
        echo "<script>alert('Sukses');window.open('pembayaran-form.php','_self');</script>";
    }
}

if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $mysqli->error;
}

echo "<script>alert('Sukses');window.open('pembayaran-form.php','_self');</script>";
$mysqli->close();
?>

?>