<link rel="stylesheet" href="jquery-ui.min.css">
<link rel="stylesheet" href="style.css">

<div>
    <input type="file" name="meme_bg" value="Upload MEME Image" class="choose-file" onChange="showPreview(this);" />
    <input type="button" name="add_text" value="Add Text" class="btn-add" onClick="createTextArea()" />
</div>

<div id="meme-bg-target">
    <img src="default.jpg" id="img-meme-bg" class="img-meme-bg" />
</div>
<div>
    <input type="button" name="save-as-image" id="save-as-image" class="btn-save" value="Save" />
</div>

<div class="label-preview">Preview</div>
<div id="meme-canvas-container">
    <canvas id="meme-preview"></canvas>
</div>

<script src="jquery-1.11.2.min.js"></script>
<script src="jquery-ui.min.js"></script>

<script>
function showPreview(objFileInput) 
{
    if (objFileInput.files[0]) 
    {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $("#meme-bg-target img").attr('src', e.target.result);
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
    }
}
function createTextArea() 
{
	var txtAreaHTML = "<div contentEditable='true' class='meme-txt-area'></div>";
	$("#meme-bg-target").append(txtAreaHTML);
	$(".meme-txt-area").draggable();
	$(".meme-txt-area").focus();
}

function copyToCanvas(htmlElement) 
{
	var canvas = document.getElementById("meme-preview");
    var ctx = canvas.getContext("2d");

 	image = new Image(0, 0);
    	image.onload = function () {
    		canvas.width = this.naturalWidth;
    	    canvas.height = this.naturalHeight;

    	    var top = 0;
        var left = 0;
        var cellspace = 0;
        var memeTargetWidth = $("#meme-bg-target").width();
        var memeTargetHeight = $("#meme-bg-target").height();
        var font = 24;
        newFont = ( font / memeTargetWidth) * canvas.width;

	      ctx.drawImage(this, 0,0);
          ctx.font = newFont+"px Arial";
    	      ctx.fillStyle = "#00ffe7";

          $(".meme-txt-area").each(function(){

              cellspace = parseInt($(this).css("padding"));
              left = parseInt($(this).css("left")) + cellspace;
              newLeft = ( left / memeTargetWidth) * canvas.width;
              top = parseInt($(this).css("top")) + 3 * cellspace;
              newTop = ( top / memeTargetHeight) * canvas.height;
              ctx.fillText($(this).text(), newLeft, newTop);
    	      });
    	};
    
   image.src = $("#img-meme-bg").attr("src");
}

$(document).ready(function (e) {
	$("#save-as-image").on('click', function () {
     	copyToCanvas($('#meme-bg-target'));
    });
	
});
</script>