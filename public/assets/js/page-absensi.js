$("#checkedAll").on("click", function () {
  if (this.checked) {
    $("input:checkbox[name='key[]']").prop("checked", true);
  } else {
    $("input:checkbox[name='key[]']").prop("checked", false);
  }
});

$("input:checkbox[name='key[]']").on("click", function () {
  if (!this.checked) {
    $("#checkedAll").prop("checked", false);
  }
});

$(".btn-sv-abs").on("click", function () {
  $.fn.rowCount = function () {
    return $("tr", $(this).find("tbody")).length;
  };
  cntDt = $("#tabelTambahPresensi").rowCount();

  tg = document.getElementById("ipt").value;
  var pfxRId = "rowCheck_";
  var pfxJm = "jamMasuk_";
  var pfxIdst = "idStatus_";
  var pfxKt = "keterangan_";

  var arrId = new Array();
  var arrTgl = new Array();
  var arrJm = new Array();
  var arrIdst = new Array();
  var arrKt = new Array();

  for (i = 1; i <= cntDt; i++) {
    var rId = pfxRId + i.toString();
    var cR = document.getElementById(rId);

    var idJm = pfxJm + i.toString();
    var idIdst = pfxIdst + i.toString();
    var idKt = pfxKt + i.toString();

    // Jika checkbox di centang -> ambil data
    if (cR.checked == true) {
      var Jm = document.getElementById(idJm).value;
      var idst = document.getElementById(idIdst).value;
      var kt = document.getElementById(idKt).value;

      if (kt === "") kt = "-";

      arrId.push(cR.value);
      arrTgl.push(tg);
      arrJm.push(Jm);
      arrIdst.push(idst);
      arrKt.push(kt);
    }
  }

  if (arrId.length < 1) {
    alert("Tidak ada data yang ditambahkan");
  } else {
    $.ajax({
      url: "/tambah_absensi",
      type: "POST",
      data: {
        tanggal: arrTgl,
        id_karyawan: arrId,
        jam_masuk: arrJm,
        id_status: arrIdst,
        keterangan: arrKt,
      },
      cache: false,
      success: function (result) {
        location.reload();
      },
    });
  }
});

function da(key, tgl) {
  Swal.fire({
    title: "Anda yakin?",
    text: "Data tidak dapat dipulihkan!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#ff5050",
    cancelButtonColor: "#8898aa",
    confirmButtonText: "Ya, Hapus",
    cancelButtonText: "Tutup",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "/hapus_absensi",
        type: "POST",
        data: {
          key: key,
          tanggal: tgl,
        },
        cache: false,
        success: function (result) {
          var res = JSON.parse(result);

          if (res.statusCode == 200) {
            Swal.fire({
              title: "Berhasil",
              text: res.message,
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#2cd07e",
              confirmButtonText: "Ok",
            }).then(() => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Gagal!",
              text: res.message,
              showCancelButton: false,
              confirmButtonColor: "#8898aa",
              confirmButtonText: "Tutup",
            });
          }
        },
      });
    }
  });
}

function frmedt(id, key, tanggal, jam_masuk, status, keterangan) {
  $("#edtId").val(id);
  $("#edtKey").val(key);
  $("#edtTanggal").val(tanggal);
  $("#edtJamMasuk").val(jam_masuk);
  $("#edtStatus").val(status);
  $("#edtKeterangan").val(keterangan);
}
