<?php

$id_provinsi = $_POST['id_provinsi'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: c7224011cb66cf659f781416366e6678"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
    $array_response = json_decode($response, true);
    $dataKabkota = $array_response['rajaongkir']['results'];

    echo "<option selected>Pilih Kab / Kota</option>";
    foreach($dataKabkota as $key => $value){
        echo "<option 
        id_kabkota = '".$value['city_id']."' 
        nama_provinsi = '".$value['province']."' 
        nama_kabkota = '".$value['city_name']."'
        kode_pos = '".$value['postal_code']."'
        tipe_kabkota ='".$value['type']."'
        >";
        echo $value['type'].' ';
        echo $value['city_name'];
        echo "</option>";
    }
}
?>