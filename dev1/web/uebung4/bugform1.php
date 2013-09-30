<?php
    define('DEBUG',false);
    date_default_timezone_set('Europe/Zurich');


    
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    
    $status = array();
    //data submitted:
    if( isset( $_POST['submit'] ) && $_POST['submit']  === '1' ){
        
        if( $_POST['username'] !== 'testuser' && $_POST['password'] !== 'passw0rd' ){ 
            $status[] = 'Login failed';
        } else {
            if( ! DEBUG ) {
                require_once('recaptcha/recaptchalib.php');
                $privatekey = "6LeS7ecSAAAAACL0XbZPH9sz5c4vipCXoShzvJyX";
                $resp = recaptcha_check_answer ($privatekey,
                                            $_SERVER["REMOTE_ADDR"],
                                            $_POST["recaptcha_challenge_field"],
                                            $_POST["recaptcha_response_field"]);
            }
            if (!DEBUG && !$resp->is_valid) {
                // What happens when the CAPTCHA was entered incorrectly
                $status[] = "The reCAPTCHA wasn't entered correctly. Go back and try it again." .
                     "(reCAPTCHA said: " . $resp->error . ")";
            } else {
                
                $filepath= '';
                if( isset( $_FILES["file"] ) && $_FILES['file']['size'] > 0 ){
                    if ($_FILES["file"]["error"] > 0){
                        $status[] = " fileupload error: " . $_FILES["file"]["error"] . "";
                    } else {
                        if( is_file( '/var/www/web/uebung4/reports/'.basename($_FILES["file"]["name"]) ) ) {
                            $status[] = 'Fileupload failed';
                        } else {
                            $filepath = '/var/www/web/uebung4/reports/'.basename($_FILES["file"]["name"]);
                            move_uploaded_file($_FILES['file']['tmp_name'],$filepath );
                        }
                    }
                  /*echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                  echo "Type: " . $_FILES["file"]["type"] . "<br>";
                  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                  echo "Stored in: " . $_FILES["file"]["tmp_name"];*/
                    
                }
                
                if(empty($_POST['name']) ){
                    $status[] = 'name empty';
                }
                
                //validate email:
                if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $status[] = 'mail not valid';
                }
                
                if(empty($_POST['web']) ){
                    $status[] = 'web empty';
                } else if ( filter_var($_POST['web'], FILTER_VALIDATE_URL) === false ){
                    $status[] = 'url invalid';
                }
                
                if(empty($_POST['text']) ){
                    $status[] = 'text empty';
                }
                
                
                if(empty($_POST['date']) ){
                    $status[] = 'date empty';
                } else {
                    $format = 'Y-m-d';
                    $d = DateTime::createFromFormat($format, $_POST['date']);
                    
                    if( !$d || $d->format($format) != $_POST['date'] )
                        $status[] = 'date format error';
                }
                
                if( count($status) === 0 ){
                    $data = array();
                    $data['name'] = $_POST['name'];
                    $data['text'] = $_POST['text'];
                    $data['submittime'] = @time('H:i:s');
                    $data['submitdate'] = @date('Y.m.d');
                    $data['filepath'] = $filepath;
                    $data['email'] = $_POST['email'];
                    $data['username'] = $_POST['username'];
                    //file_put_contents('reports/Bugreport'.$data['submitdate'].'.'.$data['submittime'].'.txt',serialize($data));

                    require 'PHPMailer-master/class.phpmailer.php';
                    require 'PHPMailer-master/class.smtp.php';

                    $mail = new PHPMailer;

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup server
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    require 'stuff/pwmail.php';          // SMTP password
                    $mail->SMTPSecure = 'tls';    
                    $mail->Port = 587;                        // Enable encryption, 'ssl' also accepted

                    $mail->From = $data['email'];
                    $mail->FromName = $data['name'];
                    $mail->addAddress('yzerman.detroit@bluewin.ch', 'Josh Adams');  // Add a recipient
                    //$mail->addAddress('yzerman.detroit@bluewin.ch');               // Name is optional
                    $mail->addReplyTo('yzerman.detroit@bluewin.ch', 'Information');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                    //$mail->addAttachment(seriali);         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = 'Bug Report';
                    $mail->Body    = $data['text'].$data['submittime'].$data['submitdate'].$data['username'];
                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if(!$mail->send()) {
                       echo 'Message could not be sent.';
                       echo 'Mailer Error: ' . $mail->ErrorInfo;
                       exit;
                    }

                    echo 'Message has been sent';

                    require "dropbox-php-sdk-1.1.1/lib/Dropbox/autoload.php";
                

                    $appInfo = Dropbox\AppInfo::loadFromJsonFile("dropbox_appkey.json");
                    /*
                    $webAuth = new Dropbox\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
                    $authorizeUrl = $webAuth->start();
                    echo "1. Go to: " . $authorizeUrl . "\n";
                    echo "2. Click \"Allow\" (you might have to log in first).\n";
                    echo "3. Copy the authorization code.\n";
                    $authCode = \trim(\readline("Enter the authorization code here: "));

                    list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
print "Access Token: " . $accessToken . "\n";
                    
                        */

                    
                    /*
                    if( is_file( $data['filepath'] ) ) {
                        $f = fopen( $data['filepath'], "rb");
                        $result = $dbxClient->uploadFile( '/patricekeusch/reports/'.$data['submitdate'].'/'.$data['submittime'].'_'. basename($data['filepath']), Dropbox\WriteMode::add(), $f);
                        fclose($f);
                    }
                    */
                   
                    
                    $status[] = 'Bug submitted successfully';
                    $_POST = array();
                }
            }
        }
        
        
        
    }


