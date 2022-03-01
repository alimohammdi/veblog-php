<nav>
      <ul>
            <li><a href="<?= BASE_URL ?>">Home</a></li>
            <li><a href="<?php BASE_URL ?>category.php?category=Motivational">Motivational</a></li>
            <li><a href="<?php BASE_URL ?>category.php?category=sport">Sport</a></li>
            <li><a href="<?php BASE_URL ?>category.php?category=general">General</a></li>

           <?php  if(athenticated()): ?>
            <li ><a style="color: blue;" href="<?php BASE_URL ?>panel.php">panel</a></li>
            <?php else: ?>
            <li ><a style="color: blue;" href="<?php BASE_URL ?>login.php">login</a></li>
            <?php endif ?>
      </ul>
  
      <form action="search.php" method="get">
            <input type="text" name="search" placeholder="Search your book" value="<?= isset($_GET['search'])? $_GET['search'] : '' ?> " >
            <input type="submit" value="Search">
      </form>
</nav>