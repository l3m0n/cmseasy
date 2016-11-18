<!DOCTYPE html>
<html>
<head>
<title><?php echo get('sitename');?>管理登录 - Powered by CmsEasy</title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="{$skin_path}/css/login.css" type="text/css" media="all"  />
<link title="skin1" href="{$skin_path}/css/admin_style_a.css" type="text/css" rel="alternate stylesheet" disabled />
<script type="text/javascript" src="{$skin_path}/js/jquery-1.11.2.min.js"></script>
</head>
<body>
<div id="container">
    <div id="anitOut"></div>
</div>

<div class="box">
<div class="logo">
<a title="{get(sitename)}" href="{$base_url}/"></a>
</div>


<div id="login">

<div class="login">


<h3>Admin <span>Login</span></h3>
<div class="blank10"></div>
<div class="line"></div>

<?php
    if(!get('submit')) flash();
    if(!get('submit') || hasflash()) {
?>



<ul>
<form name="loginform" action="<?php echo uri();?>" method="post" onsubmit="return Dcheck();">
<input type="hidden" name="submit" value="提交">
<li><input name="username" type="text" id="username" id="username" value="{get('username')}" tabindex="1" /></li>
<li><input name="password" type="password" id="password" value="<?php //echo $password;?>" tabindex="2" /></li>


{if config::get('mobilechk_enable') && config::get('mobilechk_admin')}
<style type="text/css">
#tel {width:290px;
margin:10px 0px;
height:28px;
  line-height:28px;
  padding:0px 10px 0px 50px;
  border:1px solid #ccc;
border-radius: 5px;}
#select {width:290px;}

#mobilenum { float:left; width:140px; border:1px solid #ccc; height:26px; line-height:26px; padding:0px 10px;border-radius: 5px;}
#btm_sendMobileCode { float:right; width:180px; border:1px solid #ccc; height:28px; line-height:28px; padding:0px 10px;border-radius: 5px;}
</style>

<script src="{$base_url}/js/mobilechk.js"></script>
<input placeholder="{lang(tel)}" type='text' id="tel"  name="tel" value="" tabindex="3" class="input" />
<div class="blank20"></div>
<input id="btm_sendMobileCode" onclick="sendMobileCode('{url('tool/smscode')}',$('#tel'));" type="button" value="{lang(send_cell_phone_verification_code)}" />
<input type='text' placeholder="{lang(please_enter_the_phone_verification_code)}" id="mobilenum" name="mobilenum" />
<div class="blank20"></div>
{/if}
{if config::get('verifycode') == 1}
<li><input type='text' id="verify"  tabindex="3"  name="verify" />{verify()}</li>
{/if}
{if config::get('verifycode') == 2}
<li>
<div id="verifycode_embed"></div>
<script src="http://api.geetest.com/get.php"></script>
<script>
var loadGeetest = function(config) {
	window.gt_captcha_obj = new window.Geetest({
		gt : config.gt,
		challenge : config.challenge,
		product : 'float',
		offline : !config.success
	});
	gt_captcha_obj.appendTo("#verifycode_embed");
};

$.ajax({
	url : '{url('tool/geetest',0)}',
	type : "get",
	dataType : 'JSON',
	success : function(result) {
		//console.log(result);
		loadGeetest(result)
	}
});
</script>
</li>
{/if}
<li class="submit"><input type="submit" name="submit" value=" 登录 " class="button" />
<span class="fr">
<a href="http://www.cmseasy.cn/plus/show_134.html" target="_blank">找回密码？</a> <a href="http://chm.cmseasy.cn/" target="_blank" class="help">帮助</a>
</span>
</li>
</form>
</ul>





<?php
    }
    if(get('submit')) {
	  if(hasflash()) {
	      echo '<div style="clear:both;margin:50px 0px;text-align:center;color:red;font-size:16px;font-weight:bold;">';
		  echo flash();
	  } else { ?>
            <div style="margin:50px 0px;padding-top:5px; text-align:center;font-size:16px;font-weight:bold;">
            登陆成功！
			
            <meta http-equiv="refresh" content="2;url={$admin_url}&site=<?php echo front::get('site')?>">
<?php
      }
	  echo '</div>';
	}
?>


<div class="blank20"></div>

<script type="text/javascript">
function ResumeError()
{
    return true;
}
window.onerror = ResumeError;
document.loginform.username.focus();
</script>

</div>
</div>



<div id="copy">
<div class="box">
<p>&copy; &nbsp;<a title="{get('sitename')}" href="{$base_url}/">{get('sitename')}</a> All Rights Reserved.</p>
<p>
Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a>
</p>
</div>
</div>


<!--[if (gte IE 9)|!(IE)]><!-->

