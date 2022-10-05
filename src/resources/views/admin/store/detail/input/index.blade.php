<?php
$pageLevel = '../../../'; //ページの階層
$page = 'page_sales';
$pageUrl = str_replace('page_', '', $page);
?>


<!— ! ヘッダー —————————————————————————————— —>
<?php include($pageLevel.'element/header.php'); ?>
<!— ! レイアウト_ページ —————————————————————————————— —>
<section class="layout_page">
  <!— ! サイドバー —————————————————————————————— —>
  <?php include($pageLevel.'element/aside.php'); ?>
  <!— ! メイン —————————————————————————————— —>
  <main class="main">
    <!— ! ヘッド_メイン —————————————————————————————— —>
    <?php include($pageLevel.'element/head_main.php'); ?>
    <!— ! ボディ_メイン —————————————————————————————— —>
    <section class="body_main">
      <div class="container">
        <!— ! ページエリア —————————————————————————————— —>
        <div class="area_page page_800">
          <section class="area_back_page">
            <a class="btn_liner_navy" href="sales/detail"></a>
          </section>
          <div class="body_page">
            <section class="box">
              <div class="head_box">
                <div class="area_ttl center">
                  <p class="ttl h2">査定結果入力</p>
                  <p class="description">査定の金額を入力してください。</p>
                </div>
              </div>
              <div class="body_box">
                <!— ! 査定結果の入力 —————————————————————————————— —>
                <div class="area_assessment_input">
                  <ul class="list_product">
                    <?php for($i=0;$i<4;$i++) { ?>
                      <li>
                        <article class="layout">
                          <div class="img layout_head">
                            <div class="thumb" style="background: url(cmn/img/sample/img_product_01.jpg)"></div>
                          </div>
                          <div class="text layout_data">
                            <div class="layout head_right head_240">
                              <div class="layout_data">
                                <p class="h3">山崎　山崎12年/50ml</p>
                                <p>商品ID：Y-1234567</p>
                              </div>
                              <div class="layout_head">
                                <div class="wrap_input">
                                  <span class="unit_4">査定価格：</span>
                                  <div class="wrap_input right">
                                    <input type="text" value="20,000">
                                  </div>
                                  <span class="unit_1">円</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </article>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
                <div class="foot_box">
                  <div class="btnarea_center">
                    <a href="sales/detail" class="btn_line_navy">キャンセル</a>
                    <a href="sales/detail/input/confirm" class="btn_navy">確認画面へ</a>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </section>
      <!— ! フット_メイン —————————————————————————————— —>
      <section class="foot_main"></section>
    </main>
  </section>
  <!— ! マスタ編集スクリプト —————————————————————————————— —>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
  <script>
  var input = document.querySelector('input[name=masters]');
  new Tagify(input)
</script>
<?php include($pageLevel.'element/footer.php'); ?>
