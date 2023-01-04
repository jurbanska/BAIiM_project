<?php
ini_set('display_errors', 'on');

if (isset ($_POST['submit']) && isset ($_POST['user_email'])) {
    $email = $_POST['user_email'];
}
function xss_check_1($data)
{
    // Zamienia "<" i ">" na jednostki HTML
    $input = str_replace("script", "", $data);
    // Omija podwójne kodowanie
    // <script>alert(0)</script>
    // %3Cscript%3Ealert%280%29%3C%2Fscript%3E
    // %253Cscript%253Ealert%25280%2529%253C%252Fscript%253E
    $input = urldecode($input);
    return $input;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>XSS 4</title>
    <link rel="stylesheet" href="../static/css/bootstrap.min.css" />
</head>
<body>
<div id="main">
    <div class="container">
        <div class="row">
            <h1>XSS4 <small>Try to secure</small></h1>
        </div>
        <div class="row">
            <p class="lead">
                Chyba naprawiliśmy podatności XSS, spróbuj teraz wykorzystać &lt;script&gt; <br />
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
            <p style="color:red;" class="well"><strong></strong>Adres <?php echo xss_check_1($email); ?> nie jest zarejestrowany.</p>
            </p>
        </div>
    <?php endif; ?>
</div>
<script type="text/javascript" src="../static/bootstrap.min.js"></script>
</body>
</html>
<?php
include ("../footer.php");
?>
