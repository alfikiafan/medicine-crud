<?php
include "functions.php";
$pdo = pdo_connect_mysql();
$page = isset($_GET["page"]) && is_numeric($_GET["page"]) ? (int) $_GET["page"] : 1;
$records_per_page = 5;

$stmt = $pdo->prepare(
    "SELECT *, ROW_NUMBER() OVER (ORDER BY id) AS row_num FROM obat LIMIT :current_page, :record_per_page"
);
$stmt->bindValue(
    ":current_page",
    ($page - 1) * $records_per_page,
    PDO::PARAM_INT
);
$stmt->bindValue(":record_per_page", $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$medicines = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_medicines = $pdo->query("SELECT COUNT(*) FROM obat")->fetchColumn();
?>

<?= template_header("Read") ?>

<div class="content read">
	<h2>Daftar Obat</h2>
	<a href="create.php" class="create-medicine">Tambah Obat</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nama</td>
                <td>Merek</td>
                <td>Varian</td>
                <td>Kedaluwarsa</td>
                <td>Stok</td>
                <td>Satuan</td>
                <td>Harga</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medicines as $medicine): ?>
            <tr>
                <td><?= $medicine["row_num"] ?></td>
                <td><?= $medicine["nama"] ?></td>
                <td><?= $medicine["merek"] ?></td>
                <td><?= $medicine["varian"] ?></td>
                <td><?= date(
                    "d-m-Y",
                    strtotime($medicine["kedaluwarsa"])
                ) ?></td>
                <td><?= $medicine["stok"] ?></td>
                <td><?= $medicine["satuan"] ?></td>
                <td><?= $medicine["harga"] ?></td>
                <td class="actions">
                    <a href="update.php?id=<?= $medicine[
                        "id"
                    ] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?= $medicine[
                        "id"
                    ] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?= $page -
      1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page * $records_per_page < $num_medicines): ?>
		<a href="read.php?page=<?= $page +
      1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?= template_footer() ?>
