LinkedIN={
    companiesScope:":(id,name,universal-name,email-domains,company-type,ticker,website-url,industries,status,logo-url,square-logo-url,blog-rss-url,twitter-id,employee-count-range,specialties,locations,description,stock-exchange,founded-year,end-year,num-followers)",
    userScope:":(id,first-name,last-name,maiden-name,formatted-name,phonetic-first-name,phonetic-last-name,formatted-phonetic-name,headline,location,industry,current-share,num-connections,num-connections-capped,summary,specialties,positions,picture-url,picture-urls::(original),site-standard-profile-request,api-standard-profile-request,public-profile-url,email-address)",
    isAuthorized:function(){
        return IN.User.isAuthorized();
    },
    customRequest:function(url,method,body,fun ){
        req=IN.API;
        req=req.Raw(url);
        if (typeof method === 'function') {
            fun  = method;
        }else{
            req=req.method(method);
        }
        if (typeof body === 'function') {
            fun  = body;
        }else{
            req=req.body(JSON.stringify(body));
        }
        req=req.result(function(data){fun(data)}).error(onError);
    },
    getUserDetails:function(fun){
        this.customRequest("/people/~"+this.userScope+"?format=json",function(data){
            fun(data);
        });
    },
    shareInMyProfile:function(payload,fun){
        this.customRequest("/people/~/shares?format=json","POST",payload,function(data){
            fun(data);
        });
    },
    getCompaniesList:function(fun){
        this.customRequest("/companies"+this.companiesScope+"?format=json&is-company-admin=true",function(data){
            fun(data);
        });
    },
    isCompanyAdmin:function(compID,fun){
        this.customRequest("/companies/"+compID+"/relation-to-viewer/is-company-share-enabled?format=json",function(data){
            fun(data);
        });
    },
    canShareOnCompany:function(compID,fun){
        this.customRequest("/companies/"+compID+"/is-company-share-enabled?format=json",function(data){
            fun(data);
        });
    },
    getCompanyPageDetails:function(compID,fun){
        this.customRequest("/companies/"+compID+this.companiesScope+"?format=json&start=0&count=10",function(data){
            fun(data);
        });
    },
    getCompanyPosts:function(compID,start,count,fun){
        if (typeof start === 'function') {
            fun  = start;
            start=0;
        }
        if (typeof count === 'function') {
            fun  = count;
            count=10;
        }
        start=(typeof start!='undefined')?start:0;
        count=(typeof count!='undefined')?count:10;
        this.customRequest("/companies/"+compID+"/updates?format=json&start="+start+"&count="+count,function(data){
            fun(data);
        });
    },
    getSingleCompanyPost:function(compID,postKey,fun){
        this.customRequest("/companies/"+compID+"/updates/key="+postKey+"?format=json",function(data){
            fun(data);
        });
    },
    getCompanyPostComments:function(compID,postKey,fun){
        this.customRequest("/companies/"+compID+"/updates/key="+postKey+"/update-comments?format=json",function(data){
            fun(data);
        });
    },
    getCompanyPostLikes:function(compID,postKey,fun){
        this.customRequest("/companies/"+compID+"/updates/key="+postKey+"/likes?format=json",function(data){
            fun(data);
        });
    },
    getCompanyFollowersNumbers:function(compID,fun){
        this.customRequest("/companies/"+compID+"/num-followers?format=json",function(data){
            fun(data);
        });
    },
    addCompanyComment:function(compID,postKey,payload,fun){
        this.customRequest("/companies/"+compID+"/updates/key="+postKey+"/update-comments-as-company?format=json",'POST',payload,function(data){
            fun(data);
        });
    },
    shareInCompany:function(compID,payload,fun){
        this.customRequest("/companies/"+compID+"/shares?format=json",'POST',payload,function(data){
            fun(data);
        });
    },
    getCompanyStatistics:function(compID,fun){
        this.customRequest("/companies/"+compID+"/company-statistics?format=json",function(data){
            fun(data);
        });
    },
    getCompanyHistoricalFollower:function(compID,startTimestamp,timeGranularit,endTimestamp,fun){
        this.customRequest("/companies/"+compID+"/historical-follow-statistics?format=json&start-timestamp="+startTimestamp+"&time-granularity="+timeGranularit+"&end-timestamp="+endTimestamp,function(data){
            fun(data);
        });
    },
    getCompanyHistoricalStatues:function(compID,startTimestamp,timeGranularit,endTimestamp,fun){
        this.customRequest("/companies/"+compID+"/historical-status-update-statistics?format=json&start-timestamp="+startTimestamp+"&time-granularity="+timeGranularit+"&end-timestamp="+endTimestamp,function(data){
            fun(data);
        });
    },
};
function onError(error) {
    console.log(error);
};
