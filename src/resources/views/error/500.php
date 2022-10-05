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
          'ttl' => '500',
          'copy' => 'アクセスしようとしたページは表示できませんでした。',
          'description' => 'サーバーで問題が発生しているためページを表示できません。<br>対応完了までしばらくお待ちください。',
        ];
      ?>
      <?php include($pageLevel.'element/error.php'); ?>
    </main>
  </section>
<?php include($pageLevel.'element/footer.php'); ?>
