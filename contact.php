<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=fire">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/form/contact.css">

</head>

<body>
    <header>
        <h1>Contact us</h1>
    </header>
    <div id="form" class="">

        <div class="fish" id="fish"></div>
        <div class="fish" id="fish2"></div>

        <form id="waterform" method="post" class="" action="">

            <div class="formgroup" id="name-form">
                <label for="name">Your name*</label>
                <div class="input-img">
                    <input type="text" id="name" name="name" class="name" placeholder="Enter your name..." />
                    <img src="" class="error-img" alt="">
                </div>
                <p style="color:red;" class="error-message"></p>
            </div>
            
            <div class="formgroup" id="email-form">
                <label for="email">Your e-mail*</label>
                <div class="input-img">
                    <input type="email" id="email" name="email" class="email" placeholder="Enter your email..." />
                    <img src="" class="error-img" alt="">
                </div>
                <p style="color:red;" class="error-message"></p>
            </div>

            <div class="formgroup" id="subject-form">
                <label for="subject">Your subject</label>
                <div class="input-img">
                    <input type="text" id="subject" name="subject" class="subject" placeholder="Enter your subject..." />
                    <img src="" class="error-img" alt="">
                </div>
                <p style="color:red;" class="error-message"></p>
            </div>

            <div class="formgroup" id="message-form">
                <label for="message">Your message</label>
                <div class="input-img">
                    <textarea id="message" name="message" class="message"></textarea>
                    <img src="" class="error-img" alt="">
                </div>
                <p style="color:red;" class="error-message"></p>
            </div>

            <input type="submit" name ="save" value="Send your message!" required/>
        </form>
    </div>
    <script language="javascript" src="./javascript/contact.js"></script>
</body>
</html>