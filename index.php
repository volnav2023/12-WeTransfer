<html>

<head>
    <title>Saisie</title>
</head>

<body>
    <h1>Bienvenue sur le site de David </h1>
    <h2>Merci de saisir :</h2>
    <form name="saisie" method="post" enctype="multipart/form-data" action="index.php">
        E-mail du destinataire : <input type="text" name="destinataire" /> <br />
        <input name="filesToUpload[]" type="file" size="20" multiple="multiple" />
        <input type="submit" name="valider" value="OK" />
    </form>
</body>

</html>

<?php

require_once 'vendor/autoload.php';

// READ INPUT FROM FORM
if (isset($_POST['valider'])) {

    $destinataire = $_POST['destinataire'];

    $fileTypes = $_FILES['filesToUpload']['type'];

    echo ('$_FILES[\'filesToUpload\'][\'name\']<br>');
    var_dump($_FILES['filesToUpload']['name']);
    echo ('$_FILES[\'filesToUpload\'][\'tmp_name\']<br>');
    var_dump($_FILES['filesToUpload']['tmp_name']);


    // PREPARE ZIP ARCHIVE
    $zipFile = new ZipArchive();

    if ($zipFile->open('tmpzip.zip', ZipArchive::CREATE) === TRUE) {
        for ($i = 0; $i < count($_FILES['filesToUpload']['name']); $i++) {
            $zipFile->addFile($_FILES['filesToUpload']['tmp_name'][$i], $_FILES['filesToUpload']['name'][$i]);
        }
        $zipFile->close();
        $zip_name = str_replace(' ', '', "zip_for_mail_" . microtime() . ".zip");
        rename('tmpzip.zip', '../upload/' . $zip_name);
        echo 'Zip file créé<br>';
    } else {
        echo 'Zip file non créé<br>';
    }
}

// PREPARE AND SEND E-MAIL
// Create the Transport
echo 'Create transport<br>';
$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 465))
    ->setUsername('e5b9fdd51104cd')
    ->setPassword('f15b2a565cf13b');

// Create the Mailer using your created Transport
echo 'Create mailer<br>';
$mailer = new Swift_Mailer($transport);

// Create a message
$zip_fullname = '"http://localhost/upload/' . $zip_name . '"';
echo 'Create message<br>';
var_dump($zip_fullname);
$message = (new Swift_Message('Depuis transport mail mailtrap'))
    ->setFrom(['toto@flechet.com' => 'David Flechet'])
    ->setTo(['david@flechet.com', 'other@flechet.com' => 'Autre nom'])
    ->setBody(
        <<<EOT
    <html>
    <head></head>
    <body>
    Your files are available : <a download href=$zip_fullname>Upload</a>
    </body>
    </html>
    EOT,
        'text/html'
    );

// Send the message
echo 'Send message<br>';
$result = $mailer->send($message);

// $mailer->send($message);
echo ('$result<br>');
var_dump($result);

?>