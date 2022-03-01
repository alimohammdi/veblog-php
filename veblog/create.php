<?php 

require("./functions.php");
if(! athenticated()){
    redirect('login.php');
}

$user = get_user_data();



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = [];
     $title = $_POST['title'];
     $category = $_POST['category'];
     $content = $_POST['content'];
     $posts = get_data('post');
     $image = $_FILES['image'];
 

    $errors =  validate_post($title,$content,$category,$image);

    if (! count($errors)){
      create_post($posts,$title,$content,$category,$image);
      redirect('panel.php');
      
    }
}


?>

<html>
    <head>
    <head>
        <title>Panel</title>

        <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
        <link rel="stylesheet" href="<?= assets('css/panel.css') ?>">
    </head>
    </head>
    <body>
        <main>
            <nav  style="color: blue;">
                <ul>
                    <li><a href="<?= BASE_URL ?>index.php">Home</a></li>
                    <li><a href="<?= BASE_URL ?>panel.php">Panel</a></li>
                    <!-- <li><a href="<?= BASE_URL ?>create.php">Create post</a></li> -->
                    <li><a href="<?= BASE_URL ?>logout.php">Logout</a></li>
                </ul>
                <ul>
                    <li><?= $user['firstname'] . ' ' . $user['lastname'] ?></li>
                </ul>
            </nav>
            <section class="content">
                        <?php  if(isset($errors) and count($errors)): ?>
                    <div class="errors">
                        <ul>
                            <?php foreach($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach?>
                        </ul>
                    </div>
                            <?php endif ?>
                <form method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="<?= isset($title)? $title : ''?>">
                    </div>
                    <div>
                        <label for="category">Category</label>
                        <select name="category" id="category">
                            <option value="political" <?= (isset($category) and $category == 'political')? 'selected' : '' ?>>Political</option>
                            <option value="sport" <?= (isset($category) and $category == 'sport')? 'selected' : '' ?>>Sport</option>
                            <option value="social" <?= (isset($category) and $category == 'social')? 'selected' : '' ?>>Social</option>
                        </select>
                    </div>
                    <div>
                        <label for="content">Content</label>
                        <textarea name="content" id="content" cols="30" rows="10"><?= isset($content)? $content : ''?></textarea>
                    </div>
                    <div>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <div>
                        <input type="submit" value="create post">
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>