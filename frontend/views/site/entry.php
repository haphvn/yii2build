<?php
/**
 * Created by PhpStorm.
 * User: Ha Pham
 * Date: 10/08/2015
 * Time: 4:15 CH
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

?>
<?php //$form = ActiveForm::begin(); ?>
<!---->
<? //= $form->field($model, 'name') ?>
<!---->
<? //= $form->field($model, 'email') ?>
<!---->
<!--<div class="form-group">-->
<!--    --><? //= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<!--</div>-->
<!---->
<?php //ActiveForm::end(); ?>


<?php
$mailboxPath = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'haph.vsi@gmail.com';
$password = 'haph1187';
$imap = imap_open($mailboxPath, $username, $password);

$folders = imap_list($imap, "{imap.gmail.com:993/imap/ssl}", "*");
echo "<ul>";
foreach ($folders as $folder) {
    $folder = str_replace("{imap.gmail.com:993/imap/ssl}", "", imap_utf7_decode($folder));
    echo '<li><a href="mail.php?folder=' . $folder . '&func=view">' . $folder . '</a></li>';
}
echo "</ul>";


$numMessages = imap_num_msg($imap);
for ($i = $numMessages; $i > ($numMessages - 20); $i--) {
    $header = imap_header($imap, $i);
    echo '<pre>'; print_r($header);

    $fromInfo = $header->from[0];
    $replyInfo = $header->reply_to[0];

    $details = array(
        "fromAddr" => (isset($fromInfo->mailbox) && isset($fromInfo->host))
            ? $fromInfo->mailbox . "@" . $fromInfo->host : "",
        "fromName" => (isset($fromInfo->personal))
            ? $fromInfo->personal : "",
        "replyAddr" => (isset($replyInfo->mailbox) && isset($replyInfo->host))
            ? $replyInfo->mailbox . "@" . $replyInfo->host : "",
        "replyName" => (isset($replyTo->personal))
            ? $replyto->personal : "",
        "subject" => (isset($header->subject))
            ? $header->subject : "",
        "udate" => (isset($header->udate))
            ? $header->udate : ""
    );

    $uid = imap_uid($imap, $i);

    echo "<ul>";
    echo "<li><strong>From:</strong>" . $details["fromName"];
    echo " " . $details["fromAddr"] . "</li>";
    echo "<li><strong>Subject:</strong> " . $details["subject"] . "</li>";
    echo '<li><a href="mail.php?folder=' . $folder . '&uid=' . $uid . '&func=read">Read</a>';
    echo " | ";
    echo '<a href="mail.php?folder=' . $folder . '&uid=' . $uid . '&func=delete">Delete</a></li>';
    echo "</ul>";
} die;
?>
