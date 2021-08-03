<?php
require('../BData.php');
$r_data = json_decode(file_get_contents("php://input"));
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin:*");
$tab = array();
if ($r_data->code == 1) {
    $findBookUser = $BE->prepare('SELECT * FROM book_users');
    $findBookUser->execute();
    while($findBookUserRes = $findBookUser->fetchObject()) {
        $userUniv = array();
        if (file_exists('../BFile/userFile/'.$findBookUserRes->id.'/univ.txt')) {
            $userUniv = unserialize(file_get_contents('../BFile/userFile/'.$findBookUserRes->id.'/univ.txt'));
          }
        $tab = array([
            'id'=>$findBookUserRes->id,
            'type'=>3,
            'name'=> $findBookUserRes->name,
            'email'=>$findBookUserRes->email,
            'phone'=>$findBookUserRes->phone,
            'univ'=>sizeof($userUniv) > 0 ? $userUniv[0] : "Auncune",
            'password'=>$findBookUserRes->password,
            'state'=>floatval($findBookUserRes->state) == 1 ? true : false
        ]);
    }
}
print(json_encode($tab));

?>