$(document).ready(function(){
  $('#dataTable').DataTable({
    pageLength: 10,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    responsive: true,
    dom: 'l<"length-menu">Bfgitp',
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    },
    buttons: [
      {
        extend: 'excel',
        title: $('h3.text-primary').text(),
        customize: function(xlsx) {
          var sheet = xlsx.xl.worksheets['sheet1.xml'];
          
          // Check if each total value exists and add corresponding row
          var totalValues = ['total2', 'total3', 'total4', 'total5'];
          for (var i = 0; i < totalValues.length; i++) {
            var totalValue = $('#' + totalValues[i]).text();
            if (totalValue) {
              var totalRow = '<row>';
              for (var j = 0; j < i; j++) {
                totalRow += '<c t="inlineStr" s="0"></c>';
              }
              totalRow += '<c t="inlineStr" s="0"><is><t>Total</t></is></c>';
              totalRow += '<c t="n" s="0"></c>';
              totalRow += '<c t="n" s="0"><v>' + totalValue + '</v></c>';
              totalRow += '</row>';
              $(sheet).find('sheetData').append(totalRow);
            }
          }
        }
      },
    ],
  });
});
