(function($) {
    
	$(function() {
        App.fillSameFields = function() {
            var elems = $('[id*=settings]'),
                first = $(elems[0]);
            /*
            $('.sisyphus').nextAll('form').sisyphus({
                timeout: 3,
                onSave: function() {
                    //console.log('saved');
                }
            });
            */  
            $.each(elems, function(i, el) {
                var el = $(el);
                //console.log(el);
                el.find('.form-actions')
                    .append(
                        $('<a/>', {href:'javascript:void(0)', 'class':'btn'})
                            .html('<i class="arrow-down"></i>Copy link text and url to next form')
                            .bind('click', function() {
                                
                                //$.get(App.URL+'game_and_platform/sisyphus_forms/'+el.data('id'), function() {
                                
                                    var link = el.find('[name=link_text]').val(),
                                        url = el.find('[name=link_url]').val(),
                                        nextForms = el.nextAll('form:first');
                                    
                                    nextForms.find('[name=link_text]').val(link);
                                    nextForms.find('[name=link_url]').val(url.replace(/\?.*/, ''));
                                    
                                    /*nextForms.sisyphus({
                                        timeout: 3,
                                    })*/
                                    
                                    $('[data-countable=1]').trigger('charcounter.recount');
                                    
                                //})
                                
                                return false;
                            })
                    )
                });
        };
        App.fillSameFields();

        
        App.showNotification = function(message) 
        {
            var self = $('#loading-global');
            
            self.html(message).show();
    
            setTimeout(function() {
                self.hide();
                self.html('Working...');
    
            }, 4000)
            
        };	
            
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            showMonthAfterYear:true,
            yearRange: '2010:+5'
        });	  	    
	    
	    //$('#fileupload').fileupload();
	    
	    $('body').delegate('.edit-video', 'click', function() {
	        
	        var self = $(this), form = $('#edit-video-form'), item = self.parents('.item:first');
	        //console.log(form, item);
	        form.find('[name=title]').val(item.find('.title').html());
	        form.find('[name=video]').val(item.find('.video').attr('data-video-id'));
	        form.append($('<input />', {type: 'hidden', name: 'id', value: self.attr('data-id')}));
	        
	        $.scrollTo($('.container'));
	        
	        return false;
	    });

        $('#loading-global')
           .ajaxStart(function() {
                
        		$(this).show();
           })
           .ajaxStop(function() {
        		var self = $(this);
                self.html('Done!');
                
                setTimeout(function() {
                    self.html('Working...');
                    self.hide();
                }, 1500)
            });
        $('body').delegate('a[rel*=dialog]', 'click', function() {
            
            $('.dialog').remove();
            
            var self = $(this);
            
            
            var elem = $('<div />', {'class': 'dialog', id: 'dialog_'+(new Date()).getTime(), title: self.attr('title')}).html('<p style = "width: 300px;text-align:center"><img src = "'+App.URL+'images/pie.gif" /></p>');
    
            elem.dialog({
                modal: false,
                width: 'auto',
                minWidth: 500,
                position:[Math.floor((window.innerWidth / 2)-150),  70],
                open: function(event, ui) {

                    elem.html($('<img />', {src:self.attr('href')}));
                    elem.dialog('option', 'position', [Math.floor(((window.innerWidth  - elem.width()) / 2)), window.pageYOffset]);
                    $('.ui-dialog').css('top',  window.pageYOffset + 70);
                    //alert(window.innerHeight);

                    /*
                    $.get(self.attr('href'), function(response) {
                        elem.html(response);
                        //alert(window.innerHeight);
                        elem.dialog('option', 'position', [Math.floor(((window.innerWidth  - elem.width()) / 2)), window.pageYOffset]);
                        $('.ui-dialog').css('top',  window.pageYOffset + 70);
                        
                        
                        //elem.find('form p:last').append('<button class = "close-dialog">Mégsem</button>');
                    });
                    */
                }
            });
            
            return false;
        });	
        
        $('body').delegate('.close-dialog', 'click', function() {
            
            $('.ui-dialog-titlebar-close').trigger('click');
            
            return false;
        }); 
        
        $(".chosen").chosen({
            no_results_text: "No results matched", 
        }); 
        
        $('.chosen-select-all').bind('click', function(e) {
            e.preventDefault();
            
            var select = $(this).parents('div:first').find('.chosen');
            
            select.find('option').attr('selected', true);
            
            select.trigger("liszt:updated");
        });       
        $('.chosen-cancel-all').bind('click', function(e) {
            e.preventDefault();
            
            var select = $(this).parents('div:first').find('.chosen');
            
            select.find('option').removeAttr('selected');
            
            select.trigger("liszt:updated");
        });  
        
        $('i.w').parents('li').hover(
			function() { $(this).find('i.w').css('opacity', 1); }, 
			function() { $(this).find('i.w').css('opacity', 0.25); }
		)
        
		$('.news-filter-options').bind('click', function() {
		    
		    var self = $(this), i = self.find('i'), klass = i.attr('class');
		    
		    self.parents('fieldset:first').nextAll('fieldset').toggle();
		    
		    		    
		    if (/down/.test(klass)) {

		        i.removeClass('arrow-down').addClass('arrow-up');
		    }
		    else {
		        
    		    if (/up/.test(klass)) {
    		        i.removeClass('arrow-up').addClass('arrow-down');
    		    }
		    }

		    return false;
		});
		
        $("a[rel=popover]")
            .popover()
            .click(function(e) {
                e.preventDefault()
            });
        
        $('a[rel=twipsy]').twipsy();
                	
		prettyPrint() 
          
		
		
    });
	
}) (jQuery);