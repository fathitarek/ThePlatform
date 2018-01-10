FaceBook={

    accessToken:"",

    userScope:'id,about,age_range,birthday,can_review_measurement_request,context,cover,currency,devices,education,email,favorite_athletes,favorite_teams,first_name,gender,hometown,inspirational_people,install_type,installed,interested_in,is_shared_login,is_verified,languages,last_name,link,locale,location,meeting_for,middle_name,name,name_format,payment_pricepoints,political,public_key,quotes,relationship_status,religion,security_settings,shared_login_upgrade_required_by,short_name,significant_other,sports,test_group,third_party_id,timezone,updated_time,verified,video_upload_limits,viewer_can_send_gift,website,work,picture{height,is_silhouette,url,width}',

    pageScope:'id,name,access_token,about,app_links,phone,category,checkins,description,website,new_like_count,country_page_likes,fan_count,rating_count,talking_about_count,unread_message_count,unread_notif_count,unseen_message_count,were_here_count,emails,impressum,founded,awards,products,cover,picture{height,is_silhouette,url,width},perms',

    postScope:'shares,likes.summary(true).limit(100){name,id,username,created_time,picture{url,height,width,is_silhouette},pic_small,pic_large,pic_crop,pic,pic_square,profile_type,link,can_post},comments.summary(true).limit(100){id,comment_count,like_count,message,message_tags,created_time,from{id,name,picture}},message,message_tags,created_time,story,story_tags,status_type,from{id,name,picture},full_picture,picture,place,description,name,link,source',

    commentScope:'id,from{id,name,picture},message,message_tags,created_time,comments.summary(true){from{id,name,picture},message}',

    likeScope:'id,link,name,pic,pic_crop,pic_large,pic_small,pic_square,profile_type,username,picture{url,width,height,is_silhouette}',

    loginScopes:'email,publish_actions,user_about_me,user_birthday,user_education_history,user_friends,user_games_activity,user_hometown,user_likes,user_location,user_photos,user_posts,user_relationship_details,user_relationships,user_religion_politics,user_status,user_tagged_places,user_videos,user_website,user_work_history,ads_management,ads_read,business_management,manage_pages,pages_manage_cta,user_actions.books,user_actions.fitness,pages_manage_instant_articles,pages_messaging,pages_messaging_phone_number,pages_messaging_subscriptions,pages_show_list,user_actions.music,user_actions.news,publish_pages,read_page_mailboxes,rsvp_event,user_events,user_managed_groups,user_actions.video,instagram_basic,instagram_manage_comments,instagram_manage_insights,read_audience_network_insights,read_custom_friendlists,read_insights',

    isAuthorized:function(fun){

        FB.getLoginStatus(function(res){fun(res.status,res.authResponse);});

    },
/*
ajaxRequest:function(data,func){
    $.ajax({
    type: "GET",
    url: "https://graph.facebook.com/v2.10/oauth/access_token?access_token=EAAV0FTkDnM4BAD1H1yhB4ZBT0A2z9xaYvq5Gp13cxDYueIZBZCzmSvXTRTZAa3fX1weerqsKmKKLcdCC0aY6MOgVG0Sii6ZAXIXHXCqEDTcd3COy0BvOvd07RCw8nEY1EYwPlZBOnmq8n6QQUerMHZAHjPwqR38caSWlHYgNiVDmuwlrQTY3CZAS2hdpkTz0ctHRqNLgxkNZACgZDZD&callback=FB.__globalCallbacks.f110279b5428a14&client_id=1535009383226574&client_secret=4ccaaa30b5e3634cd904309bb491a90f&fb_exchange_token=EAAV0FTkDnM4BAD1H1yhB4ZBT0A2z9xaYvq5Gp13cxDYueIZBZCzmSvXTRTZAa3fX1weerqsKmKKLcdCC0aY6MOgVG0Sii6ZAXIXHXCqEDTcd3COy0BvOvd07RCw8nEY1EYwPlZBOnmq8n6QQUerMHZAHjPwqR38caSWlHYgNiVDmuwlrQTY3CZAS2hdpkTz0ctHRqNLgxkNZACgZDZD&grant_type=fb_exchange_token&method=get&pretty=0&sdk=joey",
    data:data,
    success: function (msg) {
        func(msg);
    }
    });
}
*/


extendaccesstoken:function(access_token,func){

//3mlty,(func) fo2 34an a3ml callback ...34an my3ml4 return l undefined ..lazm astna el request bta3 el ajax 34an ygely response

//FB.getLoginStatus(function(res){fun(res.status,res.authResponse);});
 //  fun("connected");
/* grant_type=fb_exchange_token&
        client_id={app-id}&
        client_secret={app-secret}&
        fb_exchange_token={short-lived-token}*/
/*FB.api('/oauth/access_token','GET',{grant_type:'fb_exchange_token',client_id:'1535009383226574',client_secret:'4ccaaa30b5e3634cd904309bb491a90f',fb_exchange_token:access_token},function(json){
  console.log(json);
});*/

/*FB.api('https://graph.facebook.com/v2.10/oauth/access_token','POST',{grant_type:'fb_exchange_token',client_id:'1535009383226574',client_secret:'4ccaaa30b5e3634cd904309bb491a90f',fb_exchange_token:access_token},function(json){
  console.log(json);
});*/
//hena ana b3t url 3ady gedn 3mlt beh request bdal ma aktb uri fo2
 $.ajax({
    type: "GET",
    url: "https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&%20client_id=1535009383226574&%20client_secret=4ccaaa30b5e3634cd904309bb491a90f&%20fb_exchange_token="+access_token,
    success: function (msg) {
        func(msg.access_token);
    }
    });


/*
FB.api('/oauth/access_token','GET',{grant_type:'fb_exchange_token',client_id:'1535009383226574',client_secret:'4ccaaa30b5e3634cd904309bb491a90f',fb_exchange_token:access_token},function(response) {
  console.log(response);
});
*/
},


    setAccessToken:function(accessToken){
        this.accessToken=accessToken;
        return this.accessToken;
    },


    getAccessToken:function(func){
        e=this;
        if(e.accessToken==''){
            e.accessToken="facebook";
            e.isAuthorized(function(status,authResponse){

                e.getUserDetails(function(data){

                    $.ajax({

                        type: "POST",

                        url: URL+"/saveAccessToken",

                        data: {
                            "profile_id": data.id,

                            "name": data.name,

                            "first_name": data.first_name,

                            "last_name": data.last_name,

                            "middle_name": data.middle_name,

                            "email": data.email,

                            "birthday": data.birthday,

                            "political": data.political,

                            "quotes": data.quotes,

                            "about": data.about,

                            "relationship_status": data.relationship_status,

                            "religion": data.religion,

                            "updated_time": data.updated_time,

                            "website": data.website,

                            "link": data.link,

                            "gender": data.gender,

                            "accessToken": authResponse.accessToken,

                            _token: token
                        },
                        success: function (msg) {
                        }

                    });

                });

                e.setAccessToken(authResponse.accessToken);

                func(authResponse.accessToken);

            });

        }else{

            func(this.accessToken);

        }

    },

    login:function(fun,scopes){

        scopes=(typeof scopes!='undefined')?scopes:{scope:this.loginScopes};

        FB.login(function(res){fun(res);},scopes);

    },

    customRequest:function(url,method,body,fun){

        this.getAccessToken(function(accessToken){

            if (typeof method === 'function') {

                fun  = method;

                method='GET';

            }

            if (typeof body === 'function') {

                fun  = body;

                body={};

            }

            body.accessToken=accessToken;

            FB.api(url,method,body,function(data){fun(data)});

        });



    },

    getUserDetails:function(fun){
        this.customRequest('/me','GET',{"fields":this.userScope},function(user){fun(user);});
    },

    shareInMyProfile:function(payload,fun){

        this.customRequest('/me/feed','POST',payload,function(data){fun(data)});

    },

    shareInPage:function(pageID,message,scheduleDate,picture_url,fun){

        t=this;

        t.customRequest(String(pageID),'GET',{"fields":"access_token"},function(d){
            dataSend={"message": message,"access_token": d.access_token}

            if(typeof picture_url==='function'||typeof picture_url=='undefined'){

                fun=(typeof picture_url=='undefined')?fun:picture_url;
                requestURL=pageID+'/feed';

            }else{

                dataSend.url=picture_url;
                requestURL=pageID+'/photos';

            }

          /* ------------islam --------------------------
           if(scheduleDate!='now'){

                dataSend.published=false;

                dataSend.scheduled_publish_time=scheduleDate;

            }
*/
            //console.log(requestURL);

            //console.log(dataSend);

            //console.log(picture_url);

            t.customRequest(requestURL,'POST',dataSend,function(data){fun(data);})

        });

    },


    getGroupsList:function(fun){
      
      this.customRequest('/me/groups','GET',function(group){
      
      fun(group)

   });

    },

    getPagesList:function(fun){

        this.customRequest('/me/accounts','GET',{"fields":this.pageScope},function(data){
        
            fun(data)

        });

    },

    getPageDetails:function(pageID,scope,fun){

        if(typeof scope==='function'){

            fun  = scope;

            scope=this.pageScope;

        }

        console.log(scope);

        this.customRequest(pageID,'GET',{"fields":scope},function(data){fun(data);});

    },

    getPagePosts:function(pageID,after,limit,scope,fun){

        if(typeof scope==='function'){

            fun  = scope;

            scope=this.postScope;

        }

        if(typeof limit==='function'){

            fun  = limit;

            limit=10;

            scope=this.postScope;

        }

        if(typeof after==='function'){

            fun  = after;

            scope=this.postScope;

        }

        limit=(typeof limit!='undefined')?limit:10;
        prams={"fields":scope,"limit":limit};



        if(typeof after!='undefined'){
            prams.after=after;
        }

        this.customRequest(pageID+'/feed','GET',prams,function(data){fun(data)});

    },

    getSinglePagePost:function(postID,after,limit,scope,fun){

        if(typeof scope==='function'){

            fun  = scope;

            scope=this.postScope;

        }

        if(typeof limit==='function'){

            fun  = limit;

            limit=10;

        }

        limit=(typeof limit!='undefined')?limit:10;

        scope=(typeof scope!='undefined')?scope:this.postScope;

        prams={"fields":scope,"limit":limit};

        if(typeof after==='function'){

            fun  = after;

        }

        if(typeof after!='undefined'){

            prams.after=after;

        }

        this.customRequest(postID,'GET',prams,function(data){fun(data)});

    },

    getPostComments:function(postID,limit,after,scope,fun){

        if(typeof scope==='function'){

            fun  = scope;

            scope=this.commentScope;

        }

        if(typeof limit==='function'){

            fun  = limit;

            limit=10;

        }

        limit=(typeof limit!='undefined')?limit:10;

        scope=(typeof scope!='undefined')?scope:this.commentScope;

        prams={"fields":scope,"limit":limit};

        if(typeof after==='function'){

            fun  = after;

        }

        if(typeof after!='undefined'){

            prams.after=after;

        }

        this.customRequest(postID+'/comments','GET',prams,function(data){fun(data)});

    },

    getPostLikes:function(postID,scope,limit,fun){

        if(typeof scope==='function'){
            fun  = scope;
            scope=this.likeScope;

        }

        if(typeof limit==='function'){

            fun  = limit;

            limit=10;

        }

        limit=(typeof limit!='undefined')?limit:10;

        scope=(typeof scope!='undefined')?scope:this.likeScope;

        this.customRequest(postID+'/likes','GET',{"fields":scope,"limit":limit},function(data){fun(data)});

    },

    addCommentToPagePost:function(pageID,postID,message,fun){

        t=this;

        t.customRequest(pageID,'GET',{"fields":"access_token"},function(d){

            t.customRequest(postID+'/comments','POST',{"message": message,"access_token": d.access_token},function(data){fun(data);})

        });

    },

    likePagePost:function(pageID,postID,fun){

        this.customRequest(pageID,'GET',{"fields":"access_token"},function(d){

            this.customRequest(postID+'/likes','POST',{"access_token": d.access_token},function(data){fun(data);})

        });

    },

    disLikePagePost:function(pageID,postID,fun){

        this.customRequest(pageID,'GET',{"fields":"access_token"},function(d){

            this.customRequest(postID+'/likes','DELETE',{"access_token": d.access_token},function(data){fun(data);})

        });

    },

    postToPageSchedule:function(page_id,message,scheduleDate,picture_url,func){

        w=this;

        w.isAuthorized(function(respose){

            if(respose=='connected'){

                w.shareInPage(page_id, message, scheduleDate,picture_url, function (data) {

                    func(page_id,data);

                });

            }else{

                w.login(function(response){

                    if (response.authResponse) {

                        w.shareInPage(page_id, message, scheduleDate,picture_url, function (data) {

                            func(page_id,data);

                        });

                    }

                });

            }

        });

    },

    getPageFans:function(page_id,from,to,func){

        t=this;

        url=page_id+'/insights/page_fans?since='+from+'&until='+to;

        t.isAuthorized(function(respose){

            if(respose=='connected'){

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){

                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});

                });

            }else{

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){

                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});

                });

            }

        });

    },

    getPageInteractions:function(page_id,from,to,func){

        t=this;

        url=page_id+'/insights/page_total_actions/day?since='+from+'&until='+to;

        //console.log(url);

        t.isAuthorized(function(respose){

            if(respose=='connected'){

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){

                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});

                });

            }else{

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){

                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});

                });

            }

        });

    },

    getPageVideoViews:function(page_id,from,to,func){

        t=this;

        url=page_id+'/insights/page_video_views/day?since='+from+'&until='+to;

        //console.log(url);

        t.isAuthorized(function(respose){

            if(respose=='connected'){

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){

                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});

                });

            }else{

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){

                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});

                });

            }

        });

    },

    getPageConsumptions:function(page_id,from,to,func){

        t=this;

        url=page_id+'/insights/page_consumptions/day?since='+from+'&until='+to;

        //console.log(url);

        t.isAuthorized(function(respose){

            if(respose=='connected'){

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){

                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});

                });

            }else{

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){

                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});

                });

            }

        });

    },

    getPageEngagements:function(page_id,from,to,func){

        t=this;

        url=page_id+'/insights/page_post_engagements/day?since='+from+'&until='+to;

        //console.log(url);

        t.isAuthorized(function(respose){

            if(respose=='connected'){

                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){
                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});
                });
            }else{
                t.customRequest(page_id,'GET',{"fields":"access_token"},function(d){
                    t.customRequest(url,'GET',{"access_token": d.access_token},function(data){func(data)});
                });
            }
        });
    }
};