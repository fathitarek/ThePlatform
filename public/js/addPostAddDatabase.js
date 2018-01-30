/**
 * Created by Fathy.Tarek on 1/28/2018.
 */

function addPostToDataBase(page_id, message, publish, scheduleDateTime, post_id, resource_id, picture_url, token,category_id,sucessURL,errorURL){
    category_id = (typeof category_id == 'undefined') ? 0 : category_id;
    var URL= window.location;
    $.ajax({
        type: "POST",
        url: '../addPost',
        data: {
            "page_id": page_id,
            "message": message,
            "publish": publish,
            "scheduleDateTime": scheduleDateTime,
            "post_id": post_id,
            "resource_id": resource_id,
            "picture_url": picture_url,
            _token: token,
            category_id:category_id
        },
        success: function (msg) {
            // window.location.href=sucessURL;
            //alert("success");
            console.log("msg   " + msg.success);
            if (msg.success == false){
//                                            $(".alert-success").html('This post already exist');
//                                            $(".alert-success").css("background-color", "#f2dede");
//                                            $(".alert-success").css("color", "#a94442");
//                                            $(".alert-success").css("border-color", "#e6c1c1");
//                                                $.ajax({
//                                                    type:"POST",
//                                                    url:""
//                                                });
               // window.location.href=errorURL;
            }
        },
        error: function (msg) {
           // alert("error");
            console.log("msg" + msg);
             window.location.href=errorURL;
        }
    });
}
function updatePostToDataBase(page_id, message, publish, scheduleDateTime, post_id, resource_id, picture_url, token,category_id,sucessURL,errorURL){
    $.ajax({
        type: "POST",
        url: './updatepost/'+post_id,
        data: {
            "page_id": page_id,
            "message": message,
            "publish": publish,
            "scheduleDateTime": scheduleDateTime,
            "post_id": post_id,
            "resource_id": resource_id,
            "picture_url": picture_url,
            _token: token,
            category_id:category_id
        },
        success: function (msg) {
            console.log("msg   " + msg.success);
            window.location.href=sucessURL;
        },
        error: function (msg) {
            // alert("error");
            console.log("msg" + msg);
            // window.location.href=errorURL;
        }
    });
}
