<?php
// echo xdebug_info();
// echo getenv('USERNAME');

require_once "modules/Mail.php";

function sendMail($to, $subject, $body)
{
    $mail = new SendMail(
        $to,
        $subject,
        $body
    );
    return $mail->send();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header("HTTP/1.1 200 OK");

    $post_data = new stdClass();
    $post_data->to = $_POST['email'];
    $post_data->subject = $_POST['subject'];
    $post_data->body = $_POST['message'];
    $post_data->from = "Lorenzo Fornara";

    try {
        $result = sendMail($to = $post_data->to, $subject = $post_data->subject, $body = $post_data->body);
        echo $result;
        
    } catch (Exception $e) {
        echo $e;
    }

}

var_dump($_POST);