<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all fields are set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Sanitize inputs
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $message = nl2br(htmlspecialchars(trim($_POST['message']))); // Preserve line breaks in message

        // Validate inputs
        if (!empty($name) && !empty($message)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Email details for the admin
                $to = "lefa.cloud@gmail.com"; // Admin email 
                $subject = "New Contact Form Submission from $name";

                // HTML email body with inline CSS
                $body = "
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f9f9f9;
                            color: #333;
                            line-height: 1.6;
                            margin: 0;
                            padding: 0;
                        }
                        .email-container {
                            max-width: 600px;
                            margin: 20px auto;
                            padding: 20px;
                            background-color: #ffffff;
                            border: 1px solid #ddd;
                            border-radius: 8px;
                        }
                        .email-header {
                            text-align: center;
                            padding: 10px 0;
                            background-color: #007bff;
                            color: white;
                            border-radius: 8px 8px 0 0;
                        }
                        .email-header h1 {
                            margin: 0;
                            font-size: 24px;
                        }
                        .email-body {
                            padding: 20px;
                        }
                        .email-body p {
                            margin: 10px 0;
                        }
                        .email-body .label {
                            font-weight: bold;
                        }
                        .email-footer {
                            text-align: center;
                            margin-top: 20px;
                            font-size: 14px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class='email-container'>
                        <div class='email-header'>
                            <h1>New Contact Form Submission</h1>
                        </div>
                        <div class='email-body'>
                            <p><span class='label'>Name:</span> $name</p>
                            <p><span class='label'>Email:</span> $email</p>
                            <p><span class='label'>Message:</span></p>
                            <p>$message</p>
                        </div>
                        <div class='email-footer'>
                            <p>Thank you for reaching out to us. We'll get back to you As Soon as possible!</p>
                        </div>
                    </div>
                </body>
                </html>";

                // Email headers for the admin
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: $email\r\nReply-To: $email";

                // Attempt to send email to admin
                $mailSent = mail($to, $subject, $body, $headers);

                // Send a thank-you email to the user
                $userSubject = "Thank You for Visiting Hydrorep Solutions";
                /*$userBody = "Dear $name,\n\nThank you for visiting Hydrorep Solutions and reaching out to us. We have received your message and will get back to you As Soon as possible. Please note, this is a no-reply email, so do not reply to this message.\n\nBest regards,\nThe Hydrorep Solutions Team";*/

                $userBody = "Dear $name," . PHP_EOL . PHP_EOL .
            "Thank you for reaching out to us." . PHP_EOL .
            "We have received your message and will respond shortly." . PHP_EOL . PHP_EOL .
            "Best regards," . PHP_EOL .
            "The Hydrorep Solutions Team";



                $userHeaders = "From: lefa.cloud@hotmail.com\r\n";

                // Send the thank-you email to the user
                $thankYouSent = mail($email, $userSubject, $userBody, $userHeaders);

                // Provide feedback to the user on the website
                if ($mailSent && $thankYouSent) {
                    echo '<div class="message success">
                            <strong>Message sent successfully!</strong> Thank you for contacting us.
                            <br><br>
                            <a href="contact.php" class="btn">Go back to the website</a>
                          </div>';
                } else {
                    echo '<div class="message error">
                            <strong>Failed to send your message.</strong> Please try again later.
                            <br><br>
                            <a href="contact.php" class="btn">Go back to the contact form</a>
                          </div>';
                }
            } else {
                echo '<div class="message warning">
                        <strong>Invalid email format.</strong> Please enter a valid email address.
                        <br><br>
                        <a href="contact.php" class="btn">Go back to the contact form</a>
                      </div>';
            }
        } else {
            echo '<div class="message warning">
                    <strong>Invalid input.</strong> Please fill out all fields correctly.
                    <br><br>
                    <a href="contact.php" class="btn">Go back to the contact form</a>
                  </div>';
        }
    } else {
        echo '<div class="message error">
                <strong>Required fields are missing.</strong> Please fill out all required fields.
                <br><br>
                <a href="contact.php" class="btn">Go back to the contact form</a>
              </div>';
    }
} else {
    echo '<div class="message error">
            <strong>Invalid request method.</strong> Please submit the form correctly.
          </div>';
}
?>


<style>
    .message {
        text-align: center;
        margin: 50px;
        padding: 20px;
        border-radius: 8px;
        font-family: 'Arial', sans-serif;
        animation: fadeIn 0.8s ease-out;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .btn {
        text-decoration: none;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    /* Animation for fade-in effect */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Styling for success message */
    .message.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 20px;
        border-radius: 8px;
        font-size: 16px;
    }

    /* Button styling */
    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    /* Button hover effect */
    .btn:hover {
        background-color: #0056b3;
    }
</style>

