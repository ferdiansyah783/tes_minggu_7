<?php

include "connection.php";

function deleteSiswa(){
    global $db;
    $delete=$db->exec("delete from siswa where id_siswa=".$_GET["id_siswa"]);
    
    if ($delete) {
        header("Location:index.php");
    }
}

// team
function deleteTim(){
    global $db;
    $hapus=$db->exec("delete from tim where id_tim=".$_GET["id_tim"]);
    
    if ($hapus) {
        header("Location:index.php");
    }
}
