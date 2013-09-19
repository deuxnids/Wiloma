
$(document).ready(function() {
	 
	$( "#wlm_Operationbundle_Operationtype_code" ).keypress(function( event ) {
			console.log("sd");
		});
	
	//\\//\\ *** location return functions *** //\\//\\
	$(".locationReturned").each(function (i) {
		if($(this).attr('status')=="in"){
			$(this).attr('checked',true);
		}
		else{
			$(this).attr('checked',false);
		}
	});
	
	$(".locationReturned").click(function () {
		if($(this).is(':checked')){
	        $.ajax({
	            url: $(this).attr('pathSetIn'),
	            type: 'POST',
	            async: true,
	            error: function(){
	            	bootstrap_alert.warning('ERROR');
	                return true;
	            },
	            success: function(){ 
	            	bootstrap_alert.warning('Your text goes here');
	            	
	                    return true;
	            }
	        });

	        
	        
		}
		else{
	        $.ajax({
	            url: $(this).attr('pathSetOut'),
	            type: 'POST',
	            async: true,
	            error: function(){
	            	bootstrap_alert.warning('ERROR');
	                return true;
	            },
	            success: function(){ 
	            	bootstrap_alert.warning('Your text goes here');
	                    return true;
	            }
	        });
		}
		//location.reload();
	});
	//\\//\\ *** ************************** *** //\\//\\	 

	//\\//\\ *** alert *** //\\//\\

	
	
	bootstrap_alert = function() {}
	bootstrap_alert.warning = function(message) {
	            $('#alert_placeholder').html('<div class="alert"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
	}
	
	alert_modal = function() {}
	alert_modal.warning = function(message) {
	            $('#alert_placeholder_modal').html('<div class="alert"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
	}
	
	
	//\\//\\ *** ************************** *** //\\//\\	 

	//\\//\\ *** payment functions *** //\\//\\
    $('#payButton').click(function(e) {  
        e.preventDefault();
        $total = 0;
        $('div .price').each(function(){  
        	if ($(this).parents('tr').is(":visible")){
                $total = $total + parseFloat($(this).html());  
                $.post($(this).attr('pathAtt'));
        	}
        });
        location.reload();
    });
	//\\//\\ *** ************************** *** //\\//\\	 

	//\\//\\ *** petit cheni*** //\\//\\
   
    $("#modal-form-submit").click(function() {
		  $("#modal-form").submit();
	  });

	  $("form input.date").datepicker({
		  	format: 'dd-mm-yyyy'
	  });

    $('#modal').modal('show');

    $('a.tip-top').on('click', function(e) {  
        e.preventDefault();
        $(this).parents('tr').hide();
        calcAmount();
    });
    
    $('a.reload-facturation').on('click', function(e) {  
  	  e.preventDefault();
  	  $('a.tip-top').parents('tr').show();
        calcAmount();
    });

    function calcAmount() {
        $total = 0;
        $('div .price').each(function(){  
      	if ($(this).parents('tr').is(":visible")){
              $total = $total + parseFloat($(this).html());        		
      	}
        });
        $("#total").html($total);
    }
	//\\//\\ *** ************************** *** //\\//\\	 
   
    
    
	//\\//\\ *** add location functions *** //\\//\\
	var barcode = $('.barcode-id');
	var outDate = $('.outDate-id');
	var inDate  = $('.inDate-id');
	var table   = $('.table');
    entityArray = new Array(outDate,inDate,barcode);

	writeIndexData(entityArray);
	
    $("#btn_add").on('click', function(e) {
	      e.preventDefault();
	      
	      addForm(entityArray, table);
	      
	   
	      // add datepicker to the new input date
	      $("form input.date").datepicker({
	          format: 'dd-mm-yyyy'
	        });
	      $('[rel=tooltip]').tooltip();
	      $('a.tip-top').on('click', function(e) {  
	          e.preventDefault();
	          $(this).parents('tr').remove();
	          indexMinus(entityArray);
	      });
	      
	    	//\\//\\ *** equipment query *** //\\//\\
	    	$("form input.barcode-id").keypress(function(){
	        	alert_modal.warning('Your text goes here');
	        	console.log('asda');
	    	});
      });

  
  function addForm(entityArray) {
	  var newRow = '<tr>';
	  for ( var i in entityArray ) {
		  var newForm  = getForm(entityArray[i]);
		  newRow = newRow + '<td>'+newForm+'</td>';
		}
	  newRow = newRow + '<td class="taskOptions"> \
	  					 	<a href="#" rel="tooltip" data-toggle="modal" class="tip-top" data-original-title="Delete Row">\
	  							<i class="icon-remove"></i>\
	  					 	</a>\
	  					</td> \
	  					</tr>';
	  newRow = $(newRow);
      newRow.appendTo($('#addLocationTable'));
  }
  
  function getForm(entity){
      var index = entity.data('index');
      console.log(index);
	  var prototype = entity.attr('data-prototype');
      var form = '<div class="span1">'+prototype.replace(/__name__/g, index)+"</div>";
      entity.data('index', index + 1);
      
	  return form;
  }
  
  function writeIndexData(myArray){
	  for ( var i in myArray ) {
	      myArray[i].data('index', myArray[i].find(':input').length);
		}
  }
  
  function indexMinus(myArray){
	  for ( var i in myArray ) {
	      var index = myArray[i].data('index');
	      myArray[i].data('index', index-1 );
		}
  }
  
      
	//\\//\\ *** ************************** *** //\\//\\	      
});

