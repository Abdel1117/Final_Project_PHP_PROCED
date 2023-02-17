<?php include('../Final_project/View/Template/Header.php') ;
 
 if (!isset($_SESSION['user'])) {
     header('Location: conexion.php');
     exit();
 }
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $title = trim(htmlspecialchars($_POST['title']));
     $category = trim(htmlspecialchars($_POST['category']));
     $image = $_FILES['image'];
     $content = trim(htmlspecialchars($_POST['content']));
 
     $errors = array();
     if (empty($title)) {
         $errors['title'] = 'Titre requis';
     }
     if (empty($category)) {
         $errors['category'] = 'La categorie est requis';
     }
     if ($image['error'] == UPLOAD_ERR_NO_FILE) {
         $errors['image'] = 'Image à insérer';
     } elseif ($image['error'] != UPLOAD_ERR_OK) {
         $errors['image'] = 'Probleme avec l\'image';
     } elseif (!in_array($image['type'], array('image/jpeg', 'image/png'))) {
         $errors['image'] = 'Image ext (dois etre de type JPEG ou PNG)';
     }
     if (empty($content)) {
         $errors['content'] = 'Veuillez ecrire un article';
     }
 
     if (empty($errors)) {
         $articles = json_decode(file_get_contents('articles.json'), true);
         $id = count($articles) + 1;
 
         $filename = 'article_' . $id . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
         move_uploaded_file($image['tmp_name'], 'uploads/' . $filename);
 
         $article = array(
             'id' => $id,
             'title' => $title,
             'category' => $category,
             'image' => $filename,
             'content' => $content,
             'username' => $_SESSION['user'],
             'date' => date('Y-m-d H:i:s')
         );
         $articles[] = $article;
         file_put_contents('articles.json', json_encode($articles));
 
         header('Location: index.php');
         exit();
     }
 }
 
 ?>

<main class="p-5 container min-h-xl">
<h1>Creation d'articles</h1>
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="title" class="form-label" >Titre:</label>
            <input class="form-control" type="text" name="title" id="title" value="<?php echo htmlspecialchars($title ?? ''); ?>">
            <?php if (isset($errors['title'])) { ?>
                <span><?php echo htmlspecialchars($errors['title']); ?></span>
            <?php } ?>
        </div>
        <div>
            <label for="category" class="form-label">Categorie:</label>
            <input class="form-control" type="text" name="category" id="category" value="<?php echo htmlspecialchars($category ?? ''); ?>">
            <?php if (isset($errors['category'])) { ?>
                <span><?php echo htmlspecialchars($errors['category']); ?></span>
            <?php } ?>
        </div>
        <div>
            <label class="form-label" for="image">Image:</label>
            <input class="form-control" type="file" name="image" id="image">
            <?php if (isset($errors['image'])) { ?>

                </span>
        <?php } ?>
    </div>
    <div>
        <label class="form-label" for="content">Article:</label>
        <textarea class="form-control" name="content" id="content"><?php echo htmlspecialchars($content ?? ''); ?></textarea>
        <?php if (isset($errors['content'])) { ?>
            <span><?php echo htmlspecialchars($errors['content']); ?></span>
        <?php } ?>
    </div>
    <button type="submit">Crée Article</button>
</form>

</main>

<?php include('../Final_project/View/Template/Footer.php') ?>