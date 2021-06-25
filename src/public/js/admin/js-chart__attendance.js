// (function() {
//   // データ ---
//   const ctx = document.getElementById('js-chart__attendance').getContext('2d');
//   const myChart = new Chart(ctx, {
//     //チャートタイプ
//     type: 'line',
//     //表示データ
//     data: {
//       labels: ['1','2','3','4','5','6','7','8','9','10',
//       '11','12','13','14','15','16','17','18','19','20',
//       '21','22','23','24','25','26','27','28','29','30','31'],
//       datasets: [{
//         label: '総来店数',
//         data: ['',200, 400, 360, 542, 345, 595,200, 400, 360, 542, 345, 595],
//         /* ボーダー表示 */
//         borderColor: 'rgba(48,73,155,1)',
//         borderWidth: 2,
//         /* ドット表示 */
//         pointRadius: 3,
//         pointBackgroundColor: 'rgba(48, 73, 155, 1)',
//         pointBorderColor: 'rgba(48, 73, 155, 0)',
//         /* 折れ線グラフ表示 */
//         lineTension: 0,
//         /* 塗りつぶし */
//         fillColor: true,
//         backgroundColor: 'rgba(48,73,155,.05)',
//       }]
//     },
//     //オプション
//     options: {
//       /* 凡例 */
//       legend: {
//           position: 'bottom',
//           labels: {
//             fontFamily: 'Noto Sans JP',
//             fontSize: 12,
//             fontColor: '#5A647B',
//             usePointStyle: true,
//             boxWidth: 5,
//             /* 周りの余白 */
//             padding: 10,
//           }
//       },
//       scales: {
//         //横軸
//         xAxes: [
//           {
//             display: true,
//             ticks: {
//             },
//             scaleLabel: {
//               display: false, //表示するか否か
//               labelString: '---',
//               fontSize: 10,
//             },
//             gridLines: {
//               display: false, //表示するか否か
//             drawBorder: false
//             },
//           }
//         ],
//         //縦軸
//         yAxes: [
//           {
//             ticks: {
//               fontSize: 11,
//               fontFamily: 'Lato',
//               min: 0,
//               // max: 10000000,
//               stepSize: 100,
//               /* 金額をカンマ区切りで表示 */
//               callback: function(label, index, labels) {
//                 return label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '人';
//               }
//             },
//             gridLines: {
//               /* 線の色 */
//               color: '#F6F8FA',
//               /* 軸の線 */
//               drawBorder:false,
//             },
//           }
//         ],
//       },
//       tooltips: {
//         /* 金額をカンマ区切りで表示 */
//         callbacks: {
//           label: function(tooltipItem, data){
//             return '¥ ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
//           }
//         }
//       },
//       /* アスペクト比固定解除 */
//       maintainAspectRatio: false,
//     }
//   });

//         // 画面リサイズの対応
// /*
//         window.onresize = function(){
//           drawChart();
//         }
// */
// })();
