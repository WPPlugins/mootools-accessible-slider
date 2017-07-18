window.addEvent('domready', function(){

	var el = document.id('sliderMooToolsAccessible'),
		posts = document.id('areaBSliderMooToolsAccessible');

	var slider = new Slider(el, el.getElement('.knob'), {
		steps: 10,
		initialStep: 0,
		range: [0, 10],
		onComplete: function(value) {
            		if (value) {
				console.log("onComplete with value: " + value);
				updateSliderLabels(parseInt(value,10));
				ajaxRequest(value);
			}
        	},
		onChange: function(value){
			if (value) {
				console.log("onChange with value: " + value);
				updateSliderLabels(value);
				ajaxRequest(value);
			}
		}
	});
	
	slider.set(slider.options.initialStep);
    	document.id('slider1ValMooToolsAccessible').position({
        	relativeTo: el.getElement('.knob'),
	        position: 'upperLeft',
	        edge: 'bottomRight'
	});
	
    	document.id('slider1ValMooToolsAccessible').set('text', '#' + slider.options.initialStep);
	
	function updateSliderLabels(value) {
		console.log("updateSliderLabels with value: " + value);
        	document.id('slider1ValMooToolsAccessible').position({
        	    	relativeTo: el.getElement('.knob'),
            		position: 'upperLeft',
		        edge: 'bottomRight'
        	});
        	document.id('slider1ValMooToolsAccessible').set('text', '#' + value);
    	}
	
	function ajaxRequest(value) {
        	console.log("ajaxRequest with value: " + value);
        	var jsonRequest = new Request.JSON({
            	url: 'wp-content/plugins/mootools-accessible-slider/getRecentPostsAjax.php',
            	onSuccess: function(msg){
            		console.log("onSuccess with msg: " + msg.list);
                	posts.empty();
                	posts.erase("style");
                	posts.set('html', '<ul>' + msg.list + '</ul>');
            	}
        	}).get({'postsNum' : value});
    	}
});
