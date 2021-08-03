<?php
require('../BData.php');
$r_data = json_decode(file_get_contents("php://input"));
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin:*");
$tab = array();

if ($r_data->code == 1) {
    for ($i=date('Y') - 20; $i <= date('Y') ; $i++) { 
        $tab = array_merge(
            $tab,
            array([
                'label'=>$i,
                'value'=>$i
            ])
        );
    }
}

print(json_encode($tab));
?>