<script type="text/javascript">
$(function () {
    if (!window.ActiveXObject && !!document.createElement("canvas").getContext) {
        $.getScript("{$skin_path}/js/httpim-img.qq.compcqqjs200cav.js",
                function () {
                    var t = {
                        width: 1.5,
                        height: 1.5,
                        depth: 10,
                        segments: 15,
                        slices: 6,
                        xRange: 0.8,
                        yRange: 0.1,
                        zRange: 1,
                        ambient: "#525252",
                        diffuse: "#FFFFFF",
                        speed: 0.0002
                    };
                    var G = {
                        count: 2,
                        xyScalar: 1,
                        zOffset: 100,
                        ambient: "#002c4a",
                        diffuse: "#005584",
                        speed: 0.001,
                        gravity: 1200,
                        dampening: 0.95,
                        minLimit: 10,
                        maxLimit: null,
                        minDistance: 20,
                        maxDistance: 400,
                        autopilot: false,
                        draw: false,
                        bounds: CAV.Vector3.create(),
                        step: CAV.Vector3.create(Math.randomInRange(0.2, 1), Math.randomInRange(0.2, 1), Math.randomInRange(0.2, 1))
                    };
                    var m = "canvas";
                    var E = "svg";
                    var x = {
                        renderer: m
                    };
                    var i, n = Date.now();
                    var L = CAV.Vector3.create();
                    var k = CAV.Vector3.create();
                    var z = document.getElementById("container");
                    var w = document.getElementById("anitOut");
                    var D, I, h, q, y;
                    var g;
                    var r;

                    function C() {
                        F();
                        p();
                        s();
                        B();
                        v();
                        K(z.offsetWidth, z.offsetHeight);
                        o()
                    }

                    function F() {
                        g = new CAV.CanvasRenderer();
                        H(x.renderer)
                    }

                    function H(N) {
                        if (D) {
                            w.removeChild(D.element)
                        }
                        switch (N) {
                            case m:
                                D = g;
                                break
                        }
                        D.setSize(z.offsetWidth, z.offsetHeight);
                        w.appendChild(D.element)
                    }

                    function p() {
                        I = new CAV.Scene()
                    }

                    function s() {
                        I.remove(h);
                        D.clear();
                        q = new CAV.Plane(t.width * D.width, t.height * D.height, t.segments, t.slices);
                        y = new CAV.Material(t.ambient, t.diffuse);
                        h = new CAV.Mesh(q, y);
                        I.add(h);
                        var N, O;
                        for (N = q.vertices.length - 1; N >= 0; N--) {
                            O = q.vertices[N];
                            O.anchor = CAV.Vector3.clone(O.position);
                            O.step = CAV.Vector3.create(Math.randomInRange(0.2, 1), Math.randomInRange(0.2, 1), Math.randomInRange(0.2, 1));
                            O.time = Math.randomInRange(0, Math.PIM2)
                        }
                    }

                    function B() {
                        var O, N;
                        for (O = I.lights.length - 1; O >= 0; O--) {
                            N = I.lights[O];
                            I.remove(N)
                        }
                        D.clear();
                        for (O = 0; O < G.count; O++) {
                            N = new CAV.Light(G.ambient, G.diffuse);
                            N.ambientHex = N.ambient.format();
                            N.diffuseHex = N.diffuse.format();
                            I.add(N);
                            N.mass = Math.randomInRange(0.5, 1);
                            N.velocity = CAV.Vector3.create();
                            N.acceleration = CAV.Vector3.create();
                            N.force = CAV.Vector3.create()
                        }
                    }

                    function K(O, N) {
                        D.setSize(O, N);
                        CAV.Vector3.set(L, D.halfWidth, D.halfHeight);
                        s()
                    }

                    function o() {
                        i = Date.now() - n;
                        u();
                        M();
                        requestAnimationFrame(o)
                    }

                    function u() {
                        var Q, P, O, R, T, V, U, S = t.depth / 2;
                        CAV.Vector3.copy(G.bounds, L);
                        CAV.Vector3.multiplyScalar(G.bounds, G.xyScalar);
                        CAV.Vector3.setZ(k, G.zOffset);
                        for (R = I.lights.length - 1; R >= 0; R--) {
                            T = I.lights[R];
                            CAV.Vector3.setZ(T.position, G.zOffset);
                            var N = Math.clamp(CAV.Vector3.distanceSquared(T.position, k), G.minDistance, G.maxDistance);
                            var W = G.gravity * T.mass / N;
                            CAV.Vector3.subtractVectors(T.force, k, T.position);
                            CAV.Vector3.normalise(T.force);
                            CAV.Vector3.multiplyScalar(T.force, W);
                            CAV.Vector3.set(T.acceleration);
                            CAV.Vector3.add(T.acceleration, T.force);
                            CAV.Vector3.add(T.velocity, T.acceleration);
                            CAV.Vector3.multiplyScalar(T.velocity, G.dampening);
                            CAV.Vector3.limit(T.velocity, G.minLimit, G.maxLimit);
                            CAV.Vector3.add(T.position, T.velocity)
                        }
                        for (V = q.vertices.length - 1; V >= 0; V--) {
                            U = q.vertices[V];
                            Q = Math.sin(U.time + U.step[0] * i * t.speed);
                            P = Math.cos(U.time + U.step[1] * i * t.speed);
                            O = Math.sin(U.time + U.step[2] * i * t.speed);
                            CAV.Vector3.set(U.position, t.xRange * q.segmentWidth * Q, t.yRange * q.sliceHeight * P, t.zRange * S * O - S);
                            CAV.Vector3.add(U.position, U.anchor)
                        }
                        q.dirty = true
                    }

                    function M() {
                        D.render(I)
                    }

                    function J(O) {
                        var Q, N, S = O;
                        var P = function (T) {
                            for (Q = 0, l = I.lights.length; Q < l; Q++) {
                                N = I.lights[Q];
                                N.ambient.set(T);
                                N.ambientHex = N.ambient.format()
                            }
                        };
                        var R = function (T) {
                            for (Q = 0, l = I.lights.length; Q < l; Q++) {
                                N = I.lights[Q];
                                N.diffuse.set(T);
                                N.diffuseHex = N.diffuse.format()
                            }
                        };
                        return {
                            set: function () {
                                P(S[0]);
                                R(S[1])
                            }
                        }
                    }

                    function v() {
                        window.addEventListener("resize", j)
                    }

                    function A(N) {
                        CAV.Vector3.set(k, N.x, D.height - N.y);
                        CAV.Vector3.subtract(k, L)
                    }

                    function j(N) {
                        K(z.offsetWidth, z.offsetHeight);
                        M()
                    }

                    C();
                })
    } else {
        
    }
});
</script>
<![endif]-->

</body>
</html>