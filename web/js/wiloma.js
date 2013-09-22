/* Set the defaults for DataTables initialisation */
$.extend( true, $.fn.dataTable.defaults, {
	"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
	"sPaginationType": "bootstrap",
	"oLanguage": {
		"sLengthMenu": "_MENU_ records per page"
	}
} );


/* Default class modification */
$.extend( $.fn.dataTableExt.oStdClasses, {
	"sWrapper": "dataTables_wrapper form-inline"
} );


/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          oSettings._iDisplayLength === -1 ?
			0 : Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    oSettings._iDisplayLength === -1 ?
			0 : Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
};


/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			$(nPaging).addClass('pagination').append(
				'<ul>'+
					'<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
					'<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
				'</ul>'
			);
			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, ien, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, ien=an.length ; i<ien ; i++ ) {
				// Remove the middle elements
				$('li:gt(0)', an[i]).filter(':not(:last)').remove();

				// Add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li:last', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// Add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li:first', an[i]).addClass('disabled');
				} else {
					$('li:first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li:last', an[i]).addClass('disabled');
				} else {
					$('li:last', an[i]).removeClass('disabled');
				}
			}
		}
	}
} );


/*
 * TableTools Bootstrap compatibility
 * Required TableTools 2.1+
 */
if ( $.fn.DataTable.TableTools ) {
	// Set the classes that TableTools uses to something suitable for Bootstrap
	$.extend( true, $.fn.DataTable.TableTools.classes, {
		"container": "DTTT btn-group",
		"buttons": {
			"normal": "btn",
			"disabled": "disabled"
		},
		"collection": {
			"container": "DTTT_dropdown dropdown-menu",
			"buttons": {
				"normal": "",
				"disabled": "disabled"
			}
		},
		"print": {
			"info": "DTTT_print_info modal"
		},
		"select": {
			"row": "active"
		}
	} );

	// Have the collection use a bootstrap compatible dropdown
	$.extend( true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
		"collection": {
			"container": "ul",
			"button": "li",
			"liner": "a"
		}
	} );
}





$(document).ready(function() {
	 		
	$('#list').dataTable( {
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		}
	} );
	

	
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
	                return true;
	            },
	            success: function(){ 
	        		$('#alertModal').modal('show');

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
	                return true;
	            },
	            success: function(){ 
	                    return true;
	            }
	        });
		}
		//location.reload();
	});
	//\\//\\ *** ************************** *** //\\//\\	 


	
	
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

