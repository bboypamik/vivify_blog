 <?php
       $servername = "127.0.0.1";
       $username = "root";
       $password = "";
       $dbname ="vivify_posts";

    try {
       $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       // set the PDO error mode to exception
       $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e)
   {
       echo $e->getMessage();
   }
                $postId = $_GET['post_id'];
                // pripremamo upit


                $sql = "SELECT id, title, body, author, created_at FROM posts WHERE id = {$postId}";

                $statement = $connection->prepare($sql);

                // izvrsavamo upit

                $statement->execute();

                // zelimo da se rezultat vrati kao asocijativni niz.

                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita

                $post = $statement->fetch();


 $sql = "SELECT id, Author, Text , post_id FROM comments WHERE post_id = {$postId}";

 $statement = $connection->prepare($sql);

 // izvrsavamo upit

 $statement->execute();

 // zelimo da se rezultat vrati kao asocijativni niz.

 // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz

 $statement->setFetchMode(PDO::FETCH_ASSOC);

 // punimo promenjivu sa rezultatom upita

 $comments = $statement->fetchAll();
// echo "<pre>";
// print_r($comments);
// echo "</pre>";
            ?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

<?php include "header.php";?>

<main role="main" class="container">

    <div class="row">


        <div class="blog-post">
            <a href ="/single-post.php?post_id=<?php echo $post['id']; ?>"><h2 class="blog-post-title"><?php echo $post['title']; ?></h2></a>
            <p class="blog-post-meta"><?php echo $post['created_at']; ?> by <a href="#"><?php echo $post['author']; ?></a></p>

            <p><?php echo $post['body']; ?></p>

            <ul>
                <?php foreach ($comments as $comment) { ?>

                    <li><?php echo $comment['Text']?> by <?php echo $comment['Author']?><hr></li>

                <?php } ?>
            </ul>

        </div><!-- /.blog-post -->


        <?php include "sidebar.php"; ?>

    </div><!-- /.row -->

</main><!-- /.container -->
<?php include "footer.php";?>

</body>
</html>