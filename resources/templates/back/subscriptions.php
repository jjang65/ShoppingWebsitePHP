<script>

    function selectAll() {

    const all_checkbox = document.getElementById('checkbox-all');

        if(all_checkbox.checked == true) {
            var items = document.getElementsByName('checkbox[]');
            for (var i = 0; i < items.length; i++) {
                console.log('for .....;;;');
                if (items[i].type == 'checkbox')
                    items[i].checked = true;
            }
        } else {
            var items = document.getElementsByName('checkbox[]');
            for (var i = 0; i < items.length; i++) {
                if (items[i].type == 'checkbox')
                    items[i].checked = false;
            }
        }
    }

</script>

<?php

require_once("../../resources/config.php");

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Send email to subscribers
if(isset($_POST['send_email'])) {

    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $_ENV['EMAIL'];                                  // SMTP username
    $mail->Password   = $_ENV['PASSWORD'];                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($_ENV['EMAIL'], 'Midist Shopping Site');

    // Adds recipients
    foreach($_POST['checkbox'] as $checkbox) {
        $mail->addAddress($checkbox);
    }

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
    set_message('Email has been sent');
    header("Location: index.php?subscriptions");

    } catch (Exception $e) {
        set_message("Failed to send email");
        header("Location: index.php?subscriptions");
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


// Add a subscription
if(isset($_POST['add_subscription'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "INSERT INTO subscriptions (email) VALUES (:email)";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();

    set_message("New Subscription Added");
    // redirect("index.php?subscriptions");
}


// Display subscriptions
$query_categoreis = "SELECT * FROM subscriptions";
$statement_cats = $db->prepare($query_categoreis);
$statement_cats->execute();
$rows = $statement_cats->fetchAll();


 ?>


<h1 class="page-header">
  Subscriptions
</h1>

<div class="col-md-12">

    <form action="#" method="post">
        <h3>Add subscription</h3>
        <div class="form-group">
            <label for="edit_email">Email</label>
            <input type="text" name="email" class="form-control" id="edit_email">
        </div>

        <div class="form-group">
            <input type="submit" name="add_subscription" class="btn btn-primary" value="Add Subscription">
        </div>
    </form>

    <hr>

</div>

    <form action="#" method="POST">
        <div class="col-md-6">
            <h3>Send Email to subscribers</h3>
            <div class="form-group">
                <label for="email_subject">Subject</label>
                <input type="text" name="subject" class="form-control" id="email_subject">
            </div>
            <div class="email_message">
                <label for="email_message">Message</label>
                <textarea class="form-control" name="message" rows="5" cols="100" id="email_message"></textarea>
            </div>
            <input type="submit" name="send_email" class="btn btn-primary problem" value="Send Email" id="send_email_button">
        </div>

        <div class="col-md-6" id="email_list">
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="checkbox-all" onchange="selectAll()" id="checkbox-all"></th>
                        <th>No</th>
                        <th>Email</th>
                        <th>Activity</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($rows as $row): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?= $row['email'] ?>">
                            </td>
                            <td><?= $row['id'] ?></td>
                            <td><a href="index.php?edit_subscription&id=<?= $row['id'] ?>"><?= $row['email'] ?></a></td>
                            <td><?= $row['is_active'] ?></td>
                            <td><a class="btn btn-info" href="index.php?edit_subscription&id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                            <td><a class="btn btn-danger" href="index.php?delete_subscription_id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </form>



