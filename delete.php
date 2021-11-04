<?php

require_once "db_conn.php";

if(isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM books WHERE id={$id}";
    $db->query($sql);

    if(!$db){
        echo "Error Deleting Record";
    } else {
        header("Location: index.php");
    }
}


?>