<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>

<!-- PROJECT LOGO -->
<br />
<br />
<div align="center">
  <a href="https://github.com/dhondoi/Java-Android-Prototipe-Membuat-Dan-Menghubungkan-API">
    <img src="images/title.jpg" alt="Logo" width="400" >
  </a>

  <h1 align="center">Java-Android-Prototipe-Menghubungkan-API</h1>

  <p align="center">
     Menghubungkan java android menggunakan library volley ke database melewati PHP. Database dan PHP menggunakan tools XAMPP untuk memudahkan. Tujuan dari Pembahasan kali ini adalah keberhasilan dalam mengambil data sehingga menjadi informasi yang diperlukan.
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details style="margin-top: 24px;">
  <summary>Table of Contents</summary>
      <ul>
          <li><a href="#pendahuluan">Pendahuluan</a></li>
          <li><a href="#pembahasan">Pembahasan</a></li>
          <li><a href="#simpulan">Simpulan</a></li>
          <!-- <li><a href="#daftar-Pustaka">Daftar Pustaka</a></li> -->
      </ul>
</details>

<!-- Pendahuluan -->
## Pendahuluan

Pemrograman bahasa java merupakan salah satu bahasa yang digunakan untuk membuat aplikasi Android. Aplikasi Android biasanya membutuhkan data-data yang diproses menjadi sebuah informasi. Penyimpanan data dilakukan pada memory (RAM) saat aplikasi berjalan, file, ataupun database tergantung kebutuhan dalam bisnis. Singkat cerita, pada kesempatan kali ini saya membuat prototipe menghubungkan aplikasi android ke server (mohon maklum karena saya belum paham ke ranah dev-ops jika terdapat salah konsep) yang berisi API menggunakan PHP dan MySQL sebagai RDBMS-nya dengan tools XAMPP (untuk PHP dan MySQL) dan library Volley (untuk aplikasi Android).

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- Pendahuluan -->
## Pembahasan

### Teknologi

-  [![Android Studio][badge-android-studio]][link-android-studio]
-  [![Visual Studio Code][badge-vscode]][link-vscode]
-  [XAMPP][link-xampp]

### Algortitma

1. Buat Database (Lewati langkah ini jikalau anda sudah paham database mana yang ditargetkan, atau import file sql pada folder sql di database **toko-berada**)
- Jalankan Apache Server dan MySQL Server di XAMPP
![XAMPP 1][image-xampp1]
- Buka [phpmyadmin][link-phpmyadmin]
- Buat Database dan tabel (dalam hal ini nama databasenya **toko-berada** dan nama tabelnya **login** yang berisi atribute **username** dan **password** )
![Buat Database][image-db-create]
![Buat Tabel][image-tbl-create]
![Buat Atribute][image-attr-tbl-create]
- Isi tabel
![Isi tabel][image-insert-table]
2. Buat API (istilah saya pinjam, karena kemungkinan konsep-nya salah namun untuk menyederhanakan maksud.)
- Buat file PHP sebagai API (supaya terlihat rapih, buat folder **api** pada htdocs dan **toko-berada.php** untuk nama filenya)
![Buat File API][image-file-api-create]
- isikan file tersebut seperti berikut (atau cek di folder xampp pada repo ini)
```php
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
?>
```

3. Import Library Volley (**implementation 'com.android.volley:volley:1.2.1'**) pada build.gradle (Module:app)
![Import Library Volley][image-import-libary]

4. Setup
- tambahkan beberapa pengaturan pada AndroidManifest.xml
```xml
<?xml version="1.0" encoding="utf-8"?>
<manifest ...>

    ...
    <!-- untuk mengijinkan aplikasi mengakses internet -->
    <uses-permission android:name="android.permission.INTERNET" />
    ...

    <!-- 
        android 9 (sdk level 28)
        android:usesCleartextTraffic="true"
     -->
    <application
        ...
        android:usesCleartextTraffic="true"
        ...>
    </application>

</manifest>
```

- Cek ipserver (dalam hal ini komputer kita jadi server (terbukti Apache dan MySQL running)) dan masukan kedalam String URL (lihat juga Algoritma No.2 Point 1, terlihat direktorinya)
![Cek IP][image-endpoint]
- Fungsi Parameter Request (Keterkaitan LoginActivity.java dengan toko-berada.php)
![Fungsi Parameter][image-param]
![Fungsi Parameter 2][image-param2]
- Fungsi Parameter Response
![Fungsi Parameter Response][image-result]



<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Simpulan

Pada pada akhirnya point utama berada pada sintax
```java
// this adalah konteksnya
Volley.newRequestQueue(this)
// menambahkan request dengan object string request
                .add(new StringRequest(
                    // method requestnya post
                        Request.Method.POST,
                        // alamat URL endpoint
                        URL,
                        // response dari server
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                String text = "-";
                                try {
                                    if (new JSONObject(response).getInt("success") == 1) {
                                        text = "Login Berhasil";
                                    } else {
                                        text = "Login Gagal";
                                    }
                                } catch (JSONException e) {
//                                    text = e.getMessage();
                                    Log.e(getClass().getSimpleName(), "onResponse: ", e);
                                }
                                statusLogin.setText(text);
                            }
                        },
                        // jikalau terdapat error response dari server (misal code 500)
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
//                                statusLogin.setText(error.getMessage());
                                Log.e(getClass().getSimpleName(), "onErrorResponse: ", error);
                            }
                        }) {
                            // parameter yang dibawa request POST dalam hal ini code = "login", username = "admin", password = "admin"
                    @Override
                    protected Map<String, String> getParams() {
                        return params;
                    }
                });
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LINK BADGE & IMAGE-->
<!-- https://github.com/Ileriayo/markdown-badges -->

<!--
TEMPLATE

![MonoAlphabet][monoalphabet] # gambar 
[![Android Studio][badge-android-studio]][link-android-studio] # link menggunakan gambar
[XAMPP][link-xampp] # link

-->

<!-- IMAGE -->
[image-xampp1]: images/xampp1.png
[image-db-create]: images/db-create.png
[image-tbl-create]: images/tbl-create.png
[image-attr-tbl-create]: images/attr-tbl-create.png
[image-file-api-create]: images/file-api.png
[image-insert-table]: images/insert-table.png
[image-import-libary]: images/import-libary.png
[image-endpoint]: images/endpoint.png
[image-param]: images/param.png
[image-param2]: images/param2.png
[image-result]: images/result.png

<!-- BADGE -->
[badge-android-studio]: https://img.shields.io/badge/Android%20Studio-3DDC84.svg?style=for-the-badge&logo=android-studio&logoColor=white
[badge-vscode]: https://img.shields.io/badge/Visual%20Studio%20Code-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white

<!-- LINKS -->
[link-android-studio]: https://developer.android.com/studio
[link-xampp]: https://www.apachefriends.org/download.html
[link-vscode]: https://code.visualstudio.com/download
[link-phpmyadmin]: http://localhost/phpmyadmin