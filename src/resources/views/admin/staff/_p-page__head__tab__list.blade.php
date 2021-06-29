<?php
  $attendanceTabList = [
    [
      'label'=>'基本情報',
      'path'=> route('admin.staff.show', $staff),
    ],
    [
      'label'=>'メモ',
      'path'=> route('admin.staff.other', $staff),
    ],
  ];
?>
<ul class="p-page__head__tab__list">
  <?php foreach($attendanceTabList as $key=>$val){ ?>
  <li>
    <a href="<?= $val['path'] ?>" class="
      p-page__head__tab__list__label 
      {{in_array(url()->current(), [$val['path']], TRUE) ? 'is-active' : '' }}
    ">
    <?= $val['label']; ?>
    </a>
  </li>
  <?php } ?>
</ul>