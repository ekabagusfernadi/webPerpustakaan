// ambil elemen2 yang dibutuhkan

let keyword = document.getElementById("keyword");
let tombolCari = document.getElementById("tombolCari");
let containerTable = document.getElementById("containerTable");
let status = document.getElementById("status");
let bukuTerpopuler = document.getElementById("buku-terpopuler");
let anggotaTeraktif = document.getElementById("anggota-teraktif");

// tombolCari.addEventListener("click", function () {
//   alert("Berhasil");
// });

// tambahkan event ketika keyword ditulis
keyword.addEventListener("keyup", function () {
  //   console.log(keyword.value); // ambil apappun yang diketik oleh user

  // buat object ajax
  let xhr = new XMLHttpRequest(); // biasanya namanya xhr/ajax

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      //console.log(xhr.responseText);
      containerTable.innerHTML = xhr.responseText;
    }
  };

  // eksekusi ajax
  xhr.open("GET", "../ajax/dataPeminjamanAjax.php?keyword=" + keyword.value + "&status=" + status.value, true); // false = syncronus,true = asyncronus
  xhr.send();
});

status.addEventListener("change", function () {
  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      containerTable.innerHTML = xhr.responseText;
    }
  };

  xhr.open("GET", "../ajax/dataTerpopulerAjax.php?keyword=" + "&status=" + status.value, true); // false = syncronus,true = asyncronus
  xhr.send();
});

bukuTerpopuler.addEventListener("click", function () {
  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      containerTable.innerHTML = xhr.responseText;
    }
  };

  xhr.open("GET", "../ajax/detailPopulerAjax.php?key=bukuTerpopuler", true); // false = syncronus,true = asyncronus
  xhr.send();
});

anggotaTeraktif.addEventListener("click", function () {
  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      containerTable.innerHTML = xhr.responseText;
    }
  };

  xhr.open("GET", "../ajax/detailPopulerAjax.php?key=anggotaTeraktif", true); // false = syncronus,true = asyncronus
  xhr.send();
});

$(window).scroll(function () {
  var wScroll = $(this).scrollTop();
  // console.log(wScroll);
  $("#yato").css({
    transform: "translate(" + wScroll / -3 + "%, 0px)",
  });
});
