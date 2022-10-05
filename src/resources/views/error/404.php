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
          'ttl' => '404',
          'copy' => 'お探しのページは見つかりませんでした。',
          'description' => '申し訳ございません。お探しのページは見つかりませんでした。<br>  ご指定のURLが間違っているか、ページの移動、または削除された可能性がございます。<br>  ご覧になりたいページをお探しください。',
        ];
      ?>
      <?php include($pageLevel.'element/error.php'); ?>
    </main>
  </section>
<?php include($pageLevel.'element/footer.php'); ?>
