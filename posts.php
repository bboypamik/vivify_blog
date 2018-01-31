
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

                    echo '<pre>';

                    var_dump($posts);

                    echo '</pre>';

            ?>

              

                <?php include "sidebar.php"; ?>
       <?php include "footer.php";?> 