
<?php
echo'
	<form method="post" action="php/sendmail.php">
        
    <label>Name</label>
    <input name="name" placeholder="Type Here">
            
    <label>Email</label>
    <input name="email" type="email" placeholder="Type Here">
            
    <label>Message</label>
    <textarea name="message" placeholder="Type Here"></textarea>
	<label>*What is 2+2? (Anti-spam)</label>
	<input name="human" placeholder="Type Here">
            
    <input id="submit" name="submit" type="submit" value="Submit">
        
	</form>'

?>