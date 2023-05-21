<?php
include "functions.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["id"])) {
    if (!empty($_POST)) {
        $nama = isset($_POST["nama"]) ? $_POST["nama"] : $medicine["nama"];
        $merek = isset($_POST["merek"]) ? $_POST["merek"] : $medicine["merek"];
        $varian = isset($_POST["varian"])
            ? $_POST["varian"]
            : $medicine["varian"];
        $kedaluwarsa = isset($_POST["kedaluwarsa"])
            ? $_POST["kedaluwarsa"]
            : $medicine["kedaluwarsa"];
        $stok = isset($_POST["stok"]) ? $_POST["stok"] : $medicine["stok"];
        $satuan = isset($_POST["satuan"])
            ? $_POST["satuan"]
            : $medicine["satuan"];
        $harga = isset($_POST["harga"]) ? $_POST["harga"] : $medicine["harga"];

        $stmt = $pdo->prepare(
            "UPDATE obat SET nama = ?, merek = ?, varian = ?, kedaluwarsa = ?, stok = ?, satuan = ?, harga = ? WHERE id = ?"
        );
        $stmt->execute([
            $nama,
            $merek,
            $varian,
            $kedaluwarsa,
            $stok,
            $satuan,
            $harga,
            $_GET["id"],
        ]);
        $msg = "Obat berhasil diedit!";
    }

    $stmt = $pdo->prepare("SELECT * FROM obat WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $medicine = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$medicine) {
        exit("Obat tidak ditemukan dengan ID tersebut!");
    }
} else {
    exit("ID tidak ditentukan!");
}
?>

<?= template_header("Update") ?>

<div class="content update">
    <h2>Edit Obat: <?= $medicine["merek"] ?> - <?= $medicine["varian"] ?></h2>
    <form action="update.php?id=<?= $medicine["id"] ?>" method="post">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= $medicine[
            "nama"
        ] ?>">
        <label for="merek">Merek</label>
        <input type="text" name="merek" id="merek" value="<?= $medicine[
            "merek"
        ] ?>">
        <label for="varian">Varian</label>
        <input type="text" name="varian" id="varian" value="<?= $medicine[
            "varian"
        ] ?>">
        <label for="kedaluwarsa">Kedaluwarsa</label>
        <input type="date" name="kedaluwarsa" id="kedaluwarsa" value="<?= $medicine[
            "kedaluwarsa"
        ] ?>">
        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok" value="<?= $medicine[
            "stok"
        ] ?>">
        <label for="satuan">Satuan</label>
        <input type="text" name="satuan" id="satuan" value="<?= $medicine[
            "satuan"
        ] ?>">
        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" value="<?= $medicine[
            "harga"
        ] ?>">
        <input type="submit" value="Simpan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read.php";
        </script>
    <?php endif; ?>
</div>

<?= template_footer() ?>
