<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Library Site</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <?php 
        session_start();
        require_once "db_conn.php"; 
        $sql = "SELECT * FROM books";
        $result = $db->query($sql);
    ?>
    <nav>
        <ul>
            <li><a href="#">LOGO</a></li>
        </ul>
    </nav>

    <section id="hero">
        <div class="hero-content">
            <form action="submit.php" method="POST">
                <h2>Upload Book to Database:</h2>

                <p class="<?php if(isset($_SESSION['error'])){
                    echo "error";
                } else if(isset($_SESSION['success'])){
                    echo 'success';
                };?>">
                <?php 
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        $_SESSION['error'] = null;
                    } else if(isset($_SESSION['success'])){
                        echo $_SESSION['success'];
                        $_SESSION['success'] = null;
                    }; 
            
                ?>
                
                <hr>
                <div class="form-group">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" name="author" id="author" class="form-element" value="<?php echo isset($_POST['author']) ? $_POST['author'] : '' ?>" >
                </div>

                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-element" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                </div>

                <div class="form-group">
                    <label for="pub_year" class="form-label">Year Published</label>
                    <input type="text" name="pub_year" id="pub_year" class="form-element" value="<?php echo isset($_POST['pub_year']) ? $_POST['pub_year'] : '' ?>">
                </div>

                <!-- GENRE SELECTION -->
                <div class="form-group">
                    <label for="genre" class="form-label">Choose a genre:</label>
                    <select name="genre" id="genre" class="form-element">
                        <option value="">Select One:</option>
                        <option value="fiction">Fiction</option>
                        <option value="non-fiction">Non-Fiction</option>
                        <option value="biographies">Biographies</option>
                    </select>
                </div>

                <input type="submit" value="Submit" class="btn-primary">
            </form> 
        </div>
    </section>


    <section id="library-container">
        <h2>Available Books (<?php echo $result->num_rows; ?>)</h2>
        <section id="library">

            <?php 
            if(!$result){
                echo "No Books Available At This Time.<br>Please Check Back Later.";
            } else {
            while ($row = $result->fetch_assoc()) { ?>
                <div class="card">
                    <!-- <div class="card-img">
                        <img src="" alt="">
                    </div> -->
                    <div class="card-title">
                        <p><?php echo $row['title']; ?></p>
                        <p><?php echo $row['authorid']; ?></p>
                        <p><?php echo $row['genre']; ?></p>
                        <p><?php echo $row['pub_year']; ?></p>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']?>">
                            <input type="submit" value="Delete" class="btn-danger">
                        </form>
                        
                    </div>
                </div>
                
            <?php } } ?>
        </section>
    </section>

    <footer>
            <p>Copyright &copy <a href="https://www.wyattmarshall.dev" class="footer-link">wyattmarshall.dev</a> 2021</p>
    </footer>

    <?php 
    $result->close();
    $db->close();
    ?>
    
</body>
</html>