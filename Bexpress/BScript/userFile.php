<?php
require('../BData.php');
$r_data = json_decode(file_get_contents("php://input"));
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin:*");
$tab = array();

if ($r_data->code == 1) {
    $req = $BE->prepare('UPDATE book_users SET name=?, phone=?, email=?, password=? WHERE id=?');
    $req->execute(array(
        $r_data->userName,
        $r_data->userTel,
        $r_data->userMail,
        $r_data->password,
        $r_data->myid
    ));
    $univs = array();
    $univ = $r_data->univ;
    if (!file_exists('../BFile/userFile/'.$r_data->myid)) {
        mkdir('../BFile/userFile/'.$r_data->myid, 0777, true);
    }

    if (file_exists('../BFile/userFile/'.$r_data->myid)) {
      // if (file_exists('../BFile/userFile/'.$r_data->myid.'/univ.txt')) {
      //   $univs = unserialize(file_get_contents('../BFile/userFile/'.$r_data->myid.'/univ.txt'));
      // }
      $univs = array_merge(
        $univs,
        array($univ)
      );
      file_put_contents('../BFile/userFile/'.$r_data->myid.'/univ.txt', serialize($univs));
    }

    $tab = array([
      'code'=>1
    ]);
}

if ($r_data->code == 2) {
    if (file_exists('../BFile/userFile/'.$r_data->myid.'/categories.txt')) {
      $tab = unserialize(file_get_contents('../BFile/userFile/'.$r_data->myid.'/categories.txt'));
    }
}
if ($r_data->code == 3) {
  $mycat = json_encode($r_data->mycat);
    if (!file_exists('../BFile/userFile/'.$r_data->myid)) {
        mkdir('../BFile/userFile/'.$r_data->myid, 0777, true);
    }

    if (file_exists('../BFile/userFile/'.$r_data->myid)) {
      file_put_contents('../BFile/userFile/'.$r_data->myid.'/categories.txt', serialize(json_decode($mycat,true)));
    }
}

if ($r_data->code == 4) {
  if (file_exists('../BFile/userFile/'.$r_data->myid.'/univ.txt')) {
    $tab = unserialize(file_get_contents('../BFile/userFile/'.$r_data->myid.'/univ.txt'));
  }
}

if ($r_data->code == 5) {
  $accountFound = false;
  $tab = unserialize(file_get_contents('../BFile/superUser/superUser.txt'));
  for ($i=0; $i < sizeof($tab); $i++) { 
      if ($tab[$i]['email'] == $r_data->userMail && $tab[$i]['password'] == $r_data->password && $tab[$i]['state'] != 0) {
              $tab[$i]['name'] = $r_data->userName;
              $tab[$i]['email'] = $r_data->new_userMail;
              $tab[$i]['password'] = $r_data->new_password; 
              $tab[$i]['phone'] = $r_data->userTel;
          $accountFound = true;
          break;
      }
  }
  if ($accountFound) {
    file_put_contents('../BFile/superUser/superUser.txt', serialize($tab));
    $tab = array([
      'code'=>1
    ]);
  } else {
    $tab = array([
      'code'=>0
    ]);
  }
}
print(json_encode($tab));
?>