<?php
// // $ms = 'ssssss';
// // echo bcpow(2,2);
// // echo bcpow(3, 5)*21;
// $r_data = json_decode(file_get_contents("php://input"));
// header('Access-Control-Allow-Headers: *');
// header("Access-Control-Allow-Origin:*");
// $tab = array();
// $tabFaux = array();
// if ($r_data->code == 1) {
//     for ($i=$r_data->debut; $i <= $r_data->limit; $i++) { 
//         if (
//            ($i >= 2 ?((($i%2) !=0)?true: false): true) &&
//            ($i > 3 ?((($i%3) !=0 && $i != 3)?true: false): true) &&
//            ($i > 4 ?((($i%4) !=0 && $i != 4)?true: false): true) &&
//            ($i > 5 ?((($i%5) !=0 && $i != 5)?true: false): true) &&
//            ($i > 6 ?((($i%6) !=0 && $i != 6)?true: false): true) &&
//            ($i > 7 ?((($i%7) !=0 && $i != 7)?true: false): true) &&
//            ($i > 8 ?((($i%8) !=0 && $i != 8)?true: false): true) &&
//            ($i > 9 ?((($i%9) !=0 && $i != 9)?true: false): true)
//             ) {
//             $tab = array_merge(
//                 $tab,
//                 array(['label'=>$i, 'value'=>$i])
//             );
//         } else {
//            $tabFaux = array_merge(
//                $tabFaux,
//                array($i)
//            );
//         }
//     }
// }

// if ($r_data->code == 2) {
//     $premiers = json_encode($r_data->premiers);
//     $premiers = serialize(json_decode($premiers));
//     $premiers = unserialize($premiers);
//     $pgcd = 0;
//     $nbpremier = 0;
//     $lastPos = 0;
//     for ($i2=1; $i2 < sizeof($premiers) ; $i2++) { 
//         for ($i=1; $i <= $r_data->max; $i++) {
//                 if (
//                     (($premiers[$i2]->value%$i == 0) && ($r_data->max%$i == 0))
//                     ) {
//                     $pgcd = $i;
//                     $nbpremier = $premiers[$i2]->value;
//                     $lastPos = $i2;
//                 }
//             }
//             if (floatval($pgcd) == 1) {
//                 break;
//             }
//     }
//     $tab = array([
//         'pgcd'=>$nbpremier,
//         'lastPost'=>$lastPos
//     ]);
// }

// if ($r_data->code == 3) {
//     $premiers = json_encode($r_data->premiers);
//     $premiers = serialize(json_decode($premiers));
//     $premiers = unserialize($premiers);
//     $pgcd = 0;
//     $nbpremier = 0;
//     for ($i2=($r_data->debut+1); $i2 < sizeof($premiers) ; $i2++) { 
//         for ($i=1; $i <= $r_data->max; $i++) {
//                 if (
//                     ((($premiers[$i2]->value * $premiers[$r_data->debut]->value)%$i == 0) && ($r_data->max%$i == 0))
//                     ) {
//                     $pgcd = $i;
//                     $nbpremier = $premiers[$i2]->value;
//                 }
//             }
//             if (floatval($pgcd) == 1 && (($premiers[$i2]->value * $premiers[$r_data->debut]->value)%$r_data->max == 1)) {
//                 break;
//             }
//     }
//     $tab = array([
//         'pgcd'=>$nbpremier
//     ]);
// }
// if ($r_data->code == 4) {
//   $message = '';
//   $crypMessage = explode(";", $r_data->message);
//   for ($i=0; $i < sizeof($crypMessage); $i++) { 
//       $message = $message.''
//       // .''.$crypMessage[$i].'^'.$r_data->myD.' mode '.$r_data->myN;
//       .(bcpow(intval($crypMessage[$i]), intval($r_data->myD))%$r_data->myN).($i < sizeof($crypMessage) - 1?',':'');
//   }
//   $tab = array([
//       'message'=>$message
//   ]);
// }
// if ($r_data->code == 5) {
//     $message = '';
//     for ($i=0; $i < strlen($r_data->message); $i++) { 
//         $message = $message.''.(pow(intval($r_data->message[$i]), intval($r_data->myD))%$r_data->myN).($i < strlen($r_data->message) - 1?';':'');
//     }
//     $tab = array([
//         'message'=>$message
//     ]);
// }
// //  for ($i=0; $i <sizeof($tab); $i++) { 
// //     $test = random_int(1,9);
// //    echo "[".$tab[$i]." Ex : $tab[$i] mod $test= ".($tab[$i]%$test)."]<br>";
// // }
// // echo "==============================<br>";
// // for ($i=0; $i <sizeof($tabFaux); $i++) { 
// //     $test = random_int(1,9);
// //    echo "[".$tabFaux[$i]." Ex : $tabFaux[$i] mod $test= ".($tabFaux[$i]%$test)."]<br>";
// // }

// // if (((%2) !=0)) {
// //    echo "wwwwwwwwwwww";
// // }
// print(json_encode($tab));

$message = "Je suis malade";
echo "Message : <br>".$message."<br>";
echo "Message crypte : <br>".sha1($message);


?>