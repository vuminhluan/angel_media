
<option value="1">Đầu tiên</option>
<?php foreach ($menu_children as $chilren): ?>
  <option value="<?= $chilren['orders']+1 ?>">Sau <?= $chilren['name'] ?></option>
<?php endforeach; ?>
