<?php
	header('Access-Control-Allow-Origin: *');
	if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
	
	$koneksi = mysqli_connect("localhost","root","","dbjualan") or die("tidak bisa tersambung ke database");
	
	$postdata = file_get_contents("php://input");
	$dataObjek = json_decode($postdata);
	
	$nama = $dataObjek->data->nama;
	$alamat = $dataObjek->data->alamat;
	$telp = $dataObjek->data->telp;
	$email = $dataObjek->data->email;
	
	$perintah_sql = "insert into pelanggan (nama,alamat,telp,email) values ('{$nama}','{$alamat}','{$telp}','{$email}')";
	
	$result = mysqli_query($koneksi,$perintah_sql);
	
	$respon = "";
	if($result){
		$respon = "Berhasil menyimpan data";
	}else{
		$respon = "Gagal menyimpan data";
	}
	
	echo $respon;

?>