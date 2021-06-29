//select2
$(document).ready(function() {
  $('.js-target__select2').select2({
  });
});

//select2 制限あり
$(document).ready(function() {
  $('.js-target__select2-limit3').select2({
    multiple: "multiple",  // <select multiple> でも可
    maximumSelectionLength: 3,  // 最大2つまで選択可
  });
});
