<?php
/*
syntax:
new mysqli(url, user, pass, db);
args:
@url -> String, alamat url
@user -> String, username database yang dituju (default username database di XAMPP adalah "root") 
@pass -> String, password database yang dituju (default password database di XAMPP adalah kosong)
@db -> String, nama database yang dituju
*/
$mysqli = new mysqli("localhost", "root", "", "toko-berada");

/*
syntax:
$_POST[name_attribute]
args:
$_POST -> kita akan menggunakan method request POST
@name_attribute -> String, dalam hal ini kita sepakati dulu yaitu "code"
*/
switch ($_POST["code"]) {
    // value dari $_POST["code"] yaitu "login"
    case "login":
        /*
        pengambilan data sekaligus pengecekan variabel $row itu tidak kosong
        dan berlakukan variabel array $response dengan nama atribut "success" benilai 1
        ($response['success'] = 1) dan 0 untuk data kosong (tidak ada).
        */
        if (!empty($row = $mysqli->query("SELECT * FROM login WHERE username ='" . $_POST["username"] . "' AND password='" . $_POST["password"] . "'")->fetch_array(MYSQLI_ASSOC))) {
            $response['success'] = 1;
            // $response['id'] = $row['id'];
            // $response['level'] = $row['level'];
            // kirim response berisi variabel $response yang ditransformasi jadi notasi bentuk json
            die(json_encode($response));
        } else {
            $response['success'] = 0;
            // kirim response berisi variabel $response yang ditransformasi jadi notasi bentuk json
            die(json_encode($response));
        }
        break;
     default:
        break;
}
/*
menutup koneksi ke server MySQL
*/
$mysqli->close();


// cheat code jika butuh algoritma lain (misal CRUD)
// <?php

// $mysqli = new mysqli("localhost", "root", "", "pasrent_car");

