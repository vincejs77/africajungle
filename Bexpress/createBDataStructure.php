<?php
$connect = mysqli_connect("127.0.0.1", "root", "");
if (mysqli_query($connect, "CREATE DATABASE bdata")) {
    $connect = mysqli_connect('127.0.0.1', 'root', '', 'bdata');
    //////
    $req = "DROP TABLE books_users";
    echo mysqli_query($connect, $req);
    $req = "CREATE TABLE book_users (
        id int(11) NOT NULL PRIMARY KEY,
        name varchar(100) NOT NULL,
        adresse varchar(100) NOT NULL,
        phone varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        password varchar(100) NOT NULL,
        state int(1) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    echo mysqli_query($connect, $req);
    $req = "ALTER TABLE book_users CHANGE id id INT(11) NOT NULL AUTO_INCREMENT";
    echo mysqli_query($connect, $req);
    //////

    //////
    $req = "DROP TABLE books";
    echo mysqli_query($connect, $req);
    $req = "CREATE TABLE `books` (
        id int(11) NOT NULL PRIMARY KEY,
        titre varchar(255) NOT NULL,
        description varchar(255) NOT NULL,
        editeur varchar(255) NOT NULL,
        isbn varchar(255) NOT NULL,
        categorie varchar(255) NOT NULL,
        scategorie varchar(255) NOT NULL,
        annee varchar(5) NOT NULL,
        coverEx varchar(5) NOT NULL,
        fileEx varchar(5) NOT NULL,
        dtime int(20) NOT NULL,
        state int(1) NOT NULL,
        vue int(11) NOT NULL,
        fav int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    echo mysqli_query($connect, $req);
    $req = "ALTER TABLE books CHANGE id id INT(11) NOT NULL AUTO_INCREMENT";
    echo mysqli_query($connect, $req);
    //////
      
}
mysqli_close($connect);
?>