?><!DOCTYPE html>
<html>
<head>
    <title>Bug Formular</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="javascripts.js"></script>
</head>
<body>
    <?php if( $status ) { ?>
    <div id="state">
        <?php foreach ( $status as $s ) {
            echo $s.'<br/>';
        }; ?>
    </div>
    <?php } ?>
    

    
    <h2>Bitte melde deinen Bug mit diesem Formular</h2>
    
    <form class="form" action="bugform1.php" method="post" enctype="multipart/form-data" onsubmit="return validateValues();">
        <input type="hidden" name="submit" value="1"/>
        <h3>Login</h3>
        
        <input type="text" name="username" placeholder="Username" value="<?php echo @$_POST['username']; ?>" required="required"/>
        <input type="password" name="password" placeholder="Password" value="<?php echo @$_POST['password']; ?>" required="required"/>
        
        <br/>
        
        
        <h3>Bugreport</h3>
        
        <p class="name">
            <input type="text" name="name" id="name" placeholder="Pascal Müller" value="<?php echo @$_POST['name']; ?>" required="required"/>
            <label for="name">Name</label>
        </p>
        
        <p class="email">
            <input type="email" autocomplete="off" name="email" id="email" placeholder="deinemail@provider.ch" value="<?php echo @$_POST['email']; ?>" required="required" />
            <label for="email">Email</label>
        </p>
        
        <p class="web">
            <input type="url" pattern="https?://.+" name="web" id="web" placeholder="http://www.beispiel.ch" required="required" value="<?php echo @$_POST['web']; ?>"/>
            <label for="web">Betreffende Website</label>
        </p>        
    
        <p class="text">
            <textarea name="text" placeholder="Fehlerreport" required="required"/><?php echo @$_POST['text']; ?></textarea>
        </p>
        
        <p>
            <label for="priority">
                Priorität
            </label>
            <input type="range" name="priority" min="1" max="10" required="required" value="<?php echo @$_POST['priority']; ?>"/>
        </p>
        
        <p>
            <label for="bugtype">
                Bugtype
            </label>
            <select name="bugtype" placeholder="Bugtype" required="required">
                <option value="serious_error" <?php echo (@$_POST['bugtype'] === 'serious_error') ? 'selected="selected"' : ''; ?>>serious error</option>
                <option value="regular_error" <?php echo (@$_POST['bugtype'] === 'regular_error') ? 'selected="selected"' : ''; ?>>non serious error</option>
            </select>
        </p>
    
        
        <p>
            <label for="callback">
                Rückruf erforderlich
             </label>
            <input type="checkbox" name="callback" value="1" <?php echo (@$_POST['callback'] === '1') ? 'checked="checked"' : ''; ?>/>
        </p>
        
        <p>
            <label for="reproducable">
                Reproduzierbar
            </label>
            Yes
            <input type="radio" name="reproducable" value="yes" checked="checked" required="required" <?php echo (@$_POST['reproducable'] === 'yes') ? 'checked="checked"' : ''; ?>/>
            No
            <input type="radio" name="reproducable" value="no" required="required" <?php echo (@$_POST['reproducable'] === 'no') ? 'checked="checked"' : ''; ?>/>
        </p>
        
        
        <p>
            <label for="date">
                Datum
            </label>
            <input type="date" name="date" required="required" value="<?php echo @$_POST['date']; ?>"/>
        </p>
        
        
        <p>
            <label for="file">Datei Upload:</label>
            <input type="file" name="file" id="file"><br>
        </p>
            
            
        <?php
        if(! DEBUG ) {
          require_once('recaptcha/recaptchalib.php');
          $publickey = "6LeS7ecSAAAAANBPQAXKplnW4dnn3VEv1VL2b-1J"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        }
        ?>  
            
        <p class="submit">
            <input type="submit" value="Senden" />
        </p>
        
    </form>

</body>
</html>