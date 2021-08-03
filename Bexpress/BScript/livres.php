<?php
require('../BData.php');
$r_data = json_decode(file_get_contents("php://input"));
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin:*");
$tab  = array();

if ($r_data->code == 1) {
    $getBook = $BE->prepare('SELECT * FROM books ORDER BY titre ASC');
    $getBook->execute();
    while ($getBookRes = $getBook->fetchObject()) { 
        $tab = array_merge(
            $tab,
            array([
                'id'=> $getBookRes->id,
                'file'=> 'http://127.0.0.1/Bexpress/BFile/books/'.$getBookRes->dtime.'/'.$getBookRes->dtime. '_pdf.'.$getBookRes->fileEx,
                'isbn'=> $getBookRes->isbn,
                'img'=> 'http://127.0.0.1/Bexpress/BFile/books/'.$getBookRes->dtime.'/'.$getBookRes->dtime. '_cover.'.$getBookRes->coverEx,
                'title'=> $getBookRes->titre,
                'desc'=> $getBookRes->description,
                'edit'=> $getBookRes->editeur,
                'cat'=> $getBookRes->categorie,
                'sousCats'=> $getBookRes->scategorie,
                'vues'=> $getBookRes->vue,
                'stars'=> 1,
                'fav'=> $getBookRes->fav,
                'inFav'=> false,
                'state'=> $getBookRes->state
            ])
            );
    }
}

if ($r_data->code == 2) {
    $upLivre = $BE->prepare('UPDATE books SET vue=?  WHERE id = ?');
    $upLivre->execute(array(
        $r_data->vues,
        $r_data->livre
    ));

}

if ($r_data->code == 3) {
    $upLivre = $BE->prepare('UPDATE books SET fav=?  WHERE id = ?');
    $upLivre->execute(array(
        $r_data->favs,
        $r_data->livre
    ));

}


if ($r_data->code == 4) {
    $small = 0;
$bigger  = 0;
$getBook = $BE->prepare('SELECT annee, COUNT(*) AS small_year FROM books');
$getBook->execute();
$getBookRes = $getBook->fetchObject();
if ($getBookRes->small_year > 1) {
    $getSmallBook = $BE->prepare('SELECT annee FROM books ORDER BY annee ASC LIMIT 0,1');
    $getSmallBook->execute();
    $getSmallBookRes = $getSmallBook->fetchObject();
    $small = $getSmallBookRes->annee;
    $getBiggerBook = $BE->prepare('SELECT annee FROM books ORDER BY annee DESC LIMIT 0,1');
    $getBiggerBook->execute();
    $getBiggerBookRes = $getBiggerBook->fetchObject();
    $bigger = $getBiggerBookRes->annee;
}
$tab = array();
$tab = array_merge($tab,
    array([
        'label'=>'Tous',
        'value'=>$small.'-'.($bigger),
        'first_year'=>$small,
        'second_year'=>($bigger)
    ])
);
$llength =  ($bigger-$small);
for ($i=0; $i < $llength ; $i++) { 
//    echo $small.'-'.($small+5).'<br>';
$tab = array_merge(
    $tab,
    array([
        'label'=>$small.'-'.($small+5),
        'value'=>$small.'-'.($small+5),
        'first_year'=>$small,
        'second_year'=>($small+5)
    ])
);
   $small += 5;
   if ($small >= $bigger) {
      break;
   }
}
}


if ($r_data->code == 5) {
    $Rtitle = "";
    $Rfirst = "";
    $Rsecond = ""; 

    if ($r_data->title != "") {
        $Rtitle = " (titre LIKE '%".$r_data->title."%') ";
    }

    if ($r_data->first_year != "") {
        if ($r_data->title != "") {
            $Rfirst = "AND (annee >= ".$r_data->first_year.")";
        } else {
            $Rfirst = "(annee >= ".$r_data->first_year.")";
        }
    }

    if ($r_data->second_year != "") {
        if ($r_data->first_year != "") {
            $Rsecond = "AND (annee <= ".$r_data->second_year.")";
        } else {
            $Rsecond = "(annee <= ".$r_data->second_year.")";
        }
    }

    if ($Rtitle != "" || $Rfirst != "" || $Rsecond != "") {
        $search_query = "SELECT * FROM books WHERE $Rtitle $Rfirst $Rsecond ORDER BY titre ASC LIMIT 3";
    $result_search = $BE->query($search_query);
    while($row = $result_search->fetchObject()){
            $getBook = $BE->prepare('SELECT * FROM books WHERE id=?');
            $getBook->execute(array($row->id));
            while ($getBookRes = $getBook->fetchObject()) { 
                $tab = array_merge(
                    $tab,
                    array([
                        'id'=> $getBookRes->id,
                        'file'=> 'http://127.0.0.1/Bexpress/BFile/books/'.$getBookRes->dtime.'/'.$getBookRes->dtime. '_pdf.'.$getBookRes->fileEx,
                        'isbn'=> $getBookRes->isbn,
                        'img'=> 'http://127.0.0.1/Bexpress/BFile/books/'.$getBookRes->dtime.'/'.$getBookRes->dtime. '_cover.'.$getBookRes->coverEx,
                        'title'=> $getBookRes->titre,
                        'desc'=> $getBookRes->description,
                        'edit'=> $getBookRes->editeur,
                        'cat'=> $getBookRes->categorie,
                        'sousCats'=> $getBookRes->scategorie,
                        'vues'=> $getBookRes->vue,
                        'stars'=> 1,
                        'fav'=> $getBookRes->fav,
                        'inFav'=> false,
                        'state'=> $getBookRes->state
                    ])
                    );
            }
        }
    }
}

