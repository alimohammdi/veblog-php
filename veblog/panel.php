<?php 

require("./functions.php");


if(!athenticated()){
      redirect('login.php');
}

$posts = get_data('post');
$user = get_user_data();

?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="<?= assets('CSS/style.css') ?>">
      <link rel="stylesheet" href="<?= assets('CSS/panel.css') ?>">
</head>
<body>
      <main>
            <nav  class = "panelnav"  style="color: blue;">
                <ul>
                    <li><a href="<?= BASE_URL ?>index.php">Home</a></li>
                    <!-- <li><a href="<?= BASE_URL ?>panel.php">Panel</a></li> -->
                    <li><a href="<?= BASE_URL ?>create.php">Create post</a></li>
                    <li><a  style="color: blue;" href="<?= BASE_URL ?>logout.php">Logout</a></li>
                </ul>
                <ul>
                    <li><?= $user['firstname'] . ' ' . $user['lastname'] ?></li>
                </ul>
            </nav>
            <section class="content">
                <?php if($posts): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>View</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($posts as $post): ?>
                                <tr>
                                    <td><?= $post['id'] ?></td>
                                    <td><?= $post['title'] ?></td>
                                    <td><?= $post['category'] ?></td>
                                    <td><?= $post['view'] ?> view</td>
                                    <td><?= date('Y M d', strtotime($post['date'])) ?></td>
                                    <td>
                                        <a href="./edite.php?id=<?= $post['id'] ?>">Edit</a>
                                        <a href="./delete.php?id=<?= $post['id'] ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div>
                        Does not exist any data.
                    </div>
                <?php endif ?>
            </section>
      </main>
</body>
</html>