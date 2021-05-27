//=============================================//
//    File export                              //
//=============================================//
var tabel = $("#tabel-laporan-gaji").DataTable({
  lengthChange: false,
  paging: false,
  searching: false,
  info: false,
  dom: "Bfrt",
  buttons: ["excel", "pdf", "print"],
});
$(".buttons-print, .buttons-pdf, .buttons-excel").addClass("btn btn-primary");
$(".dt-buttons").addClass("mb-2");
