<td>
    <form class="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <p class="todo">
           <input type="text" name="text" class="todo" value="<?php echo $todo['text']; ?>" required />
         
           <input type="hidden" name="id" value="<?php echo $todo['id']; ?>" />
           <input class="btn btn-default" type="submit" value="Beschreibung ändern" />
       </p>
   </form>
</td>