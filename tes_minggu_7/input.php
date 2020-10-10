<?php

include "connection.php";

    $input=$db->exec("insert into siswa(nama_siswa,sekolah,motivasi) values('".$_POST['nama_siswa']."','".$_POST['sekolah']."','".$_POST['motivasi']."')");
    if($input)
    {
        header("Location:index.php");
    }


// team

    // $input_team=$db->exec("insert into tim(nama_tim) values('".$_POST['nama_tim']."')");
    // if($input_team)
    // {
    //     header("Location:index.php");
    // }


