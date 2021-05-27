function dk(key) {
  //Warning Message
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
        url: "/hapus_karyawan",
        type: "POST",
        data: {
          key: key,
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
              window.location = "/karyawan";
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Gagal!",
              text: res.message,
              showCancelButton: false,
              confirmButtonColor: "#8898aa",
              confirmButtonText: "Ok",
            });
          }
        },
      });
    }
  });
}
