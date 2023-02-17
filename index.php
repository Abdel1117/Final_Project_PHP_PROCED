<?php


    include('../FINAL_PROJECT/View/Template/Header.php');
    


?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<main class="p-5">
  <section class="row">
<?php
$articles = json_decode(file_get_contents('articles.json'), true);

foreach ($articles as $article) {
    ?>
  <article class="col-4">
    <div class="card p-5">
        <h2><?php echo htmlspecialchars($article['title']); ?></h2>
        <p>Category: <?php echo htmlspecialchars($article['category']); ?></p>
        <img src="uploads/<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
        <p><?php echo htmlspecialchars(substr($article['content'],0, 150));  ?>...</p>
        <p>By <?php echo htmlspecialchars($article['username']['pseudo']); ?> on <?php echo htmlspecialchars($article['date']); ?></p>
    </div>
</article>
    <?php
}
?>
</section >


</main>


<?php include('../Final_project/View/Template/Footer.php') ;?>
</html>