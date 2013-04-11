<!DOCTYPE html>
<html>
    <head>
        <title>WANY</title>

        <link rel="stylesheet" type="text/css" media="all" href="main.css" />
    </head>


    <body>

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


            $fname = $_POST["firstname"];
            $lname = $_POST["lastname"];
            $destEmailAddress = $_POST["email"];
            $pw1 = $_POST["password"];
            $pw2 = $_POST["reenter"];

            if($pw1 !== $pw2) {
                echo 'The two password entries do not match.<br>';
                echo '<a href="createAccount.php">Go back</a>';
            }
            else {
                echo 'Thank you for signing up! A confirmation email has been sent to you.<br>';
                echo '<a href="index.php">Home</a>';

                $autoSubject = "Hello from WANY!";
                $autoBody = "Greetings ";// . $fname . ' ' . $lname . ', from WANY!';


                $emailsend = $amazonSes->send_email(
                $sourceEmail, // Source (aka From)
                    array('ToAddresses' => array( // Destination (aka To)
                        $destEmailAddress
                    )),
                    array( // Message (short form)
                        'Subject.Data' => $autoSubject,
                        'Body.Text.Data' => $autoBody
                    )
                );

            }
        ?>

    </body>
</html>