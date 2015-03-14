<?php 
include('template/_site_header.php');

if(!isset($_SESSION['account']))
{
  header('location: index.php?suc=4');
}
else
{
require_once("function/utility.php");
$link = connectDB();

//找新pic_no
$sql="SELECT `pic_no` FROM `author` ORDER BY `pic_no` DESC ";
$result=mysql_query($sql, $link); 
$row = mysql_fetch_assoc($result);
$pic_no=$row['pic_no']+1;


//找user_no
$account=$_SESSION['account'];
$sql="SELECT * FROM `user` WHERE `account`='$account'";
$result=mysql_query($sql, $link);
$row = mysql_fetch_assoc($result);
$user_no=$row['user_no'];

//建新圖record
$sql="INSERT INTO `author` (`pic_no`, `user_no`) 
VALUES ('$pic_no', '$user_no')";
mysql_query($sql, $link);

$sql_pic = "INSERT INTO `picture` (`pic_no`) VALUES ('$pic_no')";
mysql_query($sql_pic,$link);
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="scripts/semantic/packaged/javascript/semantic.min.js"></script>
	<script src="scripts/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="scripts/semantic/packaged/css/semantic.min.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
</head>
<script type="text/javascript">
	$(document).ready(function () {
		var x_correct=parseInt($("#outerboard").css("left"))-3;
		var y_correct=parseInt($("#outerboard").css("top"))-3;
  var mx1=0;
  var my1=0;
    var mxorigin=0;
    var myorigin=0;
  var mx = [];
  var my = [];
  var i=0;
  var draging=0
  var pen_width=2;
  var pen_color=7;
  var pic_no=<?php echo "$pic_no"; ?>;
  var undo_order=0;
  var clearall=0;
var c=document.getElementById("myCanvas");
var ctx=c.getContext("2d");
//alert($("#innerboard").css("width"))
//alert($("#innerboard").css("height"))
    c.width=parseInt($("#innerboard").css("width"));
	c.height=parseInt($("#innerboard").css("height"));
    ctx.lineWidth = pen_width*2+1;
    ctx.strokeStyle = '#000000';
/*$(document).ajaxStart(function(){
});
$(document).ajaxStop(function(){
});*/
  $( "#draggable" ).draggable({
      containment: "#innerboard",
      start: function() {
        mxorigin=mx1-9-x_correct;
        myorigin=my1-9-y_correct;
        ctx.beginPath();
        ctx.moveTo(mxorigin,myorigin);
        draging=1;
      },
      drag: function( event ) {
        mx.push(event.pageX-9-x_correct);
        my.push(event.pageY-9-y_correct);
        ctx.lineTo(event.pageX-9-x_correct, event.pageY-9-y_correct);
        ctx.stroke();
      },
      stop: function() {
         $.ajax({
         url: 'function/draw_ajax.php',
         cache: true,
         dataType: 'html',
             type:'POST',
         data: { x0: mxorigin, y0:myorigin, coorx:mx, coory:my, width:pen_width, color:pen_color, order:undo_order, pic_no:pic_no},
         error: function(xhr) {
           alert('Ajax request 發生錯誤');
         },
         success: function(response) {
//var circle= makeSVG('circle',{cx: 100, cy: 50, r:40, stroke: 'black', 'stroke-width': 2, fill: 'red'});

        //document.getElementById('painting').appendChild(response.documentElement);
                   $('.msg').append(response);
            //$(".msg").fadeIn();
                   //$(".msg:eq("+i+")").html(response);
           //$(".msg:eq("+i+")").fadeIn();
         }
        });//end ajax
        //i=i+1;
        mx=[];
        my=[];
      	draging=0;
      	ctx.closePath();
      	ctx.clearRect(0, 0, c.width, c.height);
      	undo_order=undo_order+1;
      }//end stop

  });
  //$(document).mousemove(function ( event ){
  //});
  $("#innerboard").mousemove(function ( event ){
        mx1=event.pageX;
        my1=event.pageY;
  	if(draging==0)
  	{
  		$("#draggable").css("left",event.pageX)
    	$("#draggable").css("top",event.pageY)
  	}
  });
  $( window ).resize(function() {
	x_correct=parseInt($("#outerboard").css("left"))-3;//160
	y_correct=parseInt($("#outerboard").css("top"))-3;
    c.width=parseInt($("#innerboard").css("width"));
	c.height=parseInt($("#innerboard").css("height"));
    ctx.lineWidth = pen_width*2+1;
    colorchange();
});

        function makeSVG(tag, attrs) {
            var el= document.createElementNS('http://www.w3.org/2000/svg', tag);
            for (var k in attrs)
                el.setAttribute(k, attrs[k]);
            return el;
        }

		$("#panel_botton").click( function() {
			if(i==0)
			{
			$("#panel_botton").animate({right:275},330,"easeOutCubic");
				$("#panel").addClass('active');	
				i=1;
			}
			else
			{	
			$("#panel_botton").animate({right:0},330,"easeOutCubic");
				$("#panel").removeClass('active');	
				i=0
			}
			
		})
		$(".width").click( function() {
			pen_width=$(this).index();
			$(".width").removeClass('active');
			$(this).addClass('active');
    		ctx.lineWidth = pen_width*2+1;
		})
		$(".color").click( function() {
			pen_color=$(this).index();
			$(".color").removeClass('active');
			$(this).addClass('active');
			colorchange();
		})
		$(".undo").click(function(){
			undo();
		})//end undo
		$( window ).keypress(function( event ) {//ctrl=122, z=90
    
			if( event.which === 90 && event.shiftKey ) {
        		undo();
        	}
		});

		$(".clearall").click( function() {
			undo_order=0;
			clearall=1;
			$(".painting").remove()
			$.ajax({
         url: 'function/undo.php',
         cache: true,
         dataType: 'html',
             type:'POST',
         data: { order: undo_order, pic_no:pic_no, cate:clearall },
         error: function(xhr) {
           alert('Ajax request 發生錯誤');
         },
         success: function(response) {
         }//end stop
        	});//end ajax
        	clearall=0;
		})

function undo()
{
	undo_order=undo_order-1;
			//undo_order=parseInt($(".painting").size()) -1;
			$(".painting:eq("+undo_order+")").remove()
			$.ajax({
         url: 'function/undo.php',
         cache: true,
         dataType: 'html',
             type:'POST',
         data: { order: undo_order, pic_no:pic_no, cate:clearall},
         error: function(xhr) {
           alert('Ajax request 發生錯誤');
         },
         success: function(response) {
         }//end stop
        	});//end ajax	
}
function colorchange()
{
	if(pen_color==0)
			{
				ctx.strokeStyle='#FF0000';
			}
			else if(pen_color==1)
			{
				ctx.strokeStyle='#FF8000';
			}
			else if(pen_color==2)
			{
				ctx.strokeStyle='#FFFF00';
			}
			else if(pen_color==3)
			{
				ctx.strokeStyle='#00FF00';
			}
			else if(pen_color==4)
			{
				ctx.strokeStyle='#0000FF';
			}
			else if(pen_color==5)
			{
				ctx.strokeStyle='#8A2BE2';
			}
			else if(pen_color==6)
			{
				ctx.strokeStyle='#A757A8';
			}
			else if(pen_color==7)
			{
				ctx.strokeStyle='#000000';
			}
			else if(pen_color==8)
			{
				ctx.strokeStyle='#FFFFFF';
			}
}
});//end ready
</script>
<style type="text/css">
	body{
		margin:0px auto;
		background: url(image/draw_bg.png);
		background-size: 100%;
		cursor: default;
	}
	#outerboard{
		position: absolute;
		left:15%;
		top:15%;
		width:70%;
		height:70%;
	}
	#innerboard {
		width:100%;
		height:100%;
		border-style:solid;
		border-width:4px;
		border-color:#80bf91;
		border-radius: 15px;
		background-color:white; 
	}
	.mainframe
	{
		left:2%;
		width:96%;
	}
	#draggable { width: 4px; height: 4px;}
