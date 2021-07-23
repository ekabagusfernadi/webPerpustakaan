let idSelect2 = ["#noAnggotaPeminjam", "#kodeBukuDipinjam", "#noAnggotaPeminjam", "#kodeBukuDipinjam", "#idTransaksiPinjamBuku"];

for (let i = 0; i < idSelect2.length; i++) {
  $(document).ready(function () {
    $(idSelect2[i]).select2();
  });
}
