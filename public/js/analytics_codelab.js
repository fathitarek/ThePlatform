  var ONE_MONTH_IN_MILLISECONDS = 1000 * 60 * 60 * 24 * 30;

  // Keep track of the currently authenticated user's YouTube channel ID.
  var channelId;
  var viewsnum=0;
  // For information about the Google Chart Tools API, see:
  // https://developers.google.com/chart/interactive/docs/quick_start
  google.load('visualization', '1.0', {'packages': ['corechart']});
  // Call the Data API to retrieve information about the currently
  // authenticated user's YouTube channel.
  function getUserChannel() {
    // Also see: https://developers.google.com/youtube/v3/docs/channels/list
    var request = gapi.client.youtube.channels.list({
      // Setting the "mine" request parameter's value to "true" indicates that
      // you want to retrieve the currently authenticated user's channel.
      mine: true,
      part: 'id,contentDetails',
	  maxResults:'50'
	  
    });

    request.execute(function(response) {
		console.log(response);
      if ('error' in response) {
        displayMessage(response.error.message);
      } else {
        // We need the channel's channel ID to make calls to the Analytics API.
        // The channel ID value has the form "UCdLFeWKpkLhkguiMZUp8lWA".
        channelId = response.items[0].id;
        // Retrieve the playlist ID that uniquely identifies the playlist of
        // videos uploaded to the authenticated user's channel. This value has
        // the form "UUdLFeWKpkLhkguiMZUp8lWA".
		//bos hena
        var uploadsListId = response.items[0].contentDetails.relatedPlaylists.uploads;
        // Use the playlist ID to retrieve the list of uploaded videos.
        getPlaylistItems(uploadsListId);
      }
    });
  }

  // Call the Data API to retrieve the items in a particular playlist. In this
  // example, we are retrieving a playlist of the currently authenticated user's
  // uploaded videos. By default, the list returns the most recent videos first.
  function getPlaylistItems(listId) {
    // See https://developers.google.com/youtube/v3/docs/playlistitems/list
    var request = gapi.client.youtube.playlistItems.list({
		//bos hena ..bgeb el playlist 3n tre2 el id
      playlistId: listId,
      part: 'snippet',
	  maxResults:'50'
    });

    request.execute(function(response) {
		console.log(response);
      if ('error' in response) {
        displayMessage(response.error.message);
      } else {
        if ('items' in response) {
          // The jQuery.map() function iterates through all of the items in
          // the response and creates a new array that only contains the
          // specific property we're looking for: videoId.
          var videoIds = $.map(response.items, function(item) {
            return item.snippet.resourceId.videoId;
          });

          // Now that we know the IDs of all the videos in the uploads list,
          // we can retrieve information about each video.
          getVideoMetadata(videoIds);
        } else {
          displayMessage('There are no videos in your channel.');
        }
		
		
		
		$("#aho").html('');
		
		
		
      }
    });
  }

  
  // Given an array of video IDs, this function obtains metadata about each
  // video and then uses that metadata to display a list of videos.
  function getVideoMetadata(videoIds) {
	var viewsnum=0;
    // https://developers.google.com/youtube/v3/docs/videos/list
    var request = gapi.client.youtube.videos.list({
      // The 'id' property's value is a comma-separated string of video IDs.
      id: videoIds.join(','),
      part: 'id,snippet,statistics'
    });

	
	
	
	
	
	
	
	
    request.execute(function(response) {
      if ('error' in response) {
        displayMessage(response.error.message);
      } else {
        // Get the jQuery wrapper for the #video-list element before starting
        // the loop.
        var videoList = $('#video-list');
        $.each(response.items, function() {
          // Exclude videos that do not have any views, since those videos
          // will not have any interesting viewcount Analytics data.
          if (this.statistics.viewCount == 0) {
            return;
          }
		  var highviews=0;
		

		  
		  if(this.statistics.viewCount > highviews){
			  	 highviews = this.statistics.viewCount;
                 highvidid=this;
		  }
		
		
			$("#aho").append("<div class='col-lg-3' style='height:225px'><iframe width='auto' height='200' src='https://www.youtube.com/embed/"+highvidid.id+"'></iframe> <br> </div>");
 
		  
		 console.log(highvidid);
		 document.getElementById('mostviewd').src = "https://www.youtube.com/embed/"+ highvidid.id;	

		  
         viewsnum=(viewsnum*1+this.statistics.viewCount*1);
       	
          var title = this.snippet.title;
          var videoId = this.id;
		 
		 
		 
		 
		 document.getElementById('totalviews').innerHTML = viewsnum;  

          // Create a new &lt;li&gt; element that contains an &lt;a&gt; element.
          // Set the &lt;a&gt; element's text content to the video's title, and
          // add a click handler that will display Analytics data when invoked.
        //  var liElement = $('<li>');
        //  var aElement = $('<a>');
         // Setting the href value to '#' ensures that the browser renders the
          // &lt;a&gt; element as a clickable link.
        //  aElement.attr('href', '#');
        //  aElement.text(title + ' ..>>>>>>>>.. viewed by '+ this.statistics.viewCount);
		
		var videoidd=$('#videolistop').val();
		
		var option = $('<option></option>').attr("value", videoId).text(title);
        
		$("#videolistop").append(option);
		  $(document).on('change','#videolistop',function(){
			
		 var videoidd=$('#videolistop').val();
            displayVideoAnalytics(videoidd);
		    displayVideoAnalyticsperday(videoidd);
            displayVideoAnalyticsage(videoidd);
            displayVideoAnalyticscountry(videoidd);
   });
   
   
   	  $(document).on('change','#selectme',function(){
		var videoidd=$('#videolistop').val();
          displayVideoAnalytics(videoidd);

	   });	  
		  
   
   
      //    aElement.click(function() {
        //    displayVideoAnalytics(videoId);
        //  });
		  
		  
          
		  // Call the jQuery.append() method to add the new &lt;a&gt; element to
          // the &lt;li&gt; element, and the &lt;li&gt; element to the parent
          // list, which is identified by the 'videoList' variable.
        //  liElement.append(aElement);
        //  videoList.append(liElement);
        });

        if ($("#videolistop").length == 0) {
          // Display a message if the channel does not have any viewed videos.
          displayMessage('Your channel does not have any videos that have been viewed.');
        }
      }
    });
  }

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  function displayVideoAnalyticsperday(videoId) {
  var selectdim = document.getElementById("selectme");
  var optiondim = selectdim.options[selectdim.selectedIndex].value;
  var selectmetr = document.getElementById("selectmetr");
  var optionmetr = selectmetr.options[selectmetr.selectedIndex].value;
  var day = document.getElementById("day");
  var optionday = day.options[day.selectedIndex].value;
  var month = document.getElementById("month");
  var optionmonth = month.options[month.selectedIndex].value;
  var year = document.getElementById("year");
  var optionyear = year.options[year.selectedIndex].value;
  var dayto = document.getElementById("dayto");
  var optiondayto = dayto.options[dayto.selectedIndex].value;
  var monthto = document.getElementById("monthto");
  var optionmonthto = monthto.options[monthto.selectedIndex].value;  
  var yearto = document.getElementById("yearto");
  var optionyearto = yearto.options[yearto.selectedIndex].value; 
  
    if (channelId) {
      // To use a different date range, modify the ONE_MONTH_IN_MILLISECONDS
      // variable to a different millisecond delta as desired.
      var today = new Date();
      var lastMonth = new Date(today.getTime() - ONE_MONTH_IN_MILLISECONDS);

      var request = gapi.client.youtubeAnalytics.reports.query({
        // The start-date and end-date parameters must be YYYY-MM-DD strings.............formatDateString(lastMonth)  
        'start-date': optionyear+'-'+optionmonth+'-'+optionday,
        'end-date': optionyearto+'-'+optionmonthto+'-'+optiondayto,
        // At this time, you need to explicitly specify channel==channelId.
        // See https://developers.google.com/youtube/analytics/v1/#ids
        ids: 'channel==' + channelId,
        dimensions: 'day',
        sort: 'views',
		
        // See https://developers.google.com/youtube/analytics/v1/available_reports
        // for details about the different filters and metrics you can request
        // if the "dimensions" parameter value is "day".viewerPercentage
		metrics: 'views',
        filters: 'video==' + videoId,
      });
	  
	  
	  
      request.execute(function(response) {
        // This function is called regardless of whether the request succeeds.
        // The response contains YouTube Analytics data or an error message.
        if ('error' in response) {
          displayMessage(response.error.message);
        } else {
          displayChartperday(videoId, response);
        }
      });
    } else {
      // The currently authenticated user's channel ID is not available.
      displayMessage('The YouTube channel ID for the current user is not available.');
    }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    
  function displayVideoAnalyticsage(videoId) {
  var selectdim = document.getElementById("selectme");
  var optiondim = selectdim.options[selectdim.selectedIndex].value;
  var selectmetr = document.getElementById("selectmetr");
  var optionmetr = selectmetr.options[selectmetr.selectedIndex].value;
  var day = document.getElementById("day");
  var optionday = day.options[day.selectedIndex].value;
  var month = document.getElementById("month");
  var optionmonth = month.options[month.selectedIndex].value;
  var year = document.getElementById("year");
  var optionyear = year.options[year.selectedIndex].value;
  var dayto = document.getElementById("dayto");
  var optiondayto = dayto.options[dayto.selectedIndex].value;
  var monthto = document.getElementById("monthto");
  var optionmonthto = monthto.options[monthto.selectedIndex].value;  
  var yearto = document.getElementById("yearto");
  var optionyearto = yearto.options[yearto.selectedIndex].value; 
  
    if (channelId) {
      // To use a different date range, modify the ONE_MONTH_IN_MILLISECONDS
      // variable to a different millisecond delta as desired.
      var today = new Date();
      var lastMonth = new Date(today.getTime() - ONE_MONTH_IN_MILLISECONDS);

      var request = gapi.client.youtubeAnalytics.reports.query({
        // The start-date and end-date parameters must be YYYY-MM-DD strings.............formatDateString(lastMonth)  
        'start-date': optionyear+'-'+optionmonth+'-'+optionday,
        'end-date': optionyearto+'-'+optionmonthto+'-'+optiondayto,
        // At this time, you need to explicitly specify channel==channelId.
        // See https://developers.google.com/youtube/analytics/v1/#ids
        ids: 'channel==' + channelId,
        dimensions: 'ageGroup',
        sort: 'viewerPercentage',
		
        // See https://developers.google.com/youtube/analytics/v1/available_reports
        // for details about the different filters and metrics you can request
        // if the "dimensions" parameter value is "day".viewerPercentage
		metrics: 'viewerPercentage',
        filters: 'video==' + videoId,
      });
	  
	  
	  
      request.execute(function(response) {
        // This function is called regardless of whether the request succeeds.
        // The response contains YouTube Analytics data or an error message.
        if ('error' in response) {
          displayMessage(response.error.message);
        } else {
          displayChartage(videoId, response);
        }
      });
    } else {
      // The currently authenticated user's channel ID is not available.
      displayMessage('The YouTube channel ID for the current user is not available.');
    }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  // This function requests YouTube Analytics data for a video and displays
  // the results in a chart.
  function displayVideoAnalytics(videoId) {
  var selectdim = document.getElementById("selectme");
  var optiondim = selectdim.options[selectdim.selectedIndex].value;
  var selectmetr = document.getElementById("selectmetr");
  var optionmetr = selectmetr.options[selectmetr.selectedIndex].value;
  var day = document.getElementById("day");
  var optionday = day.options[day.selectedIndex].value;
  var month = document.getElementById("month");
  var optionmonth = month.options[month.selectedIndex].value;
  var year = document.getElementById("year");
  var optionyear = year.options[year.selectedIndex].value;
  var dayto = document.getElementById("dayto");
  var optiondayto = dayto.options[dayto.selectedIndex].value;
  var monthto = document.getElementById("monthto");
  var optionmonthto = monthto.options[monthto.selectedIndex].value;  
  var yearto = document.getElementById("yearto");
  var optionyearto = yearto.options[yearto.selectedIndex].value; 
  
    if (channelId) {
      // To use a different date range, modify the ONE_MONTH_IN_MILLISECONDS
      // variable to a different millisecond delta as desired.
      var today = new Date();
      var lastMonth = new Date(today.getTime() - ONE_MONTH_IN_MILLISECONDS);

      var request = gapi.client.youtubeAnalytics.reports.query({
        // The start-date and end-date parameters must be YYYY-MM-DD strings.............formatDateString(lastMonth)  
        'start-date': optionyear+'-'+optionmonth+'-'+optionday,
        'end-date': optionyearto+'-'+optionmonthto+'-'+optiondayto,
        // At this time, you need to explicitly specify channel==channelId.
        // See https://developers.google.com/youtube/analytics/v1/#ids
        ids: 'channel==' + channelId,
        dimensions: optiondim,
        sort: optiondim,
		
        // See https://developers.google.com/youtube/analytics/v1/available_reports
        // for details about the different filters and metrics you can request
        // if the "dimensions" parameter value is "day".viewerPercentage
		metrics: 'views',
        filters: 'video==' + videoId,
      });
	  
	  
	  
      request.execute(function(response) {
        // This function is called regardless of whether the request succeeds.
        // The response contains YouTube Analytics data or an error message.
        if ('error' in response) {
          displayMessage(response.error.message);
        } else {
          displayChart(videoId, response);
        }
      });
    } else {
      // The currently authenticated user's channel ID is not available.
      displayMessage('The YouTube channel ID for the current user is not available.');
    }
  }

  // This boilerplate code takes a Date object and returns a YYYY-MM-DD string.
  function formatDateString(date) {
    var yyyy = date.getFullYear().toString();
    var mm = padToTwoCharacters(date.getMonth() + 1);
    var dd = padToTwoCharacters(date.getDate());

    return yyyy + '-' + mm + '-' + dd;
  }

  // If number is a single digit, prepend a '0'. Otherwise, return the number
  //  as a string.
  function padToTwoCharacters(number) {
    if (number < 10) {
      return '0' + number;
    } else {
      return number.toString();
    }
  }

  // Call the Google Chart Tools API to generate a chart of Analytics data.
 


 

 



 function displayChart(videoId, response) {
    if ('rows' in response) {
      hideMessage();
	  
  var selectdim = document.getElementById("selectme");
  var optiondim = selectdim.options[selectdim.selectedIndex].value;
  var selectmetr = document.getElementById("selectmetr");
  var optionmetr = selectmetr.options[selectmetr.selectedIndex].value;

  
      // The columnHeaders property contains an array of objects representing
      // each column's title -- e.g.: [{name:"day"},{name:"views"}]
      // We need these column titles as a simple array, so we call jQuery.map()
      // to get each element's "name" property and create a new array that only
      // contains those values.
      var columns = $.map(response.columnHeaders, function(item) {
        return item.name;
      });
      // The google.visualization.arrayToDataTable() function wants an array
      // of arrays. The first element is an array of column titles, calculated
      // above as "columns". The remaining elements are arrays that each
      // represent a row of data. Fortunately, response.rows is already in
      // this format, so it can just be concatenated.
      // See https://developers.google.com/chart/interactive/docs/datatables_dataviews#arraytodatatable
      var chartDataArray = [columns].concat(response.rows);
      var chartDataTable = google.visualization.arrayToDataTable(chartDataArray);
      var csv = google.visualization.dataTableToCsv(chartDataTable);
        console.log(csv);
 
   var total = 0;
    for (i = 0; i < chartDataTable.getNumberOfRows(); i++){
      total = total + chartDataTable.getValue(i, 1);
	}
  
		document.getElementById('viewstime').innerHTML ='Total Views for this period: '+ total;  

	
      var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
      chart.draw(chartDataTable, {
		                height: 240,		  		

        // Additional options can be set if desired as described at:
        // https://developers.google.com/chart/interactive/docs/reference#visdraw
        title: optionmetr +' per ' + optiondim +' of Video ' + videoId,
		is3D: true
      });
    } else {
      displayMessage('No data available for video ' + videoId);
    }
  }

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  function displayVideoAnalyticscountry(videoId) {
  var selectdim = document.getElementById("selectme");
  var optiondim = selectdim.options[selectdim.selectedIndex].value;
  var selectmetr = document.getElementById("selectmetr");
  var optionmetr = selectmetr.options[selectmetr.selectedIndex].value;
  var day = document.getElementById("day");
  var optionday = day.options[day.selectedIndex].value;
  var month = document.getElementById("month");
  var optionmonth = month.options[month.selectedIndex].value;
  var year = document.getElementById("year");
  var optionyear = year.options[year.selectedIndex].value;
  var dayto = document.getElementById("dayto");
  var optiondayto = dayto.options[dayto.selectedIndex].value;
  var monthto = document.getElementById("monthto");
  var optionmonthto = monthto.options[monthto.selectedIndex].value;  
  var yearto = document.getElementById("yearto");
  var optionyearto = yearto.options[yearto.selectedIndex].value; 
  
    if (channelId) {
      // To use a different date range, modify the ONE_MONTH_IN_MILLISECONDS
      // variable to a different millisecond delta as desired.
      var today = new Date();
      var lastMonth = new Date(today.getTime() - ONE_MONTH_IN_MILLISECONDS);

      var request = gapi.client.youtubeAnalytics.reports.query({
        // The start-date and end-date parameters must be YYYY-MM-DD strings.............formatDateString(lastMonth)  
        'start-date': optionyear+'-'+optionmonth+'-'+optionday,
        'end-date': optionyearto+'-'+optionmonthto+'-'+optiondayto,
        // At this time, you need to explicitly specify channel==channelId.
        // See https://developers.google.com/youtube/analytics/v1/#ids
        ids: 'channel==' + channelId,
        dimensions: 'country',
        sort: 'views',
		
        // See https://developers.google.com/youtube/analytics/v1/available_reports
        // for details about the different filters and metrics you can request
        // if the "dimensions" parameter value is "day".viewerPercentage
		metrics: 'views',
        filters: 'video==' + videoId,
      });
	  
	  
	  
      request.execute(function(response) {
        // This function is called regardless of whether the request succeeds.
        // The response contains YouTube Analytics data or an error message.
        if ('error' in response) {
          displayMessage(response.error.message);
        } else {
          displayChartcountry(videoId, response);
        }
      });
    } else {
      // The currently authenticated user's channel ID is not available.
      displayMessage('The YouTube channel ID for the current user is not available.');
    }
  }

  
  
  
  
  
  
  
  
  
  
  // This boilerplate code takes a Date object and returns a YYYY-MM-DD string.
  function formatDateString(date) {
    var yyyy = date.getFullYear().toString();
    var mm = padToTwoCharacters(date.getMonth() + 1);
    var dd = padToTwoCharacters(date.getDate());

    return yyyy + '-' + mm + '-' + dd;
  }

  // If number is a single digit, prepend a '0'. Otherwise, return the number
  //  as a string.
  function padToTwoCharacters(number) {
    if (number < 10) {
      return '0' + number;
    } else {
      return number.toString();
    }
  }

  // Call the Google Chart Tools API to generate a chart of Analytics data.
 


 

 



 function displayChartcountry(videoId, response) {
    if ('rows' in response) {
      hideMessage();
	  
  var selectdim = document.getElementById("selectme");
  var optiondim = selectdim.options[selectdim.selectedIndex].value;
  var selectmetr = document.getElementById("selectmetr");
  var optionmetr = selectmetr.options[selectmetr.selectedIndex].value;

  
      // The columnHeaders property contains an array of objects representing
      // each column's title -- e.g.: [{name:"day"},{name:"views"}]
      // We need these column titles as a simple array, so we call jQuery.map()
      // to get each element's "name" property and create a new array that only
      // contains those values.
      var columns = $.map(response.columnHeaders, function(item) {
        return item.name;
      });
      // The google.visualization.arrayToDataTable() function wants an array
      // of arrays. The first element is an array of column titles, calculated
      // above as "columns". The remaining elements are arrays that each
      // represent a row of data. Fortunately, response.rows is already in
      // this format, so it can just be concatenated.
      // See https://developers.google.com/chart/interactive/docs/datatables_dataviews#arraytodatatable
      var chartDataArray = [columns].concat(response.rows);
      var chartDataTable = google.visualization.arrayToDataTable(chartDataArray);
      var csv = google.visualization.dataTableToCsv(chartDataTable);
        console.log(csv);
 
   var total = 0;
    for (i = 0; i < chartDataTable.getNumberOfRows(); i++){
      total = total + chartDataTable.getValue(i, 1);
	}
  
		document.getElementById('viewstime').innerHTML ='Total Views for this period: '+ total;  

	
      var chart = new google.visualization.ColumnChart(document.getElementById('country'));
      chart.draw(chartDataTable, {
              height: 240,		  		
				colors: ['red'],

        // Additional options can be set if desired as described at:
        // https://developers.google.com/chart/interactive/docs/reference#visdraw
        title: optionmetr +' per ' + optiondim +' of Video ' + videoId,
		is3D: true
      });
    } else {
      displayMessage('No data available for video ' + videoId);
    }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
   function displayChartperday(videoId, response) {
    if ('rows' in response) {
      hideMessage();
	  
  var selectdim = document.getElementById("selectme");
  var optiondim = selectdim.options[selectdim.selectedIndex].value;
  var selectmetr = document.getElementById("selectmetr");
  var optionmetr = selectmetr.options[selectmetr.selectedIndex].value;

  
      // The columnHeaders property contains an array of objects representing
      // each column's title -- e.g.: [{name:"day"},{name:"views"}]
      // We need these column titles as a simple array, so we call jQuery.map()
      // to get each element's "name" property and create a new array that only
      // contains those values.
      var columns = $.map(response.columnHeaders, function(item) {
        return item.name;
      });
      // The google.visualization.arrayToDataTable() function wants an array
      // of arrays. The first element is an array of column titles, calculated
      // above as "columns". The remaining elements are arrays that each
      // represent a row of data. Fortunately, response.rows is already in
      // this format, so it can just be concatenated.
      // See https://developers.google.com/chart/interactive/docs/datatables_dataviews#arraytodatatable
      var chartDataArray = [columns].concat(response.rows);
      var chartDataTable = google.visualization.arrayToDataTable(chartDataArray);
      var csv = google.visualization.dataTableToCsv(chartDataTable);
        console.log(csv);
 
   var total = 0;
    for (i = 0; i < chartDataTable.getNumberOfRows(); i++){
      total = total + chartDataTable.getValue(i, 1);
	}
  
		document.getElementById('viewstime').innerHTML ='Total Views for this period: '+ total;  

	
      var chart = new google.visualization.ColumnChart(document.getElementById('perday'));
      chart.draw(chartDataTable, {
		                height: 240,		  		

		  colors: ['red'],
        // Additional options can be set if desired as described at:
        // https://developers.google.com/chart/interactive/docs/reference#visdraw
        title: 'views per day of Video ' + videoId,
		is3D: true
      });
    } else {
      displayMessage('No data available for video ' + videoId);
    }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
   function displayChartage(videoId, response) {
    if ('rows' in response) {
      hideMessage();
	  
  var selectdim = document.getElementById("selectme");
  var optiondim = selectdim.options[selectdim.selectedIndex].value;
  var selectmetr = document.getElementById("selectmetr");
  var optionmetr = selectmetr.options[selectmetr.selectedIndex].value;

  
      // The columnHeaders property contains an array of objects representing
      // each column's title -- e.g.: [{name:"day"},{name:"views"}]
      // We need these column titles as a simple array, so we call jQuery.map()
      // to get each element's "name" property and create a new array that only
      // contains those values.
      var columns = $.map(response.columnHeaders, function(item) {
        return item.name;
      });
      // The google.visualization.arrayToDataTable() function wants an array
      // of arrays. The first element is an array of column titles, calculated
      // above as "columns". The remaining elements are arrays that each
      // represent a row of data. Fortunately, response.rows is already in
      // this format, so it can just be concatenated.
      // See https://developers.google.com/chart/interactive/docs/datatables_dataviews#arraytodatatable
      var chartDataArray = [columns].concat(response.rows);
      var chartDataTable = google.visualization.arrayToDataTable(chartDataArray);
      var csv = google.visualization.dataTableToCsv(chartDataTable);
        console.log(csv);
 
   var total = 0;
    for (i = 0; i < chartDataTable.getNumberOfRows(); i++){
      total = total + chartDataTable.getValue(i, 1);
	}
  
		document.getElementById('viewstime').innerHTML ='Total Views for this period: '+ total;  

	
      var chart = new google.visualization.ColumnChart(document.getElementById('age'));
      chart.draw(chartDataTable, {
	  height: 240,		  		

		  colors: ['red'],
        // Additional options can be set if desired as described at:
        // https://developers.google.com/chart/interactive/docs/reference#visdraw
        title: 'views per day of Video ' + videoId
      });
    } else {
      displayMessage('No data available for video ' + videoId);
    }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  // This helper method displays a message on the page.
  function displayMessage(message) {
    $('#message').text(message).show();
  }

  // This helper method hides a previously displayed message on the page.
  function hideMessage() {
    $('#message').hide();
  }














