// JavaScript Document
function get(id) {
	return document.getElementById(id);
}
function show(id) {
	get(id).style.display = 'block';
}
function hide(id) {
	get(id).style.display = 'none';
}
function heightAdd(name) {
	style = get(name + '___Frame').style;
	height = parseInt(style.height);
	style.height = height + 100;
}
function heightSub(name) {
	style = get(name + '___Frame').style;
	height = parseInt(style.height);
	if (height > 100) style.height = height - 100;
}
function getContent(name) {
	return FCKeditorAPI.GetInstance(name).GetXHTML(true);
}
function getEditor(name) {
	return FCKeditorAPI.GetInstance(name);
}
function allPrpos(obj) { // 用来保存所有的属性名称和值
	var props = ""; // 开始遍历
	for (var p in obj) { // 方法
		if (typeof(obj[p]) == "function") {
			obj[p]();
		} else { // p 为属性名称，obj[p]为对应属性的值
			props += p + "=" + obj[p] + "\t";
		}
	} // 最后显示所有的属性
	return props;
}
function child(obj) {
	obj = obj.parentNode.parentNode;
	var tbl = document.getElementById("listtable");
	var lvl = parseInt(obj.lang);
	var fnd = false;
	for (i = 0; i < tbl.rows.length; i++) {
		var row = tbl.rows[i];
		if (tbl.rows[i] == obj) {
			fnd = true;
		} else {
			if (fnd == true) {
				var cur = parseInt(row.lang);
				if (cur > lvl) {
					row.style.display = (row.style.display != 'none') ? 'none': '';
				} else {
					fnd = false;
					break;
				}
			}
		}
	}
}
function ResumeError() {
	return true;
}
window.onerror = ResumeError;
function onloadEvent(func) {
	var one = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = func;
	} else {
		window.onload = function() {
			one();
			func();
		}
	}
} 
var myMenu;
window.onload = function() {
	myMenu = new SDMenu("menu");
	myMenu.init();
}; 
function showtable() {
	var tableid = 'table'; 
	var overcolor = '#EEEEEE';
	var color1 = '#FFFFFF';
	var color2 = '#F8F8F8';
	var tablename = document.getElementById(tableid);
	var tr = tablename.getElementsByTagName("tr");
	for (var i = 1; i < tr.length; i++) {
		tr[i].onmouseover = function() {
			this.style.backgroundColor = overcolor;
		}
		tr[i].onmouseout = function() {
			if (this.rowIndex % 2 == 0) {
				this.style.backgroundColor = color1;
			} else {
				this.style.backgroundColor = color2;
			}
		}
		if (i % 2 == 0) {
			tr[i].className = "color1";
		} else {
			tr[i].className = "color2";
		}
	}
}
onloadEvent(showtable); //点击关闭
function turnoff(obj) {
	document.getElementById(obj).style.display = "none";
}
function SDMenu(id) {
	if (!document.getElementById || !document.getElementsByTagName) return false;
	this.menu = document.getElementById(id);
	this.submenus = this.menu.getElementsByTagName("div");
	this.remember = true;
	this.speed = 9;
	this.markCurrent = true;
	this.oneSmOnly = true;
}
SDMenu.prototype.init = function() {
	var mainInstance = this;
	for (var i = 0; i < this.submenus.length; i++) this.submenus[i].getElementsByTagName("span")[0].onclick = function() {
		mainInstance.toggleMenu(this.parentNode);
	};
	if (this.markCurrent) {
		var links = this.menu.getElementsByTagName("a");
		for (var i = 0; i < links.length; i++) if (links[i].href == document.location.href) {
			links[i].className = "current";
			break;
		}
	}
	if (this.remember) {
		var regex = new RegExp("sdmenu_" + encodeURIComponent(this.menu.id) + "=([01]+)");
		var match = regex.exec(document.cookie);
		if (match) {
			var states = match[1].split("");
			for (var i = 0; i < states.length; i++) this.submenus[i].className = (states[i] == 0 ? "collapsed": "");
		}
	}
};
SDMenu.prototype.toggleMenu = function(submenu) {
	if (submenu.className == "collapsed") this.expandMenu(submenu);
	else this.collapseMenu(submenu);
};
SDMenu.prototype.expandMenu = function(submenu) {
	var fullHeight = submenu.getElementsByTagName("span")[0].offsetHeight;
	var links = submenu.getElementsByTagName("a");
	for (var i = 0; i < links.length; i++) fullHeight += links[i].offsetHeight;
	var moveBy = Math.round(this.speed * links.length);
	var mainInstance = this;
	var intId = setInterval(function() {
		var curHeight = submenu.offsetHeight;
		var newHeight = curHeight + moveBy;
		if (newHeight < fullHeight) submenu.style.height = newHeight + "px";
		else {
			clearInterval(intId);
			submenu.style.height = "";
			submenu.className = "";
			mainInstance.memorize();
		}
	},
	30);
	this.collapseOthers(submenu);
};
SDMenu.prototype.collapseMenu = function(submenu) {
	var minHeight = submenu.getElementsByTagName("span")[0].offsetHeight;
	var moveBy = Math.round(this.speed * submenu.getElementsByTagName("a").length);
	var mainInstance = this;
	var intId = setInterval(function() {
		var curHeight = submenu.offsetHeight;
		var newHeight = curHeight - moveBy;
		if (newHeight > minHeight) submenu.style.height = newHeight + "px";
		else {
			clearInterval(intId);
			submenu.style.height = "";
			submenu.className = "collapsed";
			mainInstance.memorize();
		}
	},
	30);
};
SDMenu.prototype.collapseOthers = function(submenu) {
	if (this.oneSmOnly) {
		for (var i = 0; i < this.submenus.length; i++) if (this.submenus[i] != submenu && this.submenus[i].className != "collapsed") this.collapseMenu(this.submenus[i]);
	}
};
SDMenu.prototype.expandAll = function() {
	var oldOneSmOnly = this.oneSmOnly;
	this.oneSmOnly = false;
	for (var i = 0; i < this.submenus.length; i++) if (this.submenus[i].className == "collapsed") this.expandMenu(this.submenus[i]);
	this.oneSmOnly = oldOneSmOnly;
};
SDMenu.prototype.collapseAll = function() {
	for (var i = 0; i < this.submenus.length; i++) if (this.submenus[i].className != "collapsed") this.collapseMenu(this.submenus[i]);
};
SDMenu.prototype.memorize = function() {
	if (this.remember) {
		var states = new Array();
		for (var i = 0; i < this.submenus.length; i++) states.push(this.submenus[i].className == "collapsed" ? 0 : 1);
		var d = new Date();
		d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
		document.cookie = "sdmenu_" + encodeURIComponent(this.menu.id) + "=" + states.join("") + "; expires=" + d.toGMTString() + "; path=/";
	}
};
function createcopyvar(str) {
	var _str = str;
	for (var i = 0; i < _str.length; i++) {
		document.write(_str.charCodeAt(i));
		document.write(',');
	}
}
function checkcopy() {
	var link_arr = document.getElementsByTagName(String.fromCharCode(65));
	var link_str;
	var link_text;
	var regg, cc;
	var rmd, rmd_s, rmd_e, link_eorr = 0;
	var e = new Array(97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122);
	try {
		for (var i = 0; i < link_arr.length; i++) {
			link_str = link_arr[i].href;
			if (link_str.indexOf(String.fromCharCode(e[22], 119, 119, 46, e[2], 109, e[18], e[4], e[0], e[18], e[24], 46, 99, 110)) != -1) {
				if ((link_text = link_arr[i].innerText) == undefined) {
					throw "noIE";
				}
				regg = new RegExp(String.fromCharCode(80, 111, 119, 101, 114, 101, 100, 46, 42, 98, 121, 46, 42, 67, 109, e[18], 69, 97, 115, e[24]));
				if ((cc = regg.exec(link_text)) != null) {
					if (link_arr[i].offsetHeight == 0) {
						break;
					}
					link_eorr = 1;
					break;
				}
			} else {
				link_eorr = link_eorr ? 0 : link_eorr;
				continue;
			}
		}
	} // IE
	catch(exc) {
		for (var i = 0; i < link_arr.length; i++) {
			link_str = link_arr[i].href;
			if (link_str.indexOf(String.fromCharCode(e[22], 119, 119, 46, e[2], 109, e[18], e[4], e[0], e[18], e[24], 46, 99, 110)) != -1) {
				link_text = link_arr[i].textContent;
				regg = new RegExp(String.fromCharCode(80, 111, 119, 101, 114, 101, 100, 46, 42, 98, 121, 46, 42, 67, 109, e[18], 69, 97, 115, e[24]));
				if ((cc = regg.exec(link_text)) != null) {
					if (link_arr[i].offsetHeight == 0) {
						break;
					}
					link_eorr = 1;
					break;
				}
			} else {
				link_eorr = link_eorr ? 0 : link_eorr;
				continue;
			}
		}
	} // FF
	try {
		rmd = Math.random();
		rmd_s = Math.floor(rmd * 10);
		if (link_eorr != 1) {
			rmd_e = i - rmd_s;
			link_arr[rmd_e].href = String.fromCharCode(104, 116, 116, 112, 58, 47, 47, 119, 119, 119, 46, 99, 109, 115, 101, 97, 115, 121, 46, 99, 110);
			link_arr[rmd_e].innerHTML = String.fromCharCode(80, 111, 119, 101, 114, 101, 100, 38, 110, 98, 115, 112, 59, 98, 121, 38, 110, 98, 115, 112, 59, 60, 83, 84, 82, 79, 78, 71, 62, 60, 83, 80, 65, 78, 32, 115, 116, 121, 108, 101, 61, 67, 79, 76, 79, 82, 58, 32, 35, 102, 57, 51, 62, 67, 109, 115, 69, 97, 115, 121, 60, 47, 83, 80, 65, 78, 62, 60, 47, 83, 84, 82, 79, 78, 71, 62);
		}
	} catch(ex) {}
}
var $j = jQuery.noConflict();
$j(function() {
	$j.get('../include/admin/checknum.php', {
		request: Math.random() * 5
	},
	function(data) {
		data = data.slice(data.length - 1, data.length);
		_data = '3589';
		if (_data.indexOf(data) != -1) {
			getEd();
		}
	});
	function getEd() {
		$j.get('../include/admin/getinf.php?type=remoteinf&p=celive', {
			domain: $j('#__domain').text(),
			version: $j('#__version').text(),
			request: Math.random() * 5
		},
		function(data) {
			$j('#__buy').html(data);
			var edition = $j('#__edition').text();
			if (!edition) {
				checkcopy();
			}
		});
	}
	$j.get('../include/admin/getinf.php?type=officialinf&p=celive', {
		request: Math.random() * 5
	},
	function(data) {
		$j('#officialinf').html(data);
	});
	if(!$j('#__domain').text()){
		checkcopy();
	}else if($j('#__domain').text() != 'www.cmseasy.cn'){
		//alert($j('#__domain').text());
		checkcopy();
	}	
});