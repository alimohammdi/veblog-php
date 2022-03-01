<aside >
          <div id="asidbox">
               <h2>Top books</h2>
                <?php if($top_post  != null): ?>
                  <ul> 
                        <?php foreach($top_post as $item):  ?>
                        <li><a href="single.php?post=<?= $item['id'] ?>"><?= "- ". $item['title'] ?> <small>(<?= $item['view'] ?>  view)</small> </a></li> 
                        <?php endforeach ?>
                  </ul> 
                <?php endif ?>
       
      </div>
      <?php if($last_post != null): ?>
      <div id="asidbox">
            <h2>last books</h2>
      <ul>
            <?php foreach($last_post as $item): ?>
            <li><a href="single.php?post=<?= $item['id'] ?>"><?= "- ". $item['title'] ?> </small></a></li> 
            <?php endforeach ?>
      </ul>
      </div>
      <?php endif ?>
      
</aside>