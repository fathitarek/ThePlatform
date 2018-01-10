/*
Copyright 2015 Google Inc. All Rights Reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

  http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/



var STATUS_POLLING_INTERVAL_MILLIS = 60 * 1000; // One minute.


/**
 * YouTube video uploader class
 *
 * @constructor
 */
var UploadVideo = function() {
  /**
   * The array of tags for the new YouTube video.
   *
   * @attribute tags
   * @type Array.<string>
   * @default ['google-cors-upload']
   */
  this.tags = ['youtube-cors-upload'];

  /**
   * The numeric YouTube
   * [category id](https://developers.google.com/apis-explorer/#p/youtube/v3/youtube.videoCategories.list?part=snippet&regionCode=us).
   *
   * @attribute categoryId
   * @type number
   * @default 22
   */
  this.categoryId = 22;

  /**
   * The id of the new video.
   *
   * @attribute videoId
   * @type string
   * @default ''
   */
  this.videoId = '';

  this.uploadStartTime = 0;
};


UploadVideo.prototype.ready = function(accessToken) {
  this.accessToken = $('#accessto').val();
  this.gapi = gapi;
  this.authenticated = true;
  this.gapi.client.request({
    path: '/youtube/v3/channels',
    params: {
      part: 'snippet',
      mine: true
    },
    callback: function(response) {
      if (response.error) {
        console.log(response.error.message);
      } else {
        $('#channel-name').text(response.items[0].snippet.title);
        $('#channel-thumbnail').attr('src', response.items[0].snippet.thumbnails.default.url);

        $('.post-sign-in').show();
      }
    }.bind(this)
  });
  $('#button').on("click", this.handleUploadClicked.bind(this));
};




/**
 * Uploads a video file to YouTube.
 *
 * @method uploadFile
 * @param {object} file File object corresponding to the video to upload.
 */


   function executeRequestt(request) {
    request.execute(function(response) {
      console.log(response.items);	  
	for (var i = 0; i < response.items.length; i++) {   
	$('#playlists')
         .append($("<option></option>")
                    .attr("value",response.items[i].id)
                    .text(response.items[i].snippet.localized.title)); 
	  }  
    });
  }
  
  
  
  

  function buildApiRequestt(requestMethod, path, params, properties) {
    params = removeEmptyParams(params);
    var request;
    if (properties) {
      var resource = createResource(properties);
      request = gapi.client.request({
          'body': resource,
          'method': requestMethod,
          'path': path,
          'params': params
      });
    } else {
      request = gapi.client.request({
          'method': requestMethod,
          'path': path,
          'params': params
      });
    }
    executeRequestt(request);
  }

  /***** END BOILERPLATE CODE *****/

  
function defineRequestts() {
    // See full sample for buildApiRequest() code, which is not 
// specific to a particular youtube or youtube method.
var chanellid= $("#chanellID").val();
console.log(chanellid);
buildApiRequestt('GET',
                '/youtube/v3/playlists',
                {'channelId': 'UClNEls8XuHLTFR33FT6mKCw',
                 'maxResults': '25',
                 'part': 'snippet,contentDetails'});

  }
 
 
 
 
 
 
     // Add a video ID specified in the form to the playlist.
    // Add a video to a playlist. The "startPos" and "endPos" values let you
    // start and stop the video at specific times when the video is played as
    // part of the playlist. However, these values are not set in this example.
    function addToPlaylist(id, startPos, endPos) {
        var details = {
            videoId: id,
            kind: 'youtube#video'
        }
        if (startPos != undefined) {
            details['startAt'] = startPos;
        }
        if (endPos != undefined) {
            details['endAt'] = endPos;
        }
       
	   var request = gapi.client.youtube.playlistItems.insert({
            part: 'snippet',
            resource: {
                snippet: {
                    playlistId: $('#playlists').val(),
                    resourceId: details
                }
            }
        });
        request.execute(function(response) {
            console.log(response);
            if (!response.code) {
                $('#status').html('<pre>Succesfully added the video : ' + JSON.stringify(response.result) + '</pre>');
            } else if (response.code == 409) {
                $('#status').html('<p>Conflict : this video is already on your Watch Later playlist</p>');
            } else if (response.code == 404) {
                $('#status').html('<p>Not Found : this video hasnt been found</p>');
            } else {
                $('#status').html('<p>Error : code ' + response.code + '</p>');
            }
        });
    }
 
 
 

