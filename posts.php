
   <?php
       $servername = "127.0.0.1";
       $username = "root";
       $password = "root";
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

                $sql = "SELECT id, title, body, author, created_at FROM posts ORDER BY created_at DESC LIMIT 3";

                $statement = $connection->prepare($sql);

                // izvrsavamo upit

                $statement->execute();

                // zelimo da se rezultat vrati kao asocijativni niz.

                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita

                $posts = $statement->fetchAll();

                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive

//                    echo '<pre>';
//
//                    //var_dump($posts);
//
//                    echo '</pre>';



                    foreach ($posts as $post){
//                        echo '<pre>';
//                        //print_r($post);
//                        echo '</pre>';


                       // echo $post['title'];
                    }

            ?>

   <div class="col-sm-8 blog-main">





<?php foreach ($posts as $post): ?>
            <div class="blog-post">
           <a href =""><h2 class="blog-post-title"><?php echo $post['title']; ?></h2></a>
           <p class="blog-post-meta"><?php echo $post['created_at']; ?> by <a href="#"><?php echo $post['author']; ?></a></p>

           <p><?php echo $post['body']; ?></p>
       </div><!-- /.blog-post -->
<?php endforeach; ?>


       <nav class="blog-pagination">
           <a class="btn btn-outline-primary" href="#">Older</a>
           <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
       </nav>

   </div><!-- /.blog-main -->
