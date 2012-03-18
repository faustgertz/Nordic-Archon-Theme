// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){
	$('.digcontentdata').each(function(){
		var $this = $(this);
		if ($this.find('a.research_add').length == 1 || $this.find('a.research_delete').length == 1) {
			$this.wrapInner('<div class="cart-padding" />');
		}	
	});
	
	// your functions go here

});


/* optional triggers

$(window).load(function() {
	
});

$(window).resize(function() {
	
});

*/