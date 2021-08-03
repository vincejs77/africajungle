<?php
require('../BData.php');
$r_data = json_decode(file_get_contents("php://input"));
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin:*");
$tab = array();

if ($r_data->code == 1) {
    $tab = array(['type'=>1, 'name'=>"Admin alpha",'email'=>"bexpress@admin.org", 'password'=>"bexpressdefault", 'phone'=>"+243...", 'state'=>1]);
    if (!file_exists('../BFile/superUser/superUser.txt')) {
        file_put_contents('../BFile/superUser/superUser.txt', serialize($tab));
        $tab = array(['code'=>0,'message'=>"admin alpha required"]);
    } else {
        $tab = array(['code'=>1,'message'=>"admin alpha found"]);
    }
}

print(json_encode($tab));
?>