if ($r_data->code == 6) {
  if(!file_exists('../BFile/userFile/'.$r_data->myid)){
    mkdir('../BFile/userFile/'.$r_data->myid, 0777, true);
  }

  if(file_exists('../BFile/userFile/'.$r_data->myid.'/lecture.txt')){
    $tab = unserialize(file_get_contents('../BFile/userFile/'.$r_data->myid.'/lecture.txt'));
  }
  
 if (!in_array($r_data->livre, $tab)) {
    $tab = array_merge(
      array($r_data->livre),
      $tab
    );

    file_put_contents('../BFile/userFile/'.$r_data->myid.'/lecture.txt', serialize($tab));
 }
}
if ($r_data->code == 7) {
  $lecture = array();
  if(file_exists('../BFile/userFile/'.$r_data->myid.'/lecture.txt')){
    $lecture = unserialize(file_get_contents('../BFile/userFile/'.$r_data->myid.'/lecture.txt'));
  }
  for ($i=0; $i < sizeof($lecture); $i++) { 
    $getBook = $BE->prepare('SELECT *, COUNT(*) AS isInBd FROM books WHERE id=?');
      $getBook->execute(array($lecture[$i]));
      $getBookRes = $getBook->fetchObject();
          if ($getBookRes->isInBd == 1) {
            $tab = array_merge(
                $tab,
                array([
                    'id'=> $getBookRes->id,
                    'file'=> 'http://127.0.0.1/Bexpress/BFile/books/'.$getBookRes->dtime.'/'.$getBookRes->dtime. '_pdf.'.$getBookRes->fileEx,
                    'isbn'=> $getBookRes->isbn,
                    'img'=> 'http://127.0.0.1/Bexpress/BFile/books/'.$getBookRes->dtime.'/'.$getBookRes->dtime. '_cover.'.$getBookRes->coverEx,
                    'title'=> $getBookRes->titre,
                    'desc'=> $getBookRes->description,
                    'edit'=> $getBookRes->editeur,
                    'cat'=> $getBookRes->categorie,
                    'sousCats'=> $getBookRes->scategorie,
                    'vues'=> $getBookRes->vue,
                    'stars'=> 1,
                    'fav'=> $getBookRes->fav,
                    'inFav'=> false,
                    'state'=> $getBookRes->state
                ])
                );
          }
      }
}
if ($r_data->code == 8) {
  $favs = $r_data->allMyFav;
  // $favs = json_encode($r_data->allMyFav);
  // $favs = json_decode($r_data->allMyFav, true);
  // $favs = serialize($r_data->allMyFav);
  // $favs = unserialize($r_data->allMyFav);
  for ($i=0; $i < sizeof($favs); $i++) { 
    $getBook = $BE->prepare('SELECT *, COUNT(*) AS isFound FROM books WHERE categorie=?');
      $getBook->execute(array($favs[$i]));
      $getBookRes = $getBook->fetchObject();
      if ($getBookRes->isFound >= 1) {
        $tab = array_merge(
          $tab,
          array([
              'id'=> $getBookRes->id,
              'file'=> 'http://127.0.0.1/Bexpress/BFile/books/'.$getBookRes->dtime.'/'.$getBookRes->dtime. '_pdf.'.$getBookRes->fileEx,
              'isbn'=> $getBookRes->isbn,
              'img'=> 'http://127.0.0.1/Bexpress/BFile/books/'.$getBookRes->dtime.'/'.$getBookRes->dtime. '_cover.'.$getBookRes->coverEx,
              'title'=> $getBookRes->titre,
              'desc'=> $getBookRes->description,
              'edit'=> $getBookRes->editeur,
              'cat'=> $getBookRes->categorie,
              'sousCats'=> $getBookRes->scategorie,
              'vues'=> $getBookRes->vue,
              'stars'=> 1,
              'fav'=> $getBookRes->fav,
              'inFav'=> false,
              'state'=> $getBookRes->state
          ])
          );
      }
      }

}

if ($r_data->code == 9) {
    $livres = $r_data->livres;
    // $tab = array($livres[0]->id);
    for ($i=0; $i < sizeof($livres); $i++) { 
        $delReq = $BE->prepare('DELETE from books WHERE id=?');
        $delReq->execute(array($livres[$i]->id));
    }
}

print(json_encode($tab));
?>