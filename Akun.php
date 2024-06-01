<?php
    include "koneksi.php";
    session_start();

    if(isset($_POST['bsimpan'])){
        $simpan = mysqli_query($koneksi, "INSERT INTO user (role, username, password, email) VALUES ('$_POST[trole]', '$_POST[tusername]' , '$_POST[tpassword]', '$_POST[temail]' ) ");
    
        if($simpan){
            echo "<script>
            alert ('simpan data succes');
            document.location='HomeAdmin.php';
            
            </script>";
        }else{
            echo "<script>
            alert ('simpan data gagal');
            document.location='HomeAdmin.php';
            
            </script>";
        }
    
    }


    if(isset($_POST['bubah'])){
        $ubah = mysqli_query($koneksi, " UPDATE user SET role = '$_POST[trole]', username = '$_POST[tusername]', password = '$_POST[tpassword]', email = '$_POST[temail]' WHERE id_user = '$_POST[id_user]' ");
    
        if($ubah){
            echo "<script>
            alert ('ubah data succes');
            document.location='HomeAdmin.php';
            
            </script>";
        }else{
            echo "<script>
            alert ('ubah data gagal');
            document.location='HomeAdmin.php';
            
            </script>";
        }
    
    }


    if(isset($_POST['bhapus'])){
        $hapus = mysqli_query($koneksi, " DELETE FROM user WHERE id_user = '$_POST[id_user]' ");
    
        if($hapus){
            echo "<script>
            alert ('hapus data succes');
            document.location='HomeAdmin.php';
            
            </script>";
        }else{
            echo "<script>
            alert ('hapus data gagal');
            document.location='HomeAdmin.php';
            
            </script>";
        }
    
    }

   
?>