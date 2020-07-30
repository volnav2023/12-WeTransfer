<html>

<head>
    <title>Saisie</title>
</head>

<body>
    <h1>Bienvenue sur le site de David </h1>
    <h2>Merci de saisir :</h2>
    <form name="saisie" method="post" enctype="multipart/form-data" action="index.php">
        Entrez l''e-mail du destinataire : <input type="text" name="destinataire" /> <br />
        <input name="filesToUpload[]" type="file" size="20" multiple="multiple" />
        <input type="submit" name="valider" value="OK" />
    </form>
</body>

</html>

<?php
// require_once("vendor/autoload.php");
require_once 'vendor/autoload.php';

// echo 'Destinatire : '. $destinataire;

if (isset($_POST['valider'])) {
    $destinataire = $_POST['destinataire'];
    var_dump($destinataire);
    // print_r($destinataire);
    $files = $_FILES['filesToUpload']['name'][2];
    // $files [1] = $_FILES['file[1]'];
    // $files [2] = $_FILES['file[2]'];
    // $files [3] = $_FILES['file[3]'];
    var_dump($_FILES);
    // print_r($_FILES);
    // echo 'Files : ' . $files [1];
    // echo 'Files : ' . $files [2];
    // echo 'Files : ' . $files [3];
}


// Create the Transport
echo 'Create transport';
$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 465))
    ->setUsername('e5b9fdd51104cd')
    ->setPassword('f15b2a565cf13b');

// if ($_SERVER['SERVER_NAME'] == 'localhost') {
//     $transport = (new Swift_SmtpTransport('mailtrap.io', 25))
//         ->setUsername('e5b9fdd51104cd')
//         ->setPassword('f15b2a565cf13b');
// } else {
//     $transport = (new Swift_MailTransport());
// }

// Create the Mailer using your created Transport
echo 'Create mailer';
$mailer = new Swift_Mailer($transport);

// $message = Swift_Message::newInstance('Bienvenue')
// ->setFrom(['contact@flechet.com' => 'flechet.com'])
// ->setTo(['demo@flechet.com'])
// ->setBody('Salut les gens');

// Create a message
echo 'Create message';
$message = (new Swift_Message('Depuis transport mail mailtrap'))
    ->setFrom(['toto@flechet.com' => 'David Flechet'])
    ->setTo(['david@flechet.com', 'other@flechet.com' => 'Autre nom'])
    ->setBody('Here is the message itself');


// Send the message
echo 'Send message';
$result = $mailer->send($message);

// $mailer->send($message);

var_dump($result);

$mail = mail('demo@flechet.com', 'Depuis transport mail php par défaut', 'Body je fais un test', 'From: toto@flechet.com');

if ($mail) {
    echo 'Merci';
} else {
    echo 'Erreur';
}

?>