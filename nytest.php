<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "kruse@demommd.dk";
    $email_subject = "Besked fra kunde";

    function problem($error)
    {
        echo "Belager - det ser ud til, at der er sket en fejl. ";
        echo "En fejl opstod.<br><br>";
        echo $error . "<br><br>";
        echo "Gå tilbage til forsiden.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Beklager - det ser ud til, at der er sket en fejl.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Emailadressen ser ikke ud til at være gyldig.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Ugyldigt navn.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Ups, noget gik galt - prøv igen.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

		// create email headers
	    $headers = 'From: ' . $email . "\r\n" .
	        'Reply-To: ' . $email . "\r\n" ;
	        'X-Mailer: PHP/' . phpversion().
	    @mail($email_to, $email_subject, $email_message, $headers);

		mail($email_to, $email_subject, $email_message, $headers);}
?>

    <!-- include your success message below -->
<style media="screen">

body{
  text-align: center;
  background-image: url("baggrund.png");
  background-size: cover;
  background-repeat: no-repeat;
}
  b{
    margin-bottom: -10px;
    text-align: center;
    font-family: "Montserrat", sans-serif;
    font-weight: 900;
    font-size: 2rem;
text-transform: capitalize;
  }
  .logo{
    height: auto;
    width: 19%;

  }
</style>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <b><br /><br /><br />TAK FOR DIN BESKED - <br />VI VENDER TILBAGE SNAREST...</b><br />
    <img class="logo" src="logo.png" alt="logo">
    <form action="https://www.demommd.dk">

      <input class="forsideknap" value="Tilbage til forsiden" type="submit" style="text-align: center;
      background-color: #cdb576;
      color: #000;
      width: 15%;
      border-radius: 0.3rem; padding: 0.7rem 1rem; font-size: 1.25rem; line-height: 1.5rem; border-width: 0px; margin-bottom: 10px; margin-left: auto; margin-right: auto;" class="forsideknap">
    </form>
  </body>
</html>

<?php

?>
