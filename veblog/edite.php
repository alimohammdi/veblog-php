<?php 

require("./functions.php");

if(! athenticated()){
      redirect('login.php');
}

if(! isset($_GET['id'])){
      redirect('panel.php');
}

$id = $_GET['id'];
$posts = get_data('post');

$post = get_post_by_id($posts,$id);
if(is_null($post)){
      redirect('panel.php');
}

$user =get_user_data();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        $title    = $_POST['title'];
        $content  = $_POST['content'];
        $category = $_POST['category'];
        $image    = $_FILES['image'];
        $errors   = validate_edite_post($title,$content,$category,$image);

        if(! count($errors) ){
            $posts = get_data('post');
              edite_post($posts,$id,$title,$content,$category,$image);
              redirect('panel.php');

        }

}





?>






<html>
    <head>
    <head>
        <title>Panel</title>

        <link rel="stylesheet" href="<?= assets('CSS/style.css') ?>">
        <link rel="stylesheet" href="<?= assets('CSS/panel.css') ?>">
    </head>
    </head>
    <body>
        <main>
            <nav style="color: blue;">
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
                        <input type="text" name="title" id="title" value="<?= $post['title'] ?>">
                    </div>
                    <div>
                        <label for="category">Category</label>
                        <select name="category" id="category">
                            <option value="political" <?= ($post['category'] == 'political')? 'selected' : '' ?>>Political</option>
                            <option value="sport" <?= ($post['category'] == 'sport')? 'selected' : '' ?>>Sport</option>
                            <option value="social" <?= ($post['category'] == 'social')? 'selected' : '' ?>>Social</option>
                        </select>
                    </div>
                    <div>
                        <label for="content">Content</label>
                        <textarea name="content" id="content" cols="30" rows="10"><?= $post['content'] ?></textarea>
                    </div>
                    <div>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                        <img src="<?= assets($post['image']) ?>" alt="">
                    </div>
                    <div>
                        <input type="submit" value="Edite post">
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>