</style>
<body>
		<div id="outerboard">
			<div id="innerboard" class="msg">
  <canvas id="myCanvas"   width="0px";
  height="0px"; style="position:absolute; z-index:8888;">
Your browser does not support the HTML5 canvas tag.</canvas>						
			</div>	
		</div>	
<div>

    <div id="panel_botton" style="position:relative; float:right; z-index:9998;" class="ui black huge launch left attached toggle button">
      <i class="icon list layout"></i>
    </div>

 <div id="panel" style="background-color:#fcfcfc; z-index:9999;" class="ui red vertical right demo sidebar menu">

 	<div class="item">
    <b>畫筆粗度</b>
    <i class="home icon"></i>
    <div class="menu">
      <a class="item width">1</a>
      <a class="item width">3</a>
      <a class="item width active">5</a>
      <a class="item width">7</a>
      <a class="item width">9</a>
      <a class="item width">11</a>
    </div>
</div>

<div class="item">
    <b>畫筆顏色</b>
    <i class="home icon"></i>
    <div class="menu">
      <a class="item color">紅</a>
      <a class="item color">橙</a>
      <a class="item color">黃</a>
      <a class="item color">綠</a>
      <a class="item color">藍</a>
      <a class="item color">靛</a>
      <a class="item color">紫</a>
      <a class="item color active">黑</a>
      <a class="item color">白</a>
    </div>
</div>
  <a class="item undo">
    <i class="heart icon"></i>
    復原(shift+z)
  </a>
  <a class="item clearall">
    <i class="heart icon"></i>
    重畫
  </a>

  

</div>

</div>



    

	
	<div id="draggable" class="ui-widget-content" style="position:absolute; z-index:9000; opacity:1;">
  	</div>
</body>

</html>