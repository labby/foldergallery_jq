/**
 *  @module         foldergallery
 *  @version        see info.php of this module
 *  @author         cms-lab (initiated by Jürg Rast)
 *  @copyright      2010-2018 cms-lab 
 *  @license        GNU General Public License
 *  @license terms  see info.php of this module
 *  @platform       see info.php of this module
 * 
 */
 
$(document).ready(function(){ 
	$(function() { 
		$("#fg_cat_table tr").sortable(
		    {
		        opacity: 0.6,
		        cursor: 'move',
		        connectWith: "tr",
		        update: function( event, ui) { 
                    /*
                    var order = $(this).sortable("serialize") + '&action=updateRecordsListings&parent_id='+the_parent_id+'&leptoken='+leptoken; 		
                    $.post(LEPTON_URL+"/modules/foldergallery/reorderDND.php", order, function(theResponse){ 
                        //$("#dragableResult").html(theResponse);
                        //console.log("res: "+theResponse); 
                    });
                    */
                    console.log("res: "+$(this).sortable( "toArray" )); 
                   //  console.log("res: "+event); 
                } 
		    }
		); 
	}); 
 }); 
$("#fg_cat_table tr").disableSelection();

// Remember to invoke within jQuery(window).load(...)
// If you don't, Jcrop may not initialize properly

var aTemp = window.location.pathname.split("/");
var sFilename = aTemp[ aTemp.length -1 ];
console.log( sFilename );

if(sFilename == "modify_thumb.php") {
    
    $(window).load(function(){
    
        if(typeof settingsRatio == "undefined") var settingsRatio = "1"; 
		
    	$('#cropbox').Jcrop({
            onChange: showPreview,
            onSelect: updateCoords,
            aspectRatio: settingsRatio
        });    
    });
}

function showPreview(coords)
{
	var imgWidth = $("#cropbox").width();
	var scale = relWidth / imgWidth;
	
	if  (settingsRatio > 1) {
		var rx = thumbSize / coords.w;
		var ry = thumbSize / settingsRatio / coords.h;
	}
	else {
		var rx = thumbSize * settingsRatio / coords.w;
		var ry = thumbSize / coords.h;
	}
	
	$('#preview').css({
		width: Math.round(rx * relWidth / scale) + 'px',
		height: Math.round(ry * relHeight / scale) + 'px',
		marginLeft: '-' + Math.round(rx * coords.x) + 'px',
		marginTop: '-' + Math.round(ry * coords.y) + 'px'
	});

};


function updateCoords(c)
{
	var imgWidth = $("#cropbox").width();
	var scale = relWidth / imgWidth;

	$('#x').val(c.x * scale);
	$('#y').val(c.y * scale);
	$('#w').val(c.w * scale);
	$('#h').val(c.h * scale);
};

function checkCoords()
{
	if (parseInt($('#w').val())) return true;
	alert('Please select a crop region then press submit.');
	return false;
};

