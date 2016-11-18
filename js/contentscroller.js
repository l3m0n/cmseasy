var dir=1
var speed=50
var tab=document.getElementById("demo");
var tab1=document.getElementById("demo1");
var tab2=document.getElementById("demo2");
tab2.innerHTML=tab1.innerHTML
function Marquee(){
 //alert(tab2.offsetWidth+"\n"+tab.scrollLeft)
 
 if (dir<0 &&(tab.scrollLeft<=0)) {//when right running
	 	//dir=1	
	 	tab.scrollLeft = 0.5*tab1.offsetWidth;
	 }
 if (dir>0 &&(tab.scrollLeft>=(tab1.offsetWidth- tab.scrollLeft))) {//left
	 	//dir=-1	
	 	tab.scrollLeft=0;
	 }
 tab.scrollLeft+=dir
 tab.onmouseover=function() {clearInterval(MyMar)}
 tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
}
function r_left(){if (dir=-1)dir=1}
function r_right(){if (dir=1)dir=-1}
function r_f_left(){if (dir=-1)dir=10}
function r_f_right(){if (dir=1)dir=-10}

var MyMar=setInterval(Marquee,speed)