// switch ($_POST["code"]) {
// //sesi login
//     case "login":
//         if (!empty($row = $mysqli->query("SELECT id,level FROM dt_pengguna WHERE username ='" . $_POST["username"] . "' AND password='" . $_POST["password"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             $response['id'] = $row['id'];
//             $response['level'] = $row['level'];
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
// //sesi ambil nama untuk menu utama
//     case "main":
//         if (!empty($row = $mysqli->query("SELECT nama FROM dt_pelanggan WHERE nik = '" . $_POST["nik"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             $response['nama'] = $row['nama'];
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
// //CRUD pelanggan
//     case "cek nik":
//         if (!empty($row = $mysqli->query("SELECT nik FROM dt_pelanggan WHERE nik = '" . $_POST["nik"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "tambah pelanggan":
//         if ($mysqli->query("INSERT INTO dt_pelanggan (nik, nama, tempat, tanggal, alamat, jk, agama, telp) VALUES ('" . $_POST["nik"] . "', '" . $_POST["nama"] . "', '" . $_POST["tempat"] . "', '" . $_POST["tanggal"] . "', '" . $_POST["alamat"] . "', '" . $_POST["jk"] . "', '" . $_POST["agama"] . "', '" . $_POST["telp"] . "')")) {
//             if ($mysqli->query("INSERT INTO dt_pengguna (id, username, password, level) VALUES ('" . $_POST["nik"] . "', '" . $_POST["username"] . "', '" . $_POST["password"] . "', 'Pelanggan')")) {
//                 $response['success'] = 1;
//                 die(json_encode($response));
//             } else {
//                 $response['success'] = 0;
//                 die(json_encode($response));
//             }
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "get detail data customer":
//         if (!empty($row = $mysqli->query("SELECT * FROM dt_pelanggan WHERE nik='" . $_POST["nik"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             $response['nik'] = $row['nik'];
//             $response['nama'] = $row['nama'];
//             $response['tempat'] = $row['tempat'];
//             $response['tanggal'] = $row['tanggal'];
//             $response['alamat'] = $row['alamat'];
//             $response['jk'] = $row['jk'];
//             $response['agama'] = $row['agama'];
//             $response['telp'] = $row['telp'];
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "ubah pelanggan":
//         if ($mysqli->query("UPDATE dt_pelanggan SET nama = '" . $_POST["nama"] . "', tempat = '" . $_POST["tempat"] . "', tanggal = '" . $_POST["tanggal"] . "', alamat = '" . $_POST["alamat"] . "', jk = '" . $_POST["jk"] . "', agama = '" . $_POST["agama"] . "', telp = '" . $_POST["telp"] . "' WHERE nik = '" . $_POST["nik"] . "'")) {
//             $response['success'] = 1;
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
// //CRUD akun
//     case "cek akun":
//         if (!empty($row = $mysqli->query("SELECT id,username FROM dt_pengguna WHERE id = '" . $_POST["id"] . "' OR username = '" . $_POST["username"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             $response['id'] = $row['id'];
//             $response['username'] = $row['username'];
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "cek username":
//         if (!empty($row = $mysqli->query("SELECT username FROM dt_pengguna WHERE username = '" . $_POST["username"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             $response['username'] = $row['username'];
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "ambil akun":
//         if (!empty($row = $mysqli->query("SELECT username, password FROM dt_pengguna WHERE id = '" . $_POST["id"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             $response['username'] = $row['username'];
//             $response['password'] = $row['password'];
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "ubah akun":
//         if ($mysqli->query("UPDATE dt_pengguna SET username = '" . $_POST["username"] . "', password = '" . $_POST["password"] . "' WHERE id = '" . $_POST["id"] . "'")) {
//             $response['success'] = 1;
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
// //CRUD mobil
//     case "tambah mobil":
//         if ($mysqli->query("INSERT INTO dt_mobil (merek, model, plat, kapasitas, tahun, keterangan, tarif, gambar,transmisi,tersedia) VALUES ('" . $_POST["merek"] . "', '" . $_POST["model"] . "', '" . $_POST["plat"] . "', '" . $_POST["kapasitas"] . "', '" . $_POST["tahun"] . "', '" . $_POST["keterangan"] . "', '" . $_POST["tarif"] . "', '" . preg_replace('/\s+/', '_', $_POST["plat"]) . ".jpeg', '" . $_POST["transmisi"] . "', '" . $_POST["tersedia"] . "')")) {
//             if (file_put_contents(preg_replace('/\s+/', '_', $_POST["plat"]) . ".jpeg", base64_decode($_POST['gambar']))) {
//                 $response['success'] = 1;
//                 die(json_encode($response));
//             } else {
//                 $response['success'] = 0;
//                 die(json_encode($response));
//             }
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         mysql_close();
//         break;
//     case "get data car":
//         $response = array();
//         $ex = $mysqli->query("SELECT * FROM dt_mobil WHERE merek LIKE '" . $_POST["key"] . "%' OR model LIKE '" . $_POST["key"] . "%' OR tersedia LIKE '" . $_POST["key"] . "%' ORDER BY FIELD (tersedia,'Tidak','Ya'), merek ASC, model ASC");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['merek'] = $row['merek'];
//             $temp['model'] = $row['model'];
//             $temp['gambar'] = $row['gambar'];
//             $temp['transmisi'] = $row['transmisi'];
//             $temp['kapasitas'] = $row['kapasitas'];
//             $temp['tahun'] = $row['tahun'];
//             $temp['keterangan'] = $row['keterangan'];
//             $temp['tarif'] = $row['tarif'];
//             $temp['plat'] = $row['plat'];
//             $temp['tersedia'] = $row['tersedia'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "get data car customer":
//         $response = array();
//         $ex = $mysqli->query("SELECT * FROM dt_mobil WHERE (merek LIKE '" . $_POST["key"] . "%' OR model LIKE '" . $_POST["key"] . "%') AND tersedia = 'Ya' ORDER BY FIELD (tersedia,'Tidak','Ya'), merek ASC, model ASC");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['merek'] = $row['merek'];
//             $temp['model'] = $row['model'];
//             $temp['gambar'] = $row['gambar'];
//             $temp['transmisi'] = $row['transmisi'];
//             $temp['kapasitas'] = $row['kapasitas'];
//             $temp['tahun'] = $row['tahun'];
//             $temp['keterangan'] = $row['keterangan'];
//             $temp['tarif'] = $row['tarif'];
//             $temp['plat'] = $row['plat'];
//             $temp['tersedia'] = $row['tersedia'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "get detail data car":
//         if (!empty($row = $mysqli->query("SELECT * FROM dt_mobil WHERE plat = '" . $_POST["plat"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             $response['plat'] = $row['plat'];
//             $response['merek'] = $row['merek'];
//             $response['model'] = $row['model'];
//             $response['transmisi'] = $row['transmisi'];
//             $response['kapasitas'] = $row['kapasitas'];
//             $response['tahun'] = $row['tahun'];
//             $response['tarif'] = $row['tarif'];
//             $response['keterangan'] = $row['keterangan'];
//             $response['gambar'] = $row['gambar'];
//             $response['tersedia'] = $row['tersedia'];
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "update car":
//         if ($mysqli->query("UPDATE dt_mobil SET merek = '" . $_POST["merek"] . "', model = '" . $_POST["model"] . "', transmisi = '" . $_POST["transmisi"] . "', kapasitas = '" . $_POST["kapasitas"] . "', tahun = '" . $_POST["tahun"] . "', keterangan = '" . $_POST["keterangan"] . "', tarif = '" . $_POST["tarif"] . "', tersedia = '" . $_POST["tersedia"] . "' WHERE plat = '" . $_POST["plat"] . "'")) {
//             if (file_put_contents(preg_replace('/\s+/', '_', $_POST["plat"]) . ".jpeg", base64_decode($_POST['gambar']))) {
//                 $response['success'] = 1;
//                 die(json_encode($response));
//             } else {
//                 $response['success'] = 0;
//                 die(json_encode($response));
//             }
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
// //CRUD pemesanan
//     case "cek jadwal":
//         $status = 0;
//         $ex = $mysqli->query("SELECT tgl_ambil,tgl_kembali FROM dt_penyewaan WHERE plat = '" . $_POST["plat"] . "' AND YEAR(tgl_ambil) = YEAR('" . $_POST["tgl_ambil"] . "') AND MONTH(tgl_ambil) = MONTH('" . $_POST["tgl_ambil"] . "') AND status != 'Batal'");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $currentDate = date('Y-m-d', strtotime($_POST["tgl_ambil"]));
//             $startDate = date('Y-m-d', strtotime($row['tgl_ambil']));
//             $endDate = date('Y-m-d', strtotime($row['tgl_kembali']));

