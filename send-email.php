<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Email information
  $to = 'lefa.cloud@hotmail.com'; 
  $headers = "From: $email" . "\r\n" .
             "Reply-To: $email" . "\r\n" .
             "Content-Type: text/html; charset=UTF-8\r\n";

  $body = "<h3>Contact Form Submission</h3>
           <p><strong>Name:</strong> $name</p>
           <p><strong>Email:</strong> $email</p>
           <p><strong>Subject:</strong> $subject</p>
           <p><strong>Message:</strong></p>
           <p>$message</p>";

  if (mail($to, $subject, $body, $headers)) {
    echo 'success';
  } else {
    echo 'error';
  }
}
?>
