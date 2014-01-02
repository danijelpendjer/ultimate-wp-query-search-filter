jQuery(document).ready(function($) {

	
	$('.closex').on('click', function() {
		jQuery.ajax({
				 type: 'POST',	 
				 url: ajaxurl,
				 data: ({action : 'remove_dona' }),
				 success: function(html) {
					$('.donation').remove();
				 }
				 });
		
		
		return false;	
	});
	$('.adduTaxo').on('click',function() {
		adduTaxoAjax();
		
		return false;
	});
	
	$('.adduCmf').on('click',function() {
		adduCmfAjax();
		return false;
	});
	
	$('.genv').on('click',function() {
		generate_value_ajax();
		return false;
	});
	
	   	
	$("#wpcontent").on('click','.removediv',function(e) {
	   e.preventDefault();
		$(this).parent().css("background-color","#FF3700");
	    	$(this).parent().fadeOut(400, function(){
		    $(this).parent().remove();
		});
	    return false;
	});
	
	$("#numberpost").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
	
	function adduTaxoAjax(){
				var gettaxodata = $("#addTaxoForm :input").serialize();
				var tbl = $('div.taxodragbox:last');			
		                counter = tbl.find('#taxcounter').val();	
				if(!counter) {counter = 0;}else{ counter++;}
				jQuery.ajax({
				 type: 'POST',	 
				 url: ajaxurl,
				 data: ({action : 'uwpqsfTaxo_ajax', gettaxodata:gettaxodata,counter:counter }),
				 success: function(html) {
				
				 $('.taxobox').last().append(html);
				taxo = $('#pretax').val(''); 
				label = $('#prelabel').val('');
				text = $('#preall').val('');
				excl = $('#preexclude').val('');
				type = $('input[name=displyatype]').prop('checked', false);
				hide = $('input[name=pre_hide_empty]').prop('checked', false);
				operator = $('input[name=pre_operator]').prop('checked', false);
				
				 }
				 });
		}
		
	function adduCmfAjax() {
		var getcmfdata = $("#addCmfForm :input").serialize();
		
		var tbl = $('div.cmfdragbox:last');		
		cmfcounter = tbl.find('#cmfcounter').val();	
		if(!cmfcounter) {cmfcounter = 0;}else{ cmfcounter++;}
		
		jQuery.ajax({
				 type: 'POST',	 
				 url: ajaxurl,
				 data: ({action : 'uwpqsfCmf_ajax', getcmfdata:getcmfdata,cmfcounter:cmfcounter,type:'form'  }),
				 success: function(html) {
			
				$('.cmfbox').last().append(html);
				$('#precmfkey').val(""); 
				$('#precmflabel').val(""); 
				$('#precmfall').val("");
				$('#precompare').val(""); 
				$('#preopt').val(""); 
			
				
				 }
				 });
		
	}

	function generate_value_ajax(){

		key = $('#precmfkey').val(); 
		if(!key) {alert("You must select a mete key first"); return;}	
		jQuery.ajax({
				 type: 'POST',	 
				 url: ajaxurl,
				 data: ({action : 'uwpqsfCmf_ajax',key:key,type:'meta'  }),
				 success: function(html) {
			
					$('#preopt').val(html);
				
				 }
				 });
	}

	//var $content = $(".content").hide();
	
		 $("#wpcontent").on("click",".toggle", function(e){
			$(this).parent().parent().find('.taxodragbox').slideToggle();
	    		//$(this).toggleClass("hide");
			$(this).toggleClass("minus");
	    		//$(this).next('.content').slideToggle();
	  	});	

		$("#wpcontent").on("click",".toggle2", function(e){
			$(this).parent().parent().find('.cmfdragbox').slideToggle();
	    		//$(this).toggleClass("hide");
			$(this).closest('.plus').toggleClass("minus");
	    		//$(this).next('.content').slideToggle();
	  	});
	 $( ".taxobox, .cmfbox" ).sortable();

	$("#wpcontent").on('click', "#ajaxckc", function(e){  
		 if ($(this).is(':checked') ){
		     if($(this).val() == '1'){	
			$('#resdiv').prop('disabled',false);$('#resdiv').removeClass('inactive');}
		     if($(this).val() == '2'){	
			$('#resdiv').prop('disabled',true);$('#resdiv').addClass('inactive');}
		 }
	});

	$('.uorderby').change(function(){ 
		if($(this).val() == 'meta_value' || $(this).val() == 'meta_value_num'){
			
			$('#ormkey').prop('disabled',false);$('#ormkey').removeClass('inactive');

		}else{

			$('#ormkey').prop('disabled',true);$('#ormkey').addClass('inactive');
		}
	});
});  
