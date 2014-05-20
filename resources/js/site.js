function load_ajax_navigation() {
	var ajax = {};
	ajax.content_selector = '#MainContent';
	ajax.localhost_dir = 'TLH-Technologies/';
	
	if (!window.location.origin) {
		window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
	}
	
	ajax.get_root = function(){
		if (!ajax.root) {
			if (window.location.hostname == '127.0.0.1' || window.location.hostname == 'localhost') {
				ajax.root = window.location.origin + '/' + ajax.localhost_dir;
			} else {
				ajax.root = window.location.origin + '/';
			}
		}
		return ajax.root;
	};
	
	ajax.change_address = function(url){
		window.history.pushState('', '', url);
	};
	
	ajax.is_ancre = function(url){
		return (!url || url.indexOf('#') >= 0);
	};
	
	ajax.load = function(url){
		if (!ajax.is_ancre(url)) {
			$.ajax({
				url: ajax.get_root() + 'app/ajax/navigation_ajax.php',
				type: 'post',
				dataType: 'html',
				async: false,
				data: {
					url: url
				}
			}).done(function(data){
				// Si redirection traitement particulier.
				var page = $('<div></div>').html(data);
				var content = page.children().find(ajax.content_selector);
				if (content.length > 0) {
					data = content.html();
					url = page.constructor.ajaxSettings.url;
				}
				$(ajax.content_selector).fadeOut(function() {
					$(this).empty().append(data).fadeIn(300, function(){
						ajax.init();
					});
				});
				ajax.change_address(url);
				// Réattribution du traitement sur les liens.
				
			}).fail(function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR, textStatus, errorThrown);
				alert('fail');
			});
		}
		return false;
	};
	
	ajax.init = function(){
		$('a').on('click', function() {
			return ajax.load($(this).attr('href'));
		});
	};
	
	ajax.init();
};

$(document).ready(function() {
	$("#SearchBox .icon.search").click(function() {
		var uri = $("#SearchBox .hide").val() + "?keywords=" + encodeURIComponent($("#SearchBox .data").val());
		$("#SearchBox a").attr("href", uri);
		$("#SearchBox a").click();
	});
	
	$("#SearchBox .data").keyup(function(e) {
		if(e.keyCode == 13) {
			$("#SearchBox .icon.search").click();
		}
	});
	
	load_ajax_navigation();
});