Cookie={
    setCookie : function (cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },getCookie : function (cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
};
Twitter={
    twitterKey:'TuX51rRzXt5T3oQQUrvGAcED8',
    twitterSecret:'32hX37K4QrIzKKMxKwfhCas66fsTHhhchnivAqG7O59m0k59xt',
    cb:function(){
        el.cb=new Codebird;
        cb.setConsumerKey(this.twitterKey,this.twitterSecret);
        return cb;
    },
    cookie:Cookie,
    getRequestToken:function(){
        var requestToken = this.cookie.getCookie('reuqestToken').split('&');
        if (requestToken != '') {
            return {
                "oauth_token": requestToken[0],
                "oauth_token_secret": requestToken[1]
            };
        } else {
            return false;
        }
    },Authenticate : function (requestToken) {
        this.cb.setToken(requestToken['oauth_token'], requestToken['oauth_token_secret']);
        this.cb.__call(
            "oauth_authenticate",
            {},
            function (auth_url) {
                window.codebird_auth = location.href = auth_url;
            }
        );
    },isLogin : function () {
        var accessToken = this.getAccessToken();
        if (accessToken != '' && accessToken != 'undefined'&&accessToken.oauth_token!= 'undefined') {
            return accessToken;
        } else {
            return false;
        }
    },getAccessToken : function () {
        var accessToken = this.cookie.getCookie('accessToken').split('&');
        if (accessToken != '') {
            return {
                "oauth_token": accessToken[0],
                "oauth_token_secret": accessToken[1]
            };
        } else {
            return false;
        }
    }
};