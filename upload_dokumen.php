<?php
//include('dbconnected.php');
include('koneksi.php');
//menyiapkan validasi gambar yang akan di upload
 $id=$_POST['id'];
 $nama=$_POST['nama'];
 $file=$_FILES['dokumen']['name'];
 $tmp_dir=$_FILES['dokumen']['tmp_name'];
 $ukuran=$_FILES['dokumen']['size'];
 $direktori='uploads/dokumen/'; //path tempat simpan
 $ektensi=strtolower(pathinfo($file, PATHINFO_EXTENSION)); //dapatkan info gambar
 $valid_ektensi=array('jpeg','jpg','png','pdf'); //ektensi yang dibloehin
 $gambar=$nama.'-'.$file;

 
//mulai validasi
//cek ektensi gambar
if(in_array($ektensi, $valid_ektensi)){
 //cek ukuran gambar
 if(!$ukuran < 1000000) { //jika lebih
  move_uploaded_file($tmp_dir, $direktori.$gambar);
  //simpan dan buat query
$query = mysqli_query($koneksi,"UPDATE data SET dokumen = '$gambar' where id = $id ");

 if(!$query){
  header("location:data.php?tambah=gagal");
 }else{
  header("location:data.php?upload=sukses");
  }
 }
 else{
  echo "Gambar kegedean <br/>
  <a href='data.php'>Kembali</a>";
 }
}
else{
 echo "Gambar yang koe upload ora sesuai<br/>
 <a href='data.php'>Kembali</a>";
}

?>