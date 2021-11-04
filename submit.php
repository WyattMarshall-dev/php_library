<?php

session_start();
    $db = new mysqli("localhost","root","","php_book");
    if ($db){
        // echo "Database Connected<hr>";
    }

    class Book {
        public $author, $title, $pub_year, $genre;

        function __construct($author, $title, $pub_year, $genre){
            $this->author = $author;
            $this->title = $title;
            $this->pub_year = $pub_year;
            $this->genre = $genre;
        }

        public function showInfo(){
            echo "Author: {$this->author}<br>";
            echo "Title: {$this->title}<br>";
            echo "Published: {$this->pub_year}<br>";
            echo "Genre: {$this->genre}<br>";
        }

        public function saveBook(){
            global $db;
            
            $sql = "INSERT INTO books (authorid, title, pub_year, genre) VALUES ('$this->author', '$this->title', '$this->pub_year', '$this->genre')";

            if($db->query($sql)){
                $_SESSION['success'] = "Saved Successfully";
            } else {
                $_SESSION['error'] = "Insert Failed";
            }

            $db->close();
            header('Location: index.php');
        }

        
    }

    $author = isset($_POST['author']) ? $_POST['author'] : null;
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $pub_year = isset($_POST['pub_year']) ? $_POST['pub_year'] : null;
    $genre = isset($_POST['genre']) ? $_POST['genre'] : null;

    if($_POST && ($_POST['genre'] != NULL)){
        $book = new Book($author, $title, $pub_year, $genre);
        $book->saveBook();
    } else {
        $_SESSION['error'] = "Please Fill in ALL Fields";
        header('Location: index.php');
    }



?>