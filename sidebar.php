<?php
       $servername = "127.0.0.1";
       $username = "root";
       $password = "vivify";
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
       // pripremamo upit

                $sql = "SELECT id, title, body, author, created_at FROM posts ORDER BY created_at DESC LIMIT 5";

                $statement = $connection->prepare($sql);

                // izvrsavamo upit

                $statement->execute();

                // zelimo da se rezultat vrati kao asocijativni niz.

                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita

                $posts = $statement->fetchAll();
?>

<aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Latest posts</h4>
         <?php foreach ($posts as $post) { ?>
            <div class="blog-post">
           <a href ="single-post.php?post_id= <?php echo $post['id']; ?>"><h2 class="blog-post-title"><?php echo $post['title']; ?></h2></a>
           
<?php } ?>


                
                
            </div>
            <div class="sidebar-module">

            </div>
            <div class="sidebar-module">


            </div>
        </aside>