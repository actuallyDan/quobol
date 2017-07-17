$(document).ready(function(){

$('#slide-out2').hide();
$('#customLocationHiddenField').hide();
$('#searchBar').hide();
$('.timestamp').hide();

if ($(window).width() <= 992){
	$('#eventChatInput').hide();
}
$('#customLocation').click(function() {
	$('#customLocationHiddenField').toggle(100);
});

$('#toggleSearchBar').click(function() {
	$('#searchBar').toggle('fade', 350);
	$('#searchBarInputField').focus();
	$('searchBar').toggleClass('fullscreenMain', 300);
});
$('#closeSearchBar').click(function() {
	$('#searchBar').toggle('fade', 350);

});

$('.queueItemsFull').click(function(){
	$('.queueItemsFull').removeClass('queueItemEnabled');
	$(this).toggleClass('queueItemEnabled');
});


$('.clickToShowTime').click(function(){
	$('.timestamp').hide(250);
	$(this).next('.timestamp').show(250);
});



$('#toggleFollowEvent').click(function(){
	var title = $(this).attr('data-event-title');
	var eventId = $(this).attr('data-event-id');

	if ($(this).hasClass('fa-plus-square')) {
		//Materialize.toast(message, displayLength, className, completeCallback);
		Materialize.toast(title + ' added to Queue', 3000); // 4000 is the duration of the toast
		$(this).removeClass('fa-plus-square') ;
		$(this).addClass('fa-minus-square') ;
		//ajax call to add quip to user's queue and subscribe to event
		var ajaxurl = 'index.php',
		data =  {'ajaxAction': 'followEvent', 'id': eventId };
		$.post(ajaxurl, data, function (response) {
		// Response div goes here.
			$('#beginQueueRefresher').load('index.php #myQueue'); 
			var page = window.location.href;
			$('#allThingsEventChat').load(page + ' #beginRefreshChat', function() {
  			$.getScript('js/messenger.js');
  			$('.timestamp').hide();
  			})
		});

	} else if ($(this).hasClass('fa-minus-square')){
		Materialize.toast(title + ' removed from Queue', 3000); // 4000 is the duration of the toast
		$(this).removeClass('fa-minus-square') ;
		$(this).addClass('fa-plus-square') ;
		//ajax call to remove quip from user's queue and subscribe to event
		var ajaxurl = 'index.php',
		data =  {'ajaxAction': 'unfollowEvent', 'id': eventId };
		$.post(ajaxurl, data, function (response) {
		// Response div goes here.
			$('#beginQueueRefresher').load('index.php #myQueue');
			var page = window.location.href;
			$('#allThingsEventChat').load(page + ' #beginRefreshChat');
		});
	}

	});

$('.button-collapse').sideNav({
      menuWidth: 200, // Default is 240
  });
$('.modal-trigger').leanModal({
      opacity: 0, // Opacity of modal background
      in_duration: 250, // Transition in duration
      out_duration: 250, // Transition out duration
  }
  );
$('.modal-trigger2').click(function(){
  $('#modal2').openModal({
	dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: 0.5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
  });

});

$("#toggleQueue").click(function () {
	$('#slide-out2').toggle('slide', 'left',  350);
	$('.main').toggleClass('fullscreenMain', 300);
});

//specify elements in main body to load by id
$('#loadContact').click(function(){
	var page = $(this).attr('href');
	$('#content').load(page + ' .row');
	return false;
});
$('#loadBlog').click(function(){
	var page = $(this).attr('href');
	$('#content').load(page + ' #newsColumn');
	return false;
});
$('#toggleQueueMobile').click(function(){
	var page = $(this).attr('href');
	$('#content').load(page + ' #queueForMobile');
	$('.button-collapse').sideNav('hide');
	return false;

});


///////////////////////////////
//login.php
$('#registerForm').hide();
	$('#showRegisterForm').addClass('text-blue-darker');
	$('#forgotPassword').hide();


	$('#showRegisterForm').click(function(){
		$('#loginForm').hide();
		$('#forgotPassword').hide();
		$('#registerForm').show('fade', 550);
		$('#showRegisterForm').removeClass('text-blue-darker');
		$('#forgotPassword').addClass('text-blue-darker');
		$('#showLoginForm').addClass('text-blue-darker');
		$('#showForgotPassword').removeClass('white-text');
		$('#showForgotPassword').addClass('text-blue-darker');

	});

	$('#showLoginForm').click(function(){
		$('#registerForm').hide();
		$('#forgotPassword').hide();
		$('#loginForm').show('fade', 550);
		$('#showRegisterForm').addClass('text-blue-darker');
		$('#forgotPassword').addClass('text-blue-darker');
		$('#showLoginForm').removeClass('text-blue-darker');
		$('#showForgotPassword').removeClass('white-text');
		$('#showForgotPassword').addClass('text-blue-darker');


	});
		$('#showForgotPassword').click(function(){
		$('#registerForm').hide();
		$('#loginForm').hide();
		$('#forgotPassword').show('fade', 550);
		$('#showRegisterForm').addClass('text-blue-darker');
		$('#showLoginForm').addClass('text-blue-darker');
		$('#showForgotPassword').addClass('white-text');
		$('#showForgotPassword').removeClass('text-blue-darker');
	});
//// user page//
//////////////////profilepic

$('#closeErrorMessage').click(function(){
	$('#modalError').fadeOut(100);
});

//event messages scrollfire
	var options = [
    {selector: '#eventInfo', offset: 400, callback: '$("#eventChatInput").fadeIn(250)' }
    ];
	Materialize.scrollFire(options);

//event message grow
$('#eventChatInput').on( 'keyup', 'textarea', function (){
    $(this).height( 0 );
    $(this).height( this.scrollHeight );
});
$('#eventChatInput').find( 'textarea' ).keyup();

});
