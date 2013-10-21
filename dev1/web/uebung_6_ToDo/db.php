<?

$db = new PDO('mysql:host=localhost;dbname=tasks', 'root', 'vagrant');


$insert = $db->prepare('INSERT INTO tasks.todo 
                     (id, done, text)
                     VALUES 
                     (NULL, false, :text)');

$delete = $db->prepare('DELETE FROM tasks.todo 
                        WHERE todo.id = :id');

$updateDone = $db->prepare('UPDATE  tasks.todo 
                        SET  done =  :status 
                        WHERE  todo.id = :id');

$updateText = $db->prepare('UPDATE  tasks.todo 
                        SET  text = :text 
                        WHERE  todo.id = :id');

?>