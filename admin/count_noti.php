<?php include_once 'database/connect.php'; ?>

<?php
$select = $pdo->prepare("SELECT id_tanggungan FROM tuntut_tanggungan ORDER BY tid_tanggung DESC");
$select->execute();
while ($row = $select->fetch(PDO::FETCH_OBJ)) {
?>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> <?php echo $row->id_tanggungan; ?>
        <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
    </a>
<?php
}
?>