/**
 * Cookie Class.
 */

function Cookie() {
}
Cookie.prototype.setCookie = function (cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

Cookie.prototype.getCookie = function (cname) {
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

Cookie.prototype.checkCookie = function (cname) {
    var cookie = this.getCookie(cname);
    if (cookie != "") {
        return true;
    } else {
        return false;
    }
}
/*==================================================================================*/

function convertURLToBase64(url,fun){
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
            fun(reader.result.split(';base64,')[1]);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
}
/*
 * Twitter Class
 */
function Twitter() {
    this.cb = new Codebird;
    //this.cb.setConsumerKey("yxJT9ZF0kuBlpa8pwyxhWDg9l", "yE2Sga2REu0YMx51kKmEKwDjWOzo3TE0A3N8eBJXIYHWiB49tv");
    this.cb.setConsumerKey("TuX51rRzXt5T3oQQUrvGAcED8", "32hX37K4QrIzKKMxKwfhCas66fsTHhhchnivAqG7O59m0k59xt");
    this.cookie = new Cookie();
}

/*
 * gets a request token
 */
Twitter.prototype.setRequestToken = function (fun) {
    this.cb.__call(
        "oauth_requestToken",
        {oauth_callback: URL + '/twitter/jsCallback'},
        function (reply, rate, err) {
            if (err) {
                console.log("error response or timeout exceeded" + err.error);
            }
            if (reply) {
                var d = new Date();
                d.setTime(d.getTime() + (0.01 * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = 'reuqestToken' + "=" + reply.oauth_token + '&' + reply.oauth_token_secret + ";" + expires + ";path=/";
                fun(reply)
            }
        }
    );
}

Twitter.prototype.getRequestToken = function () {
    var requestToken = this.cookie.getCookie('reuqestToken').split('&');
    if (requestToken != '') {
        return {
            "oauth_token": requestToken[0],
            "oauth_token_secret": requestToken[1]
        };
    } else {
        return false;
    }
}

/*
 *gets the authorize screen URL
 */
Twitter.prototype.Authenticate = function (requestToken,fun) {
    el=this;
    el.cb.setToken(requestToken['oauth_token'], requestToken['oauth_token_secret']);
    el.cb.__call(
        "oauth_authenticate",
        {},
        function (auth_url) {
            //console.log(auth_url)
            window.codebird_auth =auth_url;
            var twitterWindow=window.open(auth_url, "_blank", "width=600,height=500");
            var timer = setInterval(function(){
                if(twitterWindow.closed){
                    console.log("Child window closed");
                    if(el.isLogin()){
                        fun('authenticate')
                        //console.log('authintcated')
                    }else{
                        fun('unAuthenticate')
                        //console.log('unauthintcated')
                    }
                    clearInterval(timer);
                }
            }, 500);
            //window.codebird_auth = location.href = auth_url;
        }
    );
};
Twitter.prototype.AuthenticateURL = function () {
    el=this;
    el.cb.__call(
        "oauth_requestToken",
        {oauth_callback: "http://localhost/theplatform/public/twitter/jsCallback"},
        function (reply) {
            // store it
            requestToken = reply.oauth_token;
            requestTokenSecret = reply.oauth_token_secret;
            el.cb.setToken(requestToken, requestTokenSecret);
            //console.log(requestToken);
            el.cb.__call(
                "oauth_authorize",
                {},
                function (auth_url) {
                    //console.log(auth_url);
                    //is the code example suppose to go here????


                }
            );
        }
    );
};

Twitter.prototype.setAccessToken = function (oauth_token, oauth_token_secret, fun) {
    var current_url = location.toString();
    if(current_url.match(/\?(.+)$/)==null){var query=0;}else{var query = current_url.match(/\?(.+)$/).toString().split("&");}
    //var query = current_url.match(/\?(.+)$/).toString().split("&");
    var parameters = {};
    var parameter;
    for (var i = 0; i < query.length; i++) {
        parameter = query[i].split("=");
        if (parameter.length === 1) {
            parameter[1] = "";
        }
        parameters[decodeURIComponent(parameter[0])] = decodeURIComponent(parameter[1]);
    }

    // check if oauth_verifier is set
    if (typeof parameters.oauth_verifier !== "undefined") {
        // assign stored request token parameters to codebird here
        // ...
        this.cb.setToken(oauth_token, oauth_token_secret);
        //console.log(parameters.oauth_verifier);
        this.cb.__call(
            "oauth_accessToken",
            {
                oauth_verifier: parameters.oauth_verifier
            },
            function (reply, rate, err) {
                if (err) {
                    console.log("error response or timeout exceeded" + err.error);
                }
                if (reply) {
                    //console.log(reply);
                    var d = new Date();
                    d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
                    var expires = "expires=" + d.toUTCString();
                    document.cookie = 'accessToken' + "=" + reply.oauth_token + '&' + reply.oauth_token_secret + ";" + expires + ";path=/";
                    fun(reply);
                    //location.href = redirectUrl;
                }
            }
        );
    }
}

Twitter.prototype.getAccessToken = function () {
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

Twitter.prototype.isAuthorized = function () {
    if (this.getAccessToken() != false) {
        return true;
    } else {
        return false;
    }
}

Twitter.prototype.initializeCodeBird = function (accessToken) {
    this.cb.setToken(accessToken['oauth_token'], accessToken['oauth_token_secret']);
}

Twitter.prototype.isLogin = function () {
    var accessToken = this.getAccessToken();
    if (accessToken != '' && accessToken != 'undefined'&&(typeof accessToken.oauth_token!='undefined'&&accessToken.oauth_token != 'undefined')) {
        return accessToken;
    } else {
        return false;
    }
}

Twitter.prototype.getUserDetails = function (fun) {
    this.cb.__call(
        "account_verifyCredentials",
        {},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

/*
 * Returns a collection of the most recent Tweets and retweets posted by the authenticating user and the users they follow.
 * The home timeline is central to how most users interact with the Twitter service.
 */
Twitter.prototype.getHomeTimeLine = function (fun) {
    this.cb.__call(
        "statuses_homeTimeline",
        {},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

/*
 * Returns a single Tweet, specified by the id parameter. The Tweet’s author will also be embedded within the Tweet.
 */
Twitter.prototype.getSpecificStatus = function (status_id, fun) {
    this.cb.__call(
        "statuses_show_ID",
        {id: status_id},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

/*
 * Returns a collection of the most recent Tweets posted by the user indicated by the screen_name or user_id parameters.
 */
Twitter.prototype.getUserTweets = function (user_id, fun) {
    this.cb.__call(
        "statuses_userTimeline",
        {user_id: user_id},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

Twitter.prototype.getMentionsTimeline = function (fun) {
    this.cb.__call(
        "statuses_mentionsTimeline",
        {},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

/*
 * Returns the most recent Tweets authored by the authenticating user that have been retweeted by others
 */
Twitter.prototype.getRetweetsOfMe = function (fun) {
    this.cb.__call(
        "statuses_retweetsOfMe",
        {},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    )
}

/*
 * Returns a collection of up to 100 user IDs belonging to users who have retweeted the Tweet specified by the id parameter.
 */
Twitter.prototype.getTweetRetweeters = function (status_id, fun) {
    this.cb.__call(
        "statuses_retweeters_ids",
        {id: status_id},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

Twitter.prototype.getFollowersList = function (user_id, fun) {
    this.cb.__call(
        "followers_list",
        {user_id: user_id},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

/*
 * user_id  = id_str
 */
Twitter.prototype.getFriendsList = function (user_id, fun) {
    this.cb.__call(
        "friends/list",
        {user_id: user_id},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

/**/
Twitter.prototype.getAllReceivedMessages = function (fun) {

    this.cb.__call(
        "directMessages",
        {},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}


Twitter.prototype.getAllSentMessages = function (fun) {

    this.cb.__call(
        "directMessages_sent",
        {},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

Twitter.prototype.getSpecificMessage = function (message_id, fun) {

    this.cb.__call(
        "directMessages_show",
        {id: message_id},
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

Twitter.prototype.sendMessage = function (user_id, text_message, fun) {
    this.cb.__call(
        "directMessages_new",
        {
            user_id: user_id,
            text: text_message
        },
        function (reply, rate, err) {
            fun(reply, rate, err);
        }
    );
}

Twitter.prototype.makeTweet = function (text_tweet,image_url, fun) {
    //console.log(typeof image_url)
    el=this;
    if(typeof image_url=="function"||typeof image_url=='undefined'){
        image_url=fun;
        el.cb.__call(
            "statuses_update",
            {
                "status": text_tweet
            },
            function (reply, rate, err) {
                // ...
                fun(reply, rate, err);
            }
        );
    }else{
        convertURLToBase64(image_url,function(data){
            //console.log(data);
            el.cb.__call(
                "media_upload",
                {"media":data},
                function (reply, rate, err) {
                    console.log(reply);
                    console.log(rate);
                    console.log(err);
                    el.cb.__call(
                        "statuses_update",
                        {
                            "media_ids": reply.media_id_string,
                            "status": text_tweet
                        },
                        function (reply, rate, err) {
                            // ...
                            fun(reply, rate, err);
                        }
                    );
                }
            );
        });
    }
}



/*==================================================================================*/
//var URL = location.protocol + "//" + location.host + '/';
/*==================================================================================*/
Twitter=new Twitter;

