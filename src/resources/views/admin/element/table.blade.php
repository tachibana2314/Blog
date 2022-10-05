<table class="table link">
  <thead>
    <tr>
      <?php foreach ($thead as $key) { ?>
        <th>
          <p><?= $key; ?></p>
        </th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tbody as $tr) : ?>
        <tr data-href="">
          <?php foreach ($tr as $td) : ?>
            <td>
              <p class="<?php if ($td === 'img') {
                echo 'img';
              };
              if (strpos($td, 'status_') !== false) {
                echo $td;
              } ?>" style="<?php if ($td === 'img') {
                echo 'background: url(' . (HOMEURL) . 'cmn/img/sample/img_product_01.png)';
              } ?>">
              <?php
              if (strpos($td, 'status_') !== false) {
                echo '';
              } else {
                echo $td;
              }
              ?>
            </p>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
