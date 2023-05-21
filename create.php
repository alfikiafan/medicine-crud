<?php
include "functions.php";
$pdo = pdo_connect_mysql();
$msg = "";


if (!empty($_POST)) {
    $id = isset($_POST["id"]) && $_POST["id"] !== "auto" ? $_POST["id"] : null;
    $nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
    $merek = isset($_POST["merek"]) ? $_POST["merek"] : "";
    $jenis = isset($_POST["jenis"]) ? $_POST["jenis"] : "";
    $varian = isset($_POST["varian"]) ? $_POST["varian"] : "";
    $kedaluwarsa = isset($_POST["kedaluwarsa"])
        ? $_POST["kedaluwarsa"]
        : "0000-00-00 00:00:00";
    $stok = isset($_POST["stok"]) ? $_POST["stok"] : 0;
    $satuan = isset($_POST["satuan"]) ? $_POST["satuan"] : "";
    $harga = isset($_POST["harga"]) ? $_POST["harga"] : 0;

    $stmt = $pdo->prepare(
        "INSERT INTO obat (id, nama, merek, varian, kedaluwarsa, stok, satuan, harga) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $id,
        $nama,
        $merek,
        $varian,
        $kedaluwarsa,
        $stok,
        $satuan,
        $harga,
    ]);

    $msg = "Obat berhasil ditambahkan!";
}
?>

<?= template_header("Create") ?>

<div class="content update">
    <h2>Tambah Obat</h2>
    <form action="create.php" method="post">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        <label for="merek">Merek</label>
        <input type="text" name="merek" id="merek">
        <label for="varian">Varian</label>
        <input type="text" name="varian" id="varian">
        <label for="kedaluwarsa">Kedaluwarsa</label>
        <input type="date" name="kedaluwarsa" id="kedaluwarsa">
        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok">
        <label for="satuan">Satuan</label>
        <input type="text" name="satuan" id="satuan">
        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga">
        <input type="submit" value="Tambahkan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read.php";
        </script>
    <?php endif; ?>
</div>

<?= template_footer() ?>