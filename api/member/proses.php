<?php 
include "Member.php";
$buku = new Member();
$mode = $_POST['mode'];
$out = [];
switch($mode){
    case 'get':
        $data   = $buku->get(); 
        echo json_encode($data);
    break;

    case 'delete':
        $idbuku = (isset($_POST['idbuku']))?$_POST['idbuku']:0;
        $res = $buku->delete($idbuku);
        $out['status']=$res;
        if($res)
            $out['messages'] = "Data Berhasil Hapus";
        else
            $out['messages'] = "Gagal Menghapus Data";
        json_encode($out);
    break;

    case 'add':
        $res = $buku->add($_POST);
        
        $out['status'] = $res;
        if($res)
            $out['messages'] = "Data Berhasil disimpan";
        else
            $out['messages'] = "Gagal Menyimpan Data";
            
        echo json_encode($out);
    break;

    case 'update':
        $res = $buku->update($_POST);

        $out['status'] = $res;
        if($res)
            $out['messages'] = "Data Berhasil Dirubah";
        else
            $out['messages'] = "Gagal Merubah Data";
            
        echo json_encode($out);
    break;

}

?>