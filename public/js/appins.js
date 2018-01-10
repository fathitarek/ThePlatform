(function(sandbox) {

  sandbox.init = function() {


    this.api = Instajam.init({
      clientId: 'ce7b05305e0c4e6e914ba64b29f7bf47',
      redirectUri:'http://localhost/theplatformnew/public/',
      scope: ['basic', 'comments', 'relationships', 'likes','public_content','follower_list']
    });

    this.$window = $(window);
    this.$body = $('body');
    this.$main = $('#main');
    this.$overlay = $('.js-overlay');
    this.template = _.template( $('script[name="main"]').html() );

    this.render();

    this.$window.on('resize', onWindowResize);

  };

  sandbox.render = function() {

    var that = this;

    that.$main.html(that.template(that.api));

    $('.js-logout').on('click', function(e) {
      e.preventDefault();
      that.api.deauthenticate();
      that.render();
    });

    Ladda.bind( '.js-try-it', { timeout: 5000 });
    
	sandbox.test('user.self.profile');
	sandbox.test('user.self.media');

    $('.js-try-it').on('click', function(e) {
      e.preventDefault();
      var method = $(this).data('method');
 
 
 if (method) {
        sandbox.test(method);
      }

    });
  };


  
  sandbox.test = function(method) {

    switch(method) {

    case 'user.self.profile':
      this.api.user.self.profile(function(data) {
        showResults(data);
		console.log(data);
		
		/*document.getElementById('welcome').innerHTML ='<br> Welcome '+data.data['full_name'] + '<br><br> your Username: '+data.data['username']+'<br><br> your profile picture: <br><br>';
      */document.getElementById('myphoto').src = data.data['profile_picture'];
		document.getElementById('me').innerHTML += data.data['full_name'];	
		document.getElementById('totalFollowers').innerHTML =data.data['counts'].followed_by;
		document.getElementById('totalFollowing').innerHTML =data.data['counts'].follows;	
        document.getElementById('Postsinst').innerHTML =data.data['counts'].media;	
		
      });
      break;

    case 'user.self.media':
      this.api.user.self.media(function(data) {
        showResults(data);
		console.log(data);
var largest = 0;
var highengage = 0;
for (i = 0; i < data.data.length; i++) {
	if (data.data[i].likes.count > largest) {
	 largest = data.data[i].likes.count;
	 post=data.data[i];
	
}

if (data.data[i].comments.count > highengage) {
	 highengage = data.data[i].comments.count;
	 postcom=data.data[i];
	
}


}

console.log(largest);				
console.log(post);								

for (i = 0; i < data.data.length; i++) {

	document.getElementById('items').innerHTML+="<div class='col-lg-3' style='display:inline;' class='item'><img style='width:300px; height:180px; padding:10px;     border-radius: 15px;' src="+data.data[i].images.standard_resolution.url+" /><br> <span class='likes'>Likes:"+data.data[i].likes.count+ "</span><br><span style='' class='comments'> Comments: "+data.data[i].comments.count+"</span> </div>";
}
		//	alert(data.data[0].id);
		//alert(data.data[thumbnail]);
		
		document.getElementById('morelikes').src = post.images.standard_resolution.url;	
        document.getElementById('likes').innerHTML='<span class="likes">Likes: '+post.likes.count + '</span><br><span class="comments"> Comments: '+post.comments.count+'</span>';
		
		
		
		document.getElementById('morecommented').src = postcom.images.standard_resolution.url;	
        document.getElementById('comments').innerHTML='<span class="likes">Likes: '+postcom.likes.count + '</span><br><span class="comments"> Comments: '+postcom.comments.count+'</span>';
		});
      break;

    case 'user.self.feed':
      this.api.user.self.feed(function(data) {
        showResults(data);
      });
      break;

    case 'user.self.favorites':
      this.api.user.self.favorites(function(data) {
        showResults(data);
      });
      break;

    case 'user.requests':
      this.api.user.requests(function(data) {
        showResults(data);
      });
      break;

    case 'user.relationshipWith':
      this.api.user.relationshipWith('306837613', function(data) {
        showResults(data);
      });
      break;

    case 'user.get':
      this.api.user.get('islamsobhy1993', function(data) {
        showResults(data);
      });
      break;

    case 'user.media':
      this.api.user.media('islamsobhy1993', function(data) {
        showResults(data);
      });
      break;

    case 'user.search':
      this.api.user.search('islamsobhy199', function(data) {
        showResults(data);
      });
      break;

    case 'user.follows':
      this.api.user.follows('306837613', function(data) {
        showResults(data);
      });
      break;

    case 'user.following':
      this.api.user.following('306837613', function(data) {
        showResults(data);
      });
      break;

    case 'media.get':
      this.api.media.get('575841188878801878_306837613', function(data) {
        showResults(data);
      });
      break;

    case 'media.search':
      this.api.media.search({
        lat: 37.774929,
        lng: -122.419416
      }, function(data) {
        showResults(data);
      });
      break;

    case 'media.popular':
      this.api.media.popular(function(data) {
        showResults(data);
      });
      break;

    case 'media.comments':
      this.api.media.comments('1612999776281004340_6107525298', function(data) {
        showResults(data);
		
		document.getElementById('comments').innerHTML = data.data[0].from.full_name + ': '+data.data[0].text;	

      });
      break;

    case 'media.likes':
      this.api.media.likes('1612999776281004340_6107525298', function(data) {
        showResults(data);
      });
      break;

    case 'tag.get':
      this.api.tag.get('summer', function(data) {
        showResults(data);
      });
      break;

    case 'tag.media':
      this.api.tag.media('summer', function(data) {
        showResults(data);
      });
      break;

    case 'tag.search':
      this.api.tag.search('summer', function(data) {
        showResults(data);
      });
      break;

    case 'location.get':
      this.api.location.get('34998', function(data) {
        showResults(data);
      });
      break;

    case 'location.media':
      this.api.location.media('34998', function(data) {
        showResults(data);
      });
      break;

    case 'location.search':
      this.api.location.search({
        lat: 37.774929,
        lng: -122.419416
      }, function(data) {
        showResults(data);
      });
      break;

    }

  };

  

  
  function showResults(data) {

    Ladda.stopAll();

//var x=JSON.stringify(data.data['username'], null, 4);
//	document.getElementById('welcome').innerHTML =x;	

    var results = JSON.stringify(data, null, '  ');

    sandbox.$overlay.removeClass('overlay--visible');

    setTimeout(function() {
      sandbox.$body.addClass('has-overlay').on('click', hideResultsOnClick);
      centerOverlay();
      sandbox.$overlay.html('<code><pre>' + results + '</pre></code>').addClass('overlay--visible');
    }, 500);

  }

  function hideResultsOnClick(e) {
    if (!sandbox.$overlay.has($(e.target)).length) {
      hideResults();
    }
  }

  function hideResults() {
    sandbox.$body.removeClass('has-overlay').off('click', hideResultsOnClick);
    sandbox.$overlay.removeClass('overlay--visible');

    setTimeout(function() {
      sandbox.$overlay.html('');
    }, 500);

  }
  function centerOverlay() {
    sandbox.$overlay.css({
      width: sandbox.$window.outerWidth() * 0.8,
      height: sandbox.$window.outerHeight() * 0.8
    });

    sandbox.$overlay.css({
      top: sandbox.$window.outerHeight() * 0.5,
      left: sandbox.$window.outerWidth() * 0.5,
      marginLeft: sandbox.$overlay.outerWidth() * -0.5,
      marginTop: sandbox.$overlay.outerHeight() * -0.5
    });

  }

  function onWindowResize() {
    if (sandbox.$overlay.is(':visible')) {
      centerOverlay();
    }
  }

}(window.sandbox = window.sandbox || {}));

$(function() {
  window.sandbox.init();
});

window.partial = function(name, data) {
  return _.template( $('script[name="' + name + '"]').html(), data);
};