UploadVideo.prototype.uploadFile = function(file) {
pubat=$(".schedule").attr('date-time');
d = new Date(+(pubat + +777));
publishat=d.toISOString();

  var metadata = {
    snippet: {
      title: $('#title').val(),
      description: $('#postMessage').val(),
      tags: this.tags,
      categoryId: this.categoryId
    },
    status: {
     privacyStatus:$('#privacy-status option:selected').val(),
    publishAt: publishat//byzwd sa3ten   "2017-11-10T8:20:15.000+00:00"
	  }
  };
  var uploader = new MediaUploader({
    baseUrl: 'https://www.googleapis.com/upload/youtube/v3/videos',
    file: file,
    token: this.accessToken,
    metadata: metadata,
    params: {
      part: Object.keys(metadata).join(',')
    },
    onError: function(data) {
      var message = data;
      // Assuming the error is raised by the YouTube API, data will be
      // a JSON string with error.message set. That may not be the
      // only time onError will be raised, though.
      try {
        var errorResponse = JSON.parse(data);
        message = errorResponse.error.message;
      } finally {
        alert(message);
      }
    }.bind(this),
    onProgress: function(data) {
      var currentTime = Date.now();
      var bytesUploaded = data.loaded;
      var totalBytes = data.total;
      // The times are in millis, so we need to divide by 1000 to get seconds.
      var bytesPerSecond = bytesUploaded / ((currentTime - this.uploadStartTime) / 1000);
      var estimatedSecondsRemaining = (totalBytes - bytesUploaded) / bytesPerSecond;
      var percentageComplete = (bytesUploaded * 100) / totalBytes;

      $('#upload-progress').attr({
        value: bytesUploaded,
        max: totalBytes
      });

      $('#percent-transferred').text(percentageComplete);
      $('#bytes-transferred').text(bytesUploaded);
      $('#total-bytes').text(totalBytes);

      $('.during-upload').show();
    }.bind(this),
    onComplete: function(data) {
      var uploadResponse = JSON.parse(data);
      this.videoId = uploadResponse.id;
      $('#video-id').text(this.videoId);
      $('.post-upload').show();
      this.pollForVideoStatus();
    }.bind(this)
  });
  // This won't correspond to the *exact* start of the upload, but it should be close enough.
  this.uploadStartTime = Date.now();
  uploader.upload();
};

UploadVideo.prototype.handleUploadClicked = function() {
  $('#button').attr('disabled', true);
  this.uploadFile($('#file').get(0).files[0]);
  
  };

UploadVideo.prototype.pollForVideoStatus = function() {
  this.gapi.client.request({
    path: '/youtube/v3/videos',
    params: {
      part: 'status,player',
      id: this.videoId
    },
    callback: function(response) {
      if (response.error) {
        // The status polling failed.
        console.log(response.error.message);
        setTimeout(this.pollForVideoStatus.bind(this), STATUS_POLLING_INTERVAL_MILLIS);
      } else {
        var uploadStatus = response.items[0].status.uploadStatus;
        switch (uploadStatus) {
          // This is a non-final status, so we need to poll again.
          case 'uploaded':
            $('#post-upload-status').append('<li>Upload status: ' + uploadStatus + '</li>');
            setTimeout(this.pollForVideoStatus.bind(this), STATUS_POLLING_INTERVAL_MILLIS);
            break;
          // The video was successfully transcoded and is available.
          case 'processed':
		  $('#emptyPost').hide();
            $('#player').append(response.items[0].player.embedHtml);
			
            $('#post-upload-status').append('<li>Final status.</li>');
			 
			 addToPlaylist(response.items[0].id);

            break;
          // All other statuses indicate a permanent transcoding failure.
          default:
            $('#post-upload-status').append('<li>Transcoding failed.</li>');
            break;
        }
      }
    }.bind(this)
  });
};















