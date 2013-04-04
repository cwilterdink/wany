<!DOCTYPE html>
<html>

    <?php

    // Enable full-blown error reporting. http://twitter.com/rasmus/status/7448448829
    error_reporting(-1);

    // Set plain text headers
    header("Content-type: text/plain; charset=utf-8");

    // Include the SDK
    require_once './sdk.class.php';

    /*%******************************************************************************************%*/

    $AWS_KEY = 'AKIAJPUZ6RALJQEBGVGA';
    $AWS_SECRET_KEY = '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';
    $sourceEmail = 'nicel1@tcnj.edu';

    $amazonSes = new AmazonSES(array('key' => $AWS_KEY,
                                     'secret' => $AWS_SECRET_KEY));

    $email_list = $amazonSes->list_identities();
    echo 'Get emails: ';
    var_dump($email_list->isOK());

    echo 'List of verified emails: ';

    $email_array = $email_list->body->ListIdentitiesResult->Identities;
    print_r($email_array);



    ?>

    <h4>Please enter the destination email address: </h4>
    <form action="ses.php" method="post">
    Email Address: <input type="text" name="destEmail">
    <input type="submit">
    </form>

    <?php
    $destEmailAddress = $_POST["destEmail"];
    //$amazonSes->verify_email_address($destEmailAddress);

    $autoSubject = 'Hello from SES!';
    $autoBody = 'Greetings ' . $destEmailAddress . ', from Amazon SES!';

    //amazonSesEmail($destEmailAddress, $autoSubject, $autoBody);

    echo get_send_quota();
    echo '<br />';
    echo get_send_statistics();

    ?>

    <h4>Please enter email addresses to copy on your email: </h4>
    <form action="ses.php" method="post">
    CC: <input type="text" name="cc1">
    CC: <input type="text" name="cc2">
    BCC: <input type="text" name="bcc1">
    BCC: <input type="text" name="bcc2">
    <input type="submit">
    </form>

    <?php
    $ccAddress1 = $_POST["cc1"];
    $ccAddress2 = $_POST["cc2"];
    $bccAddress1 = $_POST["bcc1"];
    $bccAddress2 = $_POST["bcc2"];

    amazonSesEmail2($destEmailAddress, $ccAddress1, $ccAddress2, $bccAddress1, $bccAddress2, $autoSubject, $autoBody);

    ?>

    <h4>Please enter email address to be verified: </h4>
    <form action="ses.php" method="post">
    Email Address: <input type="text" name="verEmail">
    <input type="submit">
    </form>

    <?php
    $userVerAddr = $_POST["verEmail"];
    var_dump($amazonSes->verify_email_address($userVerAddr));

    ?>

    <h4>Please enter a verified email address to be deleted: </h4>
    <form action="ses.php" method="post">
    Email Address: <input type="text" name="delEmail">
    <input type="submit">
    </form>

    <?php
    $userDelAddr = $_POST["delEmail"];
    delete_verified_email_address($userDelAddr);
    ?>

</body>

<?php
function amazonSesEmail($address, $subject, $message)
{
    $amazonSes = new AmazonSES($AWS_KEY, $AWS_SECRET_KEY);
 
    $response = $amazonSes->send_email($sourceEmail,
        array('ToAddresses' => array($address),
                'CcAddresses' => array($ccAddr1, $ccAddr2),
                'BccAddresses' => array($bccAddr1, $bccAddr2)),
        array(
            'Subject.Data' => $subject,
            'Body.Text.Data' => $message,
        )
    );
    var_dump($response->isOK());
}

function amazonSesEmail2($address, $ccAddr1, $ccAddr2, $bccAddr1, $bccAddr2, $subject, $message)
{
    $amazonSes = new AmazonSES($AWS_KEY, $AWS_SECRET_KEY);
 
    $response = $amazonSes->send_email($sourceEmail,
        array('ToAddresses' => array($address),
                'CcAddresses' => array($ccAddr1, $ccAddr2),
                'BccAddresses' => array($bccAddr1, $bccAddr2)),
        array(
            'Subject.Data' => $subject,
            'Body.Text.Data' => $message,
        )
    );
    var_dump($response->isOK());
}
?>
</html>