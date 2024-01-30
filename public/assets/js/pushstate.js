(function( $ ) {

	var el;
    var last_state;
    var base_url;
	$.fn.pushstate = function(options) {
		var defaults = {
            base_url:'',
            onPop : function() {},
            push:function(val){
              //console.log(val);
            },
        };

        var options;
        options = $.extend(defaults, options);
        base_url = defaults.base_url;

        $(document).ready(function(){
	
			$(window).bind("popstate", function(e){	
				setPath();
				e.preventDefault();	
			});

			setPath();
		});

		var func = {
            push: function(title,url,pop) {
            	if(!pop){
            		pop = false;
            	}
              setPushState(title,url,pop);
            }
          };

        return func;
        function setPath(){
			var str = location.href;
			str = str.replace(base_url,'')
			str = str.split('/');
			str = str.splice(1);
			options.onPop(str);
		}

		function setPushState(title,url,pop)
		{
			history.pushState('',title,base_url+'/'+url);
			if(pop){
				setPath();
			}
		}

	}



}( jQuery ));

/*var last_state ="home";
var position_array= new Array();
var curr_menu="",last_menu="";
var list_menu = new Array();

$(document).ready(function(){
	
	$(window).bind("popstate", function(e){	
		setPath();
		e.preventDefault();	
	});

	setPath();
});





function setPath()
{
	var str = location.href;
	str = str.replace(base_url,'')
	str = str.split('/');
	var path = str[0];
	var subpath=str[1];
	var subspath=str[2];

	if(subpath){
		
	}

	if(subspath){
	
	}else{
		
	}
	
	console.log(path,subpath,subspath)	

	curr_menu=path;
	
}

function setPushState(title,url)
{
	history.pushState('',title,base_url+url);	
}*/
