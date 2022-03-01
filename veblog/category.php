<?php 

require ("./functions.php");

if(!isset($_GET['category'])){
      redirect('index.php');
}

$category = $_GET['category'];
$post_dbs = get_data('post');
 
$set_dbs = get_data('setting');

$top_post = get_post_orderby_viwe($post_dbs);
$last_post = get_post_orderby_date($post_dbs);

$category_post = get_post_by_category($post_dbs,$category);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="keyword" content='<?= $set_dbs['keywords'] ?>'>
      <meta name="description" content="<?= $set_dbs['description'] ?>">
      <meta name="auther" content="<?= $set_dbs['author'] ?>">
      
      <title><?= $set_dbs['title'] ?></title>
      <link rel="stylesheet" href="<?=  assets("CSS/style.css") ?>">
</head>
<body>
      <main>
           <?php require('./parts/header.php') ?>
           <?php require('./parts/navar.php') ?>
            <section id="session">
               <?php require('./parts/sidbar.php') ?>
               <?php  if ($category_post): ?>
                        <div class="content">
                              <?php  foreach($category_post as $post): ?>

                                    <article>
                                          <div class="ception">
                                                <h3> <?= $post['title'] ?></h3>
                                                <h4>writer : <?= $post['writer'] ?></h4>
                                                            <ul>
                                                                  <li> date : <span><?= date(' Y  M  d ' ,strtotime($post['date'])) ?></span> </li>
                                                                   <li>View : <?= $post['view'] ?></li>
                                                            </ul>
                                                <p><?= get_excerpt($post['content']) ?></p>
                                                <a href="single.php?post=<?= $post['id'] ?>">More...</a>
                  
                                          </div>
                                          <div class="image">
                                                <img src="<?=  assets($post['image']) ?> " alt=<?= $post['title'] ?>>
                                          </div>
                                          <div class="clearfix"></div>
                                    </article>
                              <?php endforeach?>
                              <?php else: ?>
                                    <div class="content">
                                          Dose't any post...
                                    </div>
                              <?php endif ?>
                        </div>
                 
                  
            </section>
            <div class="clearfix"></div>

            <?php require('./parts/footer.php') ?>
      </main>
</body>
</html>
