$(document).ready(function () {
  datepickerLoad();
  paidVacationLoad();
  monthPicker();
});
function datepickerLoad(){
  const config =  {
    disableMobile: "true",
    locale: "ja",
  }
  flatpickr('.flatpickr', config);
}


function paidVacationLoad(){
  const config =  {
    disableMobile: "true",
    locale: "ja",
    minDate: new Date().fp_incr(30),//半年
    maxDate: new Date().fp_incr(180),//半年
  }
  flatpickr('.paidVacation', config);
}

function monthPicker(){
  config = {
    locale: "ja",
    disableMobile: "true",
    plugins: [
      new monthSelectPlugin({
        shorthand: true, // デフォルトはfalse
        dateFormat: "Y-m", // デフォルトは"F Y"
        altFormat: "Y-m", // デフォルトは"F Y"
        theme: "light" // デフォルトは"light"
      })
    ]
  };
  flatpickr('.month_picker', config);
}
