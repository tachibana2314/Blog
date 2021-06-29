// document.addEventListener('DOMContentLoaded', function() {
//   var calendarEl = document.getElementById('calendar');
//   var calendar = new FullCalendar.Calendar(calendarEl, {
//     initialView: 'dayGridMonth',
//     // 日本語化
//     locale: 'ja',
//     contentHeight: 'auto',
//     dayCellContent: function (e) {
//       e.dayNumberText = e.dayNumberText.replace('日', '');
//     },

//     events: "/setEvents",
//     // events: [
//     //   //ステータスの種類→[arrive（出勤）,absence（欠勤）,publidHoliday（公休）,specialHoliday（特休）]
//     //   {
//     //     start: '2021-05-01T13:00:00',
//     //     className: 'arrive',
//     //   },
//     //   {
//     //     start: '2021-05-02T13:00:00',
//     //     className: 'arrive',
//     //   },
//     //   {
//     //     start: '2021-05-03T13:00:00',
//     //     className: 'specialHoliday',
//     //   },
//     //   {
//     //     start: '2021-05-04T13:00:00',
//     //     className: 'arrive',
//     //   },
//     //   {
//     //     start: '2021-05-05T13:00:00',
//     //     className: 'arrive',
//     //   },
//     //   {
//     //     start: '2021-05-06T13:00:00',
//     //     className: 'publicHoliday',
//     //   },
//     //   {
//     //     start: '2021-05-07T13:00:00',
//     //     className: 'publicHoliday',
//     //   },
//     //   {
//     //     start: '2021-05-08T13:00:00',
//     //     className: 'publicHoliday',
//     //   },
//     //   {
//     //     start: '2021-05-09T13:00:00',
//     //     className: 'arrive',
//     //   },
//     //   {
//     //     start: '2021-05-10T13:00:00',
//     //     className: 'absence',
//     //   },
//     //   {
//     //     start: '2021-05-11T13:00:00',
//     //     className: 'arrive',
//     //   },
//     //   {
//     //     start: '2021-05-12T13:00:00',
//     //     className: 'publicHoliday',
//     //   },
//     //   {
//     //     start: '2021-05-13T13:00:00',
//     //     className: 'publicHoliday',
//     //   },
//     //   {
//     //     start: '2021-05-14T13:00:00',
//     //     className: 'arrive',
//     //   },
//     // ]
//     eventClick: function(info) {
//       $('.js-target__calendar').addClass('is-active__calendar--show');
//     }
//   });
//   calendar.render();
// });
// $(document).on('click', '.js-trigger__calendar--close', function() {
//     $(this).parents('.js-target__calendar').removeClass('is-active__calendar--show');
//   }
// );
