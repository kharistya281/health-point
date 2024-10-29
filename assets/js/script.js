// jika postpaid di klik

function toogleOption() {
  const prepaid = document.getElementById('prepaid').checked;

  const provinsi = document.getElementById('provinsi');
  const kabkota = document.getElementById('kabkota');
  const ekspedisi = document.getElementById('ekspedisi');
  const layanan = document.getElementById('layanan');

  // jika prepaid dipilih, opsi pengiriman aktif
  if (prepaid) {
    provinsi.disabled = false;
    kabkota.disabled = false;
    ekspedisi.disabled = false;
    layanan.disabled = false;
  } else {
    provinsi.disabled = true;
    kabkota.disabled = true;
    ekspedisi.disabled = true;
    layanan.disabled = true;
  }

  const paymentSelect = document.getElementById('paymentSelect');
  const options = paymentSelect.options;

  // Menonaktifkan semua opsi
  for (let i = 0; i < options.length; i++) {
    options[i].style.display = 'none';
  }

  if (prepaid) {
    for (let i = 0; i < options.length; i++) {
      if (options[i].classList.contains('non-cod')) {
        options[i].style.display = 'block';
      }
    }
  } else {
    for (let i = 0; i < options.length; i++) {
      if (options[i].classList.contains('cod')) {
        options[i].style.display = 'block';
      }
    }
  }
}

// raja ongkir
$(document).ready(function () {
  $.ajax({
    url: 'dataProvinsi.php',
    type: 'post',
    success: function (dataProvinsi) {
      // console.log(dataProvinsi);
      $("select[name='provinsi']").html(dataProvinsi);
    },
  });

  $("select[name='provinsi']").on('change', function () {
    var id_provinsi = $('option:selected', this).attr('id_provinsi');
    $.ajax({
      url: 'dataKabkota.php',
      type: 'post',
      data: 'id_provinsi=' + id_provinsi,
      success: function (dataKabkota) {
        // console.log(dataKabkota);
        $("select[name='kabkota']").html(dataKabkota);
      },
    });
  });

  $.ajax({
    url: 'dataEkspedisi.php',
    type: 'post',
    success: function (dataEkspedisi) {
      $('select[name=ekspedisi]').html(dataEkspedisi);
    },
  });

  $('select[name=ekspedisi]').on('change', function () {
    var namaEkspedisi = $('select[name=ekspedisi]').val();
    var datakabkota = $('option:selected', 'select[name=kabkota]').attr('id_kabkota');
    var ttlBerat = $('input[name=berat]').val();
    // console.log(namaEkspedisi, ' ', datakabkota, ' ', ttlBerat);

    $.ajax({
      url: 'dataPaket.php',
      type: 'post',
      data: 'ekspedisi=' + namaEkspedisi + '&kabkota=' + datakabkota + '&berat=' + ttlBerat,
      // {
      //   ekspedisi : namaEkspedisi,
      //   kabkota : datakabkota,
      //   berat : ttlBerat
      // },
      success: function (dataPaket) {
        // console.log(dataPaket);
        $('select[name=paket]').html(dataPaket);
        $('input[name=nmekspedisi]').val(namaEkspedisi);
      },
    });
  });

  $('select[name=kabkota]').on('change', function () {
    var prov = $('option:selected', this).attr('nama_provinsi');
    var kabkt = $('option:selected', this).attr('nama_kabkota');
    var tipe = $('option:selected', this).attr('tipe_kabkota');
    var kode = $('option:selected', this).attr('kode_pos');
    // console.log(prov, kabkt, tipe, kode);
    $('input[name=nmprovinsi]').val(prov);
    $('input[name=nmkabkota]').val(kabkt);
    $('input[name=tpkabkota]').val(tipe);
    $('input[name=kodepos]').val(kode);
  });

  var originalTotal = parseInt($('#totalPembayaran').data('total')) || 0;

  $('input[name=paymentMethod]').on('change', function () {
    var paymentMethod = $('input[name=paymentMethod]:checked').val();
    var ongkir = parseInt($('input[name=ongkir]').val().replace(/,/g, '')) || 0;

    if (paymentMethod === 'postpaid') {
      $('#ongkirText').text('0');
      $('#ongkir').val(0);
      $('#totalPembayaran').text(new Intl.NumberFormat().format(originalTotal));
      $('#totalPembayaranInput').val(originalTotal);
    } else if (paymentMethod === 'prepaid') {
      parseInt($('#ongkirText').text(new Intl.NumberFormat().format(ongkir)));
      var totalPembayaran = originalTotal + ongkir;
      $("#totalPembayaran").text(new Intl.NumberFormat().format(totalPembayaran));
      $('#totalPembayaranInput').val(totalPembayaran);
    }
  });
  
  $('select[name=paket]').on('change', function () {
    var service = $('option:selected', this).attr('paket');
    var ongkir = parseInt($('option:selected', this).attr('ongkir'));
    var etd = $('option:selected', this).attr('etd');
    
    $('input[name=service]').val(service);
    $('input[name=ongkir]').val(ongkir);
    $('input[name=etd]').val(etd);
    
    var paymentMethod = $('input[name=paymentMethod]:checked').val();
    
    if (paymentMethod === 'prepaid') {
      $("#ongkirText").text(new Intl.NumberFormat().format(ongkir));
      var totalPembayaran = (originalTotal+ongkir);
      $("#totalPembayaran").text(new Intl.NumberFormat().format(totalPembayaran));
      $('#totalPembayaranInput').val(totalPembayaran);
    }
  });
});
