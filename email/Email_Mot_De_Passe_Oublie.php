<?php
    $headers ='From: Test Riasec Polytech <contact@testriasec.fr>'."\n";
    $headers .='Reply-To: contact@testriasec.fr'."\n";
    $headers .='Content-Type: text/html; charset="UTF-8"'."\n";
    $headers .='Content-Transfer-Encoding: 8bit';
    $message =' <html>
      <head>
       <title>Riasec : Reinitialisation du mode de passe</title>
      </head>
      <body>
      <h3>Riasec : Reinitialisation du mode de passe </h3>

      <p> Vous avez demandé une reinitialisation de mot de passe, merci de cliquer sur le lien suivant pour acceder au formulaire : </p>

      <a href="http://testriasec.fr/Changement_Mot_De_Passe.php?code='.$cookie.'">Modifier mon mot de passe</a>

      
      </body>
     </html>';


    mail($mail, 'Riasec : Reinitialisation du mode de passe',$message, $headers); 
?>