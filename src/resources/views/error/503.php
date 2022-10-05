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
          'ttl' => '503',
          'copy' => 'ページを表示できませんでした。',
          'description' => '一時的なサーバー過負荷のため、現在ページを表示できません。<br>時間を置いて再接続してください。',
        ];
      ?>
      <?php include($pageLevel.'element/error.php'); ?>
    </main>
  </section>
<?php include($pageLevel.'element/footer.php'); ?>
