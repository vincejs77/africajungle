<?php
require('../BData.php');
$r_data = json_decode(file_get_contents("php://input"));
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin:*");
$tab = array();
if ($r_data->code == 1) {
    $tab = array(
        "Toutes",
        "SCiences exactes",
        "Litteraire",
        "Pychologie",
        "Droit",
        "Education"
    );
}
if ($r_data->code == 2) {
    $tab = array(
    "Mathematique",
    "Chimie",
    "Biologie",
    "Geologie",
    "Culture et societe"
    );
}
if ($r_data->code == 3) {
    $tab = array(
        "Univ 1",
        "Univ 2",
        "Univ 3",
        "Univ 4",
        "Univ 5",
        "Univ 6"
    );
}
print(json_encode($tab));

?>