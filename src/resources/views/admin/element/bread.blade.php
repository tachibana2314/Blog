<?php
$bread = array(
  'ダッシュボード' => route('admin.home'),
  isset($title) && $title ? $title : '' => url()->full(),
);
$bread = array_filter($bread);
?>
<div class="area_bread">
  <ul class="list_bread">
    <?php
    foreach ($bread as $key => $val) {
      ?>
      <li>
        <a href="<?= $val ?>"><?= $key ?></a>
      </li>
      <?php } ?>
    </ul>
  </div>
