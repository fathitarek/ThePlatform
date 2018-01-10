<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/codebird.js') }}"></script>
    <script src="{{ asset('js/twitter.js') }}"></script>
    <script>
        $(document).ready(function () {

                    cookie = new Cookie(),
                    requestToken = Twitter.getRequestToken();
            console.log(requestToken);
            Twitter.setAccessToken(requestToken['oauth_token'], requestToken['oauth_token_secret'],function(){
                //window.close();
            });

        });
    </script>
</head>
<body>
<h1>Welcome to Twitter App</h1>
</body>
</html>