//             if (($currentDate >= $startDate) && ($currentDate <= $endDate)) {
//                 $status = 1;
//             }
//         }
//         $ex = $mysqli->query("SELECT tgl_ambil,tgl_kembali FROM dt_penyewaan WHERE plat = '" . $_POST["plat"] . "' AND YEAR(tgl_ambil) = YEAR('" . $_POST["tgl_kembali"] . "') AND MONTH(tgl_ambil) = MONTH('" . $_POST["tgl_kembali"] . "')");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $currentDate = date('Y-m-d', strtotime($_POST["tgl_kembali"]));
//             $startDate = date('Y-m-d', strtotime($row['tgl_ambil']));
//             $endDate = date('Y-m-d', strtotime($row['tgl_kembali']));

//             if (($currentDate >= $startDate) && ($currentDate <= $endDate)) {
//                 $status = 1;
//             }
//         }
//         if ($status == 1) {
//             $response['success'] = 1;
//         } else {
//             $response['success'] = 0;
//         }
//         die(json_encode($response));
//         break;
//     case "insert rent":
//         if ($mysqli->query("INSERT INTO dt_penyewaan (nik, plat, tgl_pesan, tgl_ambil, tgl_kembali, total, bayar, status,keterangan) VALUES('" . $_POST["nik"] . "', '" . $_POST["plat"] . "', '" . $_POST["tgl_pesan"] . "', '" . $_POST["tgl_ambil"] . "', '" . $_POST["tgl_kembali"] . "', '" . $_POST["total"] . "', '" . $_POST["bayar"] . "', '" . $_POST["status"] . "', '" . $_POST["keterangan"] . "')")) {
//             $response['success'] = 1;
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "kirim pesan":
//         if (!empty($rows = $mysqli->query("SELECT id_sewa,nik FROM dt_penyewaan WHERE plat = '" . $_POST["plat"] . "' AND tgl_ambil = '" . $_POST["tgl_ambil"] . "' AND tgl_kembali = '" . $_POST["tgl_kembali"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             if (!empty($row = $mysqli->query("SELECT nama FROM dt_pelanggan WHERE nik = '" . $rows['nik'] . "'")->fetch_array(MYSQLI_ASSOC))) {
//                 $response['success'] = 1;
//                 $response['nama'] = $row['nama'];
//                 $response['id_sewa'] = $rows['id_sewa'];
//                 die(json_encode($response));
//             } else {
//                 $response['success'] = 0;
//                 die(json_encode($response));
//             }
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "get data order":
//         $response = array();
//         $ex = $mysqli->query("SELECT * FROM dt_penyewaan WHERE id_sewa LIKE '" . $_POST["key"] . "%' AND status != 'Selesai' AND status != 'Batal' ORDER BY FIELD (status,'Booking','Sewa','Selesai','Batal') ");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['id_sewa'] = $row['id_sewa'];
//             $temp['nik'] = $row['nik'];
//             $temp['plat'] = $row['plat'];
//             $temp['tgl_pesan'] = $row['tgl_pesan'];
//             $temp['tgl_ambil'] = $row['tgl_ambil'];
//             $temp['tgl_kembali'] = $row['tgl_kembali'];
//             $temp['total'] = $row['total'];
//             $temp['bayar'] = $row['bayar'];
//             $temp['status'] = $row['status'];
//             $temp['keterangan'] = $row['keterangan'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "get data order customer":
//         $response = array();
//         $ex = $mysqli->query("SELECT * FROM dt_penyewaan WHERE nik = '" . $_POST["nik"] . "' ORDER BY FIELD (status,'Booking','Sewa','Selesai','Batal') ");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['id_sewa'] = $row['id_sewa'];
//             $temp['nik'] = $row['nik'];
//             $temp['plat'] = $row['plat'];
//             $temp['tgl_pesan'] = $row['tgl_pesan'];
//             $temp['tgl_ambil'] = $row['tgl_ambil'];
//             $temp['tgl_kembali'] = $row['tgl_kembali'];
//             $temp['total'] = $row['total'];
//             $temp['bayar'] = $row['bayar'];
//             $temp['status'] = $row['status'];
//             $temp['keterangan'] = $row['keterangan'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "update rent":
//         if ($mysqli->query("UPDATE dt_penyewaan SET bayar = '" . $_POST["bayar"] . "', status = '" . $_POST["status"] . "', keterangan = '" . $_POST["keterangan"] . "' WHERE id_sewa = '" . $_POST["id"] . "'")) {
//             $response['success'] = 1;
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
//     case "get name car":
//         if (!empty($row = $mysqli->query("SELECT CONCAT(merek,' ',model) AS nama FROM dt_mobil WHERE plat = '" . $_POST["plat"] . "'")->fetch_array(MYSQLI_ASSOC))) {
//             $response['success'] = 1;
//             $response['nama'] = $row['nama'];
//             die(json_encode($response));
//         } else {
//             $response['success'] = 0;
//             die(json_encode($response));
//         }
//         break;
// //laporan
//     case "print data car":
//         $response = array();
//         $ex = $mysqli->query("SELECT * FROM dt_mobil ORDER BY merek ASC, model ASC");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['plat'] = $row['plat'];
//             $temp['merek'] = $row['merek'];
//             $temp['model'] = $row['model'];
//             $temp['transmisi'] = $row['transmisi'];
//             $temp['kapasitas'] = $row['kapasitas'];
//             $temp['tahun'] = $row['tahun'];
//             $temp['tarif'] = $row['tarif'];
//             $temp['keterangan'] = $row['keterangan'];
//             $temp['tersedia'] = $row['tersedia'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "print income car month":
//         $response = array();
//         $ex = $mysqli->query("SELECT dt_penyewaan.plat, SUM(dt_penyewaan.bayar) AS jml, CONCAT(dt_mobil.merek,' ',dt_mobil.model) AS nama FROM dt_penyewaan LEFT JOIN dt_mobil ON dt_penyewaan.plat = dt_mobil.plat WHERE month(dt_penyewaan.tgl_kembali) = month('2020-" . $_POST["month"] . "-12 00:00:00') AND year(dt_penyewaan.tgl_kembali) = year('" . $_POST["year"] . "-12-12 00:00:00') AND (dt_penyewaan.status = 'Selesai' OR dt_penyewaan.status = 'Batal') GROUP BY dt_penyewaan.plat");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['plat'] = $row['plat'];
//             $temp['jml'] = $row['jml'];
//             $temp['nama'] = $row['nama'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "ambil pelanggan":
//         $response = array();
//         $ex = $mysqli->query("SELECT * FROM dt_pelanggan");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['nik'] = $row['nik'];
//             $temp['nama'] = $row['nama'];
//             $temp['tempat'] = $row['tempat'];
//             $temp['tanggal'] = $row['tanggal'];
//             $temp['alamat'] = $row['alamat'];
//             $temp['jk'] = $row['jk'];
//             $temp['agama'] = $row['agama'];
//             $temp['telp'] = $row['telp'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "print income customer month":
//         $response = array();
//         $ex = $mysqli->query("SELECT dt_pelanggan.nama, SUM(dt_penyewaan.bayar) AS jml, COUNT(dt_penyewaan.plat) AS jml_mobil FROM dt_penyewaan LEFT JOIN dt_pengguna ON dt_penyewaan.nik = dt_pengguna.id LEFT JOIN dt_pelanggan ON dt_pengguna.id = dt_pelanggan.nik WHERE MONTH(dt_penyewaan.tgl_kembali) = MONTH('2020-" . $_POST["month"] . "-12 00:00:00') AND YEAR(dt_penyewaan.tgl_kembali) = YEAR('" . $_POST["year"] . "-12-12 00:00:00') AND (dt_penyewaan.status = 'Selesai' OR dt_penyewaan.status = 'Batal') GROUP BY dt_pelanggan.nama ORDER BY dt_pelanggan.nama ASC");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['nama'] = $row['nama'];
//             $temp['jml'] = $row['jml'];
//             $temp['jml_mobil'] = $row['jml_mobil'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "print income month":
//         $response = array();
//         $ex = $mysqli->query("SELECT tgl_kembali, SUM(bayar) AS jml, COUNT(plat) AS jml_mobil FROM dt_penyewaan WHERE MONTH(tgl_kembali) = MONTH('2020-" . $_POST["month"] . "-12 00:00:00') AND YEAR(tgl_kembali) = YEAR('" . $_POST["year"] . "-12-12 00:00:00') AND (status = 'Selesai' OR status = 'Batal') GROUP BY DATE_FORMAT(tgl_kembali,'%d %M %Y')");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['tgl_kembali'] = $row['tgl_kembali'];
//             $temp['jml'] = $row['jml'];
//             $temp['jml_mobil'] = $row['jml_mobil'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;
//     case "print history customer month":
//         $response = array();
//         $ex = $mysqli->query("SELECT CONCAT(dt_mobil.merek,' ',dt_mobil.model) AS nama, dt_penyewaan.tgl_ambil, dt_penyewaan.tgl_kembali FROM dt_penyewaan INNER JOIN dt_mobil ON dt_penyewaan.plat = dt_mobil.plat WHERE dt_penyewaan.nik = '" . $_POST["nik"] . "' AND dt_penyewaan.status = 'Selesai' ORDER BY dt_penyewaan.tgl_ambil ASC");
//         while ($row = $ex->fetch_array(MYSQLI_ASSOC)) {
//             $temp['nama'] = $row['nama'];
//             $temp['tgl_ambil'] = $row['tgl_ambil'];
//             $temp['tgl_kembali'] = $row['tgl_kembali'];
//             array_push($response, $temp);
//         }
//         die(json_encode($response));
//         break;

//     default:
//         break;
// }
// $mysqli->close();
// ?>



?>