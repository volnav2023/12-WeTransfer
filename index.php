<?php
// require_once("vendor/autoload.php");
require_once 'vendor/autoload.php';
?>

<html>
    <head><title>Saisie</title></head>
    <body>
        <h1>Bienvenue sur le site de David </h1>
        <h2>Merci de saisir :</h2>
        <form name="saisie" method="post" action="index.php">
            Entrez l''e-mail du destinataire : <input type="text" name="destinataire"/> <br/>
        <input type="submit" name="valider" value="OK"/>
        </form>
    </body>
</html>

<?php

echo 'Destinatire : '. $destinataire;

if(isset($_POST['valider'])){
    $destinataire=$_POST['destinataire'];
    echo 'Destinatire : '. $destinataire;
}
?>

<!-- 




// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 25))
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
$mailer = new Swift_Mailer($transport);

// $message = Swift_Message::newInstance('Bienvenue')
// ->setFrom(['contact@flechet.com' => 'flechet.com'])
// ->setTo(['demo@flechet.com'])
// ->setBody('Salut les gens');

// Create a message
$message = (new Swift_Message('Depuis transport mail mailtrap'))
    ->setFrom(['toto@flechet.com' => 'David Flechet'])
    ->setTo(['david@flechet.com', 'other@flechet.com' => 'Autre nom'])
    ->setBody('Here is the message itself');


// Send the message
$result = $mailer->send($message);

// $mailer->send($message);

var_dump($result);

$mail = mail('demo@flechet.com', 'Depuis transport mail php par défaut', 'Body je fais un test', 'From: toto@flechet.com');

if ($mail) {
    echo 'Merci';
} else {
    echo 'Erreur';
} -->
