<?php
  $pageLevel = '../';
  $page = 'page_error';
 ?>
<!— ! ヘッダー —————————————————————————————— —>
<?php include($pageLevel.'element/header.php'); ?>
<!— ! レイアウト_ページ —————————————————————————————— —>
<section class="layout_page">
  <!— ! メイン —————————————————————————————— —>
  <main class="main">
    <section class="head_min">
      <a href="">
        <img src="cmn/img/logo/logo_min_white.svg">
      </a>
    </section>
    <?php
      $error = [
        'ttl' => '403',
        'copy' => 'アクセスしようとしたページは表示できませんでした。',
        'description' => '現在このページへのアクセスは禁止されています。<br>ご指定のURLに間違いがないか、再度ご確認ください。',
      ];
    ?>
    <?php include($pageLevel.'element/error.php'); ?>
  </main>
</section>
<?php include($_SERVER['DOCUMENT_ROOT']. '/cms_joylab/element/footer.php'); ?>
