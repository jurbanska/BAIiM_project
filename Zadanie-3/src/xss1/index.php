 <?php
ini_set('display_errors', 'on');

if (isset ($_POST['submit']) && isset ($_POST['user_email'])) {
    $email = $_POST['user_email'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>XSS 1</title>
    <link rel="stylesheet" href="../static/css/bootstrap.min.css" />
</head>
    <body>
        <div id="main">
            <div class="container">
                    <div class="row">
                        <h1>XSS1 <small>Forget Password</small></h1>
                    </div>
                    <div class="row">
                        <p class="lead">
                            Podaj swój adres e-mail<br />
                        </p>
                    </div>
                </div>
            </div>
            <div class="container">

                    <div class="row">
                        <form name="forgetPass" method="post">
                            <div class="form-group col-md-2">
                                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="przykład@email.com" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="submit" class="form-control btn btn-default" name="submit">
                            </div>
                        </form>
                    </div>
		    <?php if (isset ($email) && !empty ($email)): ?>
                        <div class="row">
                            <p style="color:red;" class="well"><strong></strong>Adres <?php echo $email; ?> nie jest zarejestrowany.</p>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="../static/bootstrap.min.js"></script>
    </body>
</html>
<?php
include ("../footer.php");
?>

