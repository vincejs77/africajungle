<?php
require('../BData.php');
$r_data = json_decode(file_get_contents("php://input"));
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin:*");
$tab = array();

if (isset($_FILES['cover']['name']) && isset($_FILES['pdf']['name'])) {
    $movePdf = false;
    $moveCover = false;
    $currentTime = time();

    $cover_name = $_FILES['cover']['name'];
    $cover_valide_extensions = array("jpg","jpeg","png","JPG","JPEG","PNG");
    $cover_extension = pathinfo($cover_name,PATHINFO_EXTENSION);
    if (in_array($cover_extension,$cover_valide_extensions)) {
        mkdir('../BFile/books/'.$currentTime, 0777, true);
        $newPath = '../BFile/books/'.$currentTime.'/'. $currentTime.'_cover.'.$cover_extension;
        if (move_uploaded_file($_FILES['cover']['tmp_name'],$newPath)) {
            // $tab = array_merge($tab,array(['code'=>1]));
            $moveCover = true;
        }else{
            // $tab = array_merge($tab,array(['code'=>1, 'message'=>"Err fichier"]));
        }
    }else{
        // $tab = array_merge($tab,array(['code'=>1, 'message'=>"Err extension"]));
    }

    $pdf_name = $_FILES['pdf']['name'];
    $pdf_valide_extensions = array("pdf","PDF");
    $pdf_extension = pathinfo($pdf_name,PATHINFO_EXTENSION);
    if (in_array($pdf_extension,$pdf_valide_extensions)) {
        if (!file_exists('../BFile/books/'.$currentTime)) {
            mkdir('../BFile/books/'.$currentTime, 0777, true);
        }
        $newPath = '../BFile/books/'.$currentTime.'/'.$currentTime. '_pdf.'.$pdf_extension;
        if (move_uploaded_file($_FILES['pdf']['tmp_name'],$newPath)) {
            // $tab = array_merge($tab,array(['code'=>1]));
            $movePdf = true;
        }else{
            // $tab = array_merge($tab,array(['code'=>1, 'message'=>"Err fichier"]));
        }
    }else{
        // $tab = array_merge($tab,array(['code'=>1, 'message'=>"Err extension"]));
    }

    if ($movePdf == true && $moveCover == true) {

        $newBook = $BE->prepare('INSERT INTO books (titre, description, editeur, isbn, categorie, scategorie, annee, dtime, state, vue, fav, coverEx, fileEx) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $newBook->execute(array(
            $_POST['title'],
            $_POST['desc'],
            $_POST['edit'],
            $_POST['isbn'],
            $_POST['cat'],
            $_POST['sousCats'],
            $_POST['annee'],
            $currentTime,
            0,
            0,
            0,
            $cover_extension,
            $pdf_extension
        ));

        $tab = array_merge($tab,array(['code'=>1]));
    } else {
        if (file_exists('../BFile/books/'.$currentTime.'/'. $currentTime.'_cover.'.$cover_extension)) {
            unlink('../BFile/books/'.$currentTime.'/'. $currentTime.'_cover.'.$cover_extension);
        }

        if (file_exists('../BFile/books/'.$currentTime.'/'.$currentTime. '_pdf.'.$pdf_extension)) {
            unlink('../BFile/books/'.$currentTime.'/'.$currentTime. '_pdf.'.$pdf_extension);
        }

        if (!file_exists('../BFile/books/'.$currentTime)) {
            rmdir('../BFile/books/'.$currentTime);
        }
    }
}

print(json_encode($tab));

?>