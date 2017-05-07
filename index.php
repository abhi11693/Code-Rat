<?php

session_start();
require_once("php/class.user.php");
$hindi = new USER();

if(isset($_POST['btnSubmit'])) /* Insert Message into Table*/
	{
            $message = mysql_real_escape_string($_POST['txtMessage']);		
            $message = trim($message);
            $stmt = $hindi->runQuery("INSERT into fhindi (id,message)values(:id,:message)");
			$stmt->execute(array(":id"=>'NULL',":message"=>$message));
			?>
        <script type="text/javascript">
        alert("Message Inserted Successfully...!!!");
        window.location.href = "index.php";
        </script>
    <?php
    }

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Type in Hindi</title>
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">
                // Load the Google Transliterate API
                google.load("elements", "1", {
                    packages: "transliteration"
                });

                function onLoad() {
                    var options = {
                        sourceLanguage: google.elements.transliteration.LanguageCode.ENGLISH,
                        destinationLanguage: [google.elements.transliteration.LanguageCode.HINDI],
                        shortcutKey: 'ctrl+h',
                        transliterationEnabled: true
                    };

                    // Create an instance on TransliterationControl with the required
                    // options.
                    var control =
                        new google.elements.transliteration.TransliterationControl(options);

                    // Enable transliteration in the textbox with id
                    // 'transliterateTextarea'.
                    control.makeTransliteratable(['transliterateTextarea']);
                }
                google.setOnLoadCallback(onLoad);
            </script>
        </head>

        <body>
            <div class="col-lg-offset-3 col-lg-6">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <legend>TYPE IN HINDI</legend>


                        <div class="form-group">
                            <label for="textArea" class="col-lg-2 control-label">Message</label>
                            <div class="col-lg-10">
                                <textarea id="transliterateTextarea" class="form-control" rows="3" name="txtMessage"></textarea>
                                <span>Type in Hindi (Press Ctrl+h to toggle between English and Hindi)</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Message</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                    $stmt = $hindi->runQuery("SELECT id,message FROM fhindi");
                    $stmt->execute();
                    $num_rows = 0;
                    while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $num_rows++;
                        $id = $userRow['id'];
                        $message = $userRow['message'];
                   
                            ?>
                            <tr class="success">
                                <td>
                                    <?php echo $id;?>
                                </td>
                                <td>
                                    <?php echo $message;?>
                                </td>

                            </tr>
                            <?php
                                  }
                    ?>
                    </tbody>
                </table>
            </div>

        </body>

        </html>