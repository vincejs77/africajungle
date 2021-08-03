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
        $accountFound = true;
        break;
    }
}
$findBookUser = $BE->prepare('SELECT *, COUNT(*) AS u_Exists FROM book_users WHERE email=? AND password=? AND state=?');
$findBookUser->execute(array(
    $r_data->u_name,
    $r_data->u_pass,
    1
));
$findBookUserRes = $findBookUser->fetchObject();
if ($findBookUserRes->u_Exists == 0 && $accountFound == false) {
    $newBook = $BE->prepare('INSERT INTO book_users (name, adresse, phone, email, password, state) VALUES(?,?,?,?,?,?)');
        $newBook->execute(array(
            "",
            "",
            "",
            $r_data->u_name,
            $r_data->u_pass,
            1
        ));
        $tab = array([
            'code'=>1
        ]);
} else {
    $tab = array([
        'code'=>0
    ]);
}

print(json_encode($tab));

?>