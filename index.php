<?php

require_once 'db.php';
$itemQuery=$db->prepare("
SELECT id,name,done
FROM items
WHERE user = user
");
$itemQuery->execute([
   'user' => $_SESSION['user_id']
]);
$items = $itemQuery->rowcount() ? $itemQuery : [];

?>


<!DOCTYPE html>
<html lang="en">
    <head>
<title> To Do </title>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Shadows+Into+ Light+Two" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">  
<meta name="viewport" content="width=device-width,initial-scale=1.0">
    </head>
    <body>
    <div class="list">
       <h1 class="header">To Do.</h1> 
        <?php if(!empty($items)):?>
        <ul class="items">
             <?php foreach($items as $item):?>
            <li> 
             <span class="item<?php echo $item['done'] ? ' done' : '' ?>">
                    <?php echo $item['name']; ?>
                </span>
                <?php if(!$item['done']): ?>
                <a href="mark.php?item=<?php echo $item['id'];?>" class="done_button">  Done</a>
                   <?php endif;?>
                <?php if($item['done']): ?>
                <p> At :<?php echo $item['created'];?> </p>
                <?php endif;?>
            </li>
            
             <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>You dont have any yet. </p>
        <?php endif; ?>
        <form action="add.php" method="post" class="item-add">
            <input type="text" name="name" placeholder="Type a new item here!" autocomplete="off" required class="input">
            <input type="submit" value="Add" class="submit" >
        </form>
        </div>
    </body>
</html>