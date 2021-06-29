<?php
  $attendanceTabList = [
    [
      'label'=>'基本情報',
      'path'=>'admin.customer.show',
    ],
    [
      'label'=>'利用履歴',
      'path'=>'admin.customer.history',
    ],
    [
      'label'=>'その他',
      'path'=>'admin.customer.other',
    ],
  ];
?>
<ul class="p-page__head__tab__list">
  <?php foreach($attendanceTabList as $key=>$val){ ?>
  <li>
    <a href="{{route($val['path'])}}" class="
      p-page__head__tab__list__label 
      {{in_array(Route::currentRouteName(), [$val['path']], TRUE) ? 'is-active' : '' }}
    "><?= $val['label']; ?></a>
  </li>
  <?php } ?>
</ul>