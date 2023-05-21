<?php
include "functions.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("SELECT * FROM obat WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $obat = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$obat) {
        exit('medicine doesn\'t exist with that ID!');
    }
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $stmt = $pdo->prepare("DELETE FROM obat WHERE id = ?");
            $stmt->execute([$_GET["id"]]);
            $msg = "Obat berhasil dihapus!";
        } else {
            header("Location: read.php");
            exit();
        }
    }
} else {
    exit("No ID specified!");
}
?>

<?= template_header("Delete") ?>

<div class="delete">
	<h2>Hapus Obat</h2>
    <?php if ($msg): ?>
    <p><?= $msg ?></p>
    <div class="btn-confirm">
        <a href="read.php?">Kembali</a>
    </div>
    <?php else: ?>
	<p>Apakah kamu yakin ingin menghapus obat <?= $obat["merek"] ?> - <?= $obat[
     "varian"
 ] ?>??</p>
    <div class="btn-confirm">
        <a href="delete.php?id=<?= $obat["id"] ?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?= $obat["id"] ?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?= template_footer() ?>