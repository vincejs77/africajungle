<?php
require('../BData.php');
$r_data = json_decode(file_get_contents("php://input"));
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin:*");
$tab = array();
$accountFound = false;
$tab = unserialize(file_get_contents('../BFile/superUser/superUser.txt'));
for ($i=0; $i < sizeof($tab); $i++) { 
    if ($tab[$i]['email'] == $r_data->u_name && $tab[$i]['password'] == $r_data->u_pass && $tab[$i]['state'] != 0) {
        $tab = array([
            'code'=>1,
            'id'=>null,
            'type'=>$tab[$i]['type'],
            'name'=> $tab[$i]['name'],
            'email'=>$tab[$i]['email'],
            'password'=>$tab[$i]['password'], 
            'state'=>$tab[$i]['state'], 
            'phone'=>$tab[$i]['phone']
        ]);
        $accountFound = true;
        break;
    }
}


if ($accountFound == false) {
    $findBookUser = $BE->prepare('SELECT *, COUNT(*) AS u_Exists FROM book_users WHERE email=? AND password=? AND state=?');
    $findBookUser->execute(array(
        $r_data->u_name,
        $r_data->u_pass,
        1
    ));
    $findBookUserRes = $findBookUser->fetchObject();
    if ($findBookUserRes->u_Exists == 1) {
        $tab = array([
            'code'=>1,
            'id'=>$findBookUserRes->id,
            'type'=>3,
            'name'=> $findBookUserRes->name,
            'email'=>$findBookUserRes->email,
            'password'=>$findBookUserRes->password,
            'state'=>$findBookUserRes->state, 
            'phone'=>$findBookUserRes->phone
        ]);
        $accountFound = true;
    }
}

if ($accountFound == false) {
    $tab = array([
        'code'=>0,
        'message'=>"User not found"
    ]);
}
print(json_encode($tab));

?>