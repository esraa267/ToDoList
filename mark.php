<?php

require_once 'db.php';

if(isset($_GET['item'])){

    $item=$_GET['item'];
 
            $doneQuery=$db->prepare("
            UPDATE items
            SET done =1
            WHERE id = :item
            AND user = :user
            ");
            $doneQuery->execute([
                'item'=>$item,
                'user'=>$_SESSION['user_id']
            ]);
         
         
    
}
header ('Location: index.php');