// The client ID is obtained from the {{ Google Cloud Console }}
// at {{ https://cloud.google.com/console }}.
// If you run this code from a server other than http://localhost,
// you need to register your own client ID.
var OAUTH2_CLIENT_ID = '65941346277-lr6pl5d2d40n0fj46ldtce1esba7d7hi.apps.googleusercontent.com';
var OAUTH2_SCOPES = [
    'https://www.googleapis.com/auth/youtube'
];

// Upon loading, the Google APIs JS client automatically invokes this callback.
googleApiClientReady = function() {
    gapi.auth.init(function() {
        window.setTimeout(checkAuth, 1);
    });
}

// Attempt the immediate OAuth 2.0 client flow as soon as the page loads.
// If the currently logged-in Google Account has previously authorized
// the client specified as the OAUTH2_CLIENT_ID, then the authorization
// succeeds with no user intervention. Otherwise, it fails and the
// user interface that prompts for authorization needs to display.





function checkAuth() {
    gapi.auth.authorize({
        client_id: OAUTH2_CLIENT_ID,
        scope: OAUTH2_SCOPES,
        immediate: true
    }, handleAuthResult);
}


$('#connectSocialYoutube').click(function() {
    gapi.auth.authorize({
        client_id: OAUTH2_CLIENT_ID,
        scope: OAUTH2_SCOPES,
        immediate: false,
    }, handleAuthResult);
});



$('#connectSocialYoutu').click(function() {
    gapi.auth.authorize({
        client_id: OAUTH2_CLIENT_ID,
        scope: OAUTH2_SCOPES,
        immediate: false,
    }, handleAuthResult);
});






/*
$('#useProfile').click(function() {
    gapi.auth.authorize({
        client_id: OAUTH2_CLIENT_ID,
        scope: OAUTH2_SCOPES,
        immediate: false,
    }, handleAuthResult);
});

*/

// Handle the result of a gapi.auth.authorize() call.
function handleAuthResult(authResult) {
    $('#yexpiresInn').val(authResult.expires_in);
	$('#accessto').val(authResult.access_token);
              	
  
		


    if (authResult && !authResult.error) {
		console.log(authResult);
		// $(".socialYoutubeCheckbox" ).prop("checked", true );
        // Authorization was successful. Hide authorization prompts and show
        // content that should be visible after authorization succeeds.
        loadAPIClientInterfaces();
        var uploadVideo = new UploadVideo();
		defineRequestchanells();
        uploadVideo.ready();
		defineRequestts();

    }
}






// Load the client interfaces for the YouTube Analytics and Data APIs, which
// are required to use the Google APIs JS client. More info is available at
// https://developers.google.com/api-client-library/javascript/dev/dev_jscript#loading-the-client-library-and-the-api
function loadAPIClientInterfaces() {
    gapi.client.load('youtube', 'v3', function() {
          gapi.client.load('youtubeAnalytics', 'v1', function() {
        // After both client interfaces load, use the Data API to request
        // information about the authenticated user's channel.
        getUserChannel();
      });
    });
}
