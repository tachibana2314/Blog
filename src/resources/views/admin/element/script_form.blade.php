<!-- <!— ! Jquery読み込み —————————————————————————————— —> -->
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/remodal.min.js') }}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!--  datepicker  -->
<script>
$(".datepicker").datepicker({
  dateFormat: "yy/mm/dd",
  closeText: "閉じる",
  prevText: "前",
  nextText: "次",
  currentText: "今日",
  monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
  monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
  dayNames: ["日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日"],
  dayNamesShort: ["日", "月", "火", "水", "木", "金", "土"],
  dayNamesMin: ["日", "月", "火", "水", "木", "金", "土"],
  weekHeader: "週",
  isRTL: false,
  showMonthAfterYear: true,
  yearSuffix: "年",
  firstDay: 1, // 週の初めは月曜
  showButtonPanel: true // "今日"ボタン, "閉じる"ボタンを表示する
});
</script>
<!-- デイトピッカー -->
<script type="text/javascript">
$(function() {
  var format = 'yy/mm/dd';
  $('input[type="datetime"].inputdate').datepicker({
    dateFormat: "yy/mm/dd",
    showButtonPanel: true,
    monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
    monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
    dayNames: ["日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日"],
    dayNamesShort: ["日", "月", "火", "水", "木", "金", "土"],
    dayNamesMin: ["日", "月", "火", "水", "木", "金", "土"],
    yearRange: "1950:2020",
    changeMonth: true, //月の選択ボックス
    changeYear: true, //年の選択ボックス
    beforeShow: function(input) {
      setTimeout(function() {
        var buttonPane = $(input).datepicker('widget').find('.ui-datepicker-buttonpane');
        $('<button>', {
          text: 'クリア',
          click: function() {
            $.datepicker._clearDate(input);
          }
        }).appendTo(buttonPane).addClass('ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all');
      }, 1);
    },
    onChangeMonthYear: function(year, month, instance) {
      setTimeout(function() {
        var buttonPane = $(instance).datepicker('widget').find('.ui-datepicker-buttonpane');
        $('<button>', {
          text: 'クリア',
          click: function() {
            $.datepicker._clearDate(instance.input);
          }
        }).appendTo(buttonPane).addClass('ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all');
      }, 1);
    }
  });
});
</script>
<script type="text/javascript">
function typeChange() {
  if (document.getElementById('type')) {
    val = document.getElementById('type').value;
    // console.log(val);
    if (val == 1) {
      document.getElementById('type_information').style.display = "";
      document.getElementById('type_product').style.display = "none";
      $('#type_url').find('select').val('');
      document.getElementById('type_product').style.display = "none";
      $('#type_product').find('select').val('');
      document.getElementById('type_coupon').style.display = "none";
      $('#type_coupon').find('select').val('');
      document.getElementById('type_store').style.display = "none";
      $('#type_store').find('select').val('');
      document.getElementById('type_url').style.display = "none";
      $('#type_url').find('input').val('');
      document.getElementById('type_stamp').style.display = "none";
      $('#type_stamp').find('select').val('');
    } else if (val == 2) {
      document.getElementById('type_information').style.display = "none";
      $('#type_information').find('select').val('');
      document.getElementById('type_product').style.display = "";
      document.getElementById('type_coupon').style.display = "none";
      $('#type_coupon').find('select').val('');
      document.getElementById('type_store').style.display = "none";
      $('#type_store').find('select').val('');
      document.getElementById('type_url').style.display = "none";
      $('#type_url').find('input').val('');
      document.getElementById('type_stamp').style.display = "none";
      $('#type_stamp').find('select').val('');
    } else if (val == 3) {
      document.getElementById('type_information').style.display = "none";
      $('#type_information').find('select').val('');
      document.getElementById('type_product').style.display = "none";
      $('#type_product').find('select').val('');
      document.getElementById('type_coupon').style.display = "";
      document.getElementById('type_store').style.display = "none";
      $('#type_store').find('select').val('');
      document.getElementById('type_url').style.display = "none";
      $('#type_url').find('input').val('');
      document.getElementById('type_stamp').style.display = "none";
      $('#type_stamp').find('select').val('');
    } else if (val == 4) {
      document.getElementById('type_information').style.display = "none";
      $('#type_information').find('select').val('');
      document.getElementById('type_product').style.display = "none";
      $('#type_product').find('select').val('');
      document.getElementById('type_coupon').style.display = "none";
      $('#type_coupon').find('select').val('');
      document.getElementById('type_store').style.display = "";
      document.getElementById('type_url').style.display = "none";
      $('#type_url').find('input').val('');
      document.getElementById('type_stamp').style.display = "none";
      $('#type_stamp').find('select').val('');
    } else if (val == 5) {
      document.getElementById('type_information').style.display = "none";
      $('#type_information').find('select').val('');
      document.getElementById('type_product').style.display = "none";
      $('#type_product').find('select').val('');
      document.getElementById('type_coupon').style.display = "none";
      $('#type_coupon').find('select').val('');
      document.getElementById('type_store').style.display = "none";
      $('#type_store').find('select').val('');
      document.getElementById('type_url').style.display = "";
      document.getElementById('type_stamp').style.display = "none";
      $('#type_stamp').find('select').val('');
    } else if (val == 6) {
      document.getElementById('type_information').style.display = "none";
      $('#type_information').find('select').val('');
      document.getElementById('type_product').style.display = "none";
      $('#type_product').find('select').val('');
      document.getElementById('type_coupon').style.display = "none";
      $('#type_coupon').find('select').val('');
      document.getElementById('type_store').style.display = "none";
      $('#type_store').find('select').val('');
      document.getElementById('type_url').style.display = "none";
      $('#type_url').find('input').val('');
      document.getElementById('type_stamp').style.display = "";
    } else if (val == 0) {
      document.getElementById('type_information').style.display = "none";
      $('#type_information').find('select').val('');
      document.getElementById('type_product').style.display = "none";
      $('#type_product').find('select').val('');
      document.getElementById('type_coupon').style.display = "none";
      $('#type_coupon').find('select').val('');
      document.getElementById('type_store').style.display = "none";
      $('#type_store').find('select').val('');
      document.getElementById('type_url').style.display = "none";
      $('#type_url').find('input').val('');
      document.getElementById('type_stamp').style.display = "none";
      $('#type_stamp').find('select').val('');
    }

  }
}
window.onload = typeChange;
</script>
