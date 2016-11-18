function skipToLast() {
    var a;
    a = $(".slide").last(),
    a && ($(".slide").removeClass("selected"), a.addClass("selected"), jQuery.scrollTo.window().queue([]).stop(), $(window).scrollTo(a, 2150, {
        easing: "swing"
    }))
}
function switchbox(a) {
    a == 1 ? $(".slide.slide3 .arrowcontainer").show() : $(".slide.slide3 .arrowcontainer").hide(),
    $(".slide.slide3").removeClass("s1").removeClass("s2").removeClass("s3").removeClass("s4").removeClass("s5"),
    $(".slide.slide3").addClass("s" + a),
    $(".slide.slide3 .img" + a).addClass("selected"),
    $(".slide.slide3 .content").hide(),
    $(".slide.slide3 .content.content" + a).show(),
    $(".slide.slide3 .bgimg").remove()
}
trace = function(a) {
    try {
        console.log(a)
    } catch(b) {
        alert(a)
    }
},
$.fn.textInputHint = function(a) {
    return this.val(a),
    $(this).addClass("hint"),
    this.focus(function() {
        $(this).val() == a && $(this).removeClass("hint").val("")
    }),
    this.blur(function() {
        $(this).val() == "" && $(this).addClass("hint").val(a)
    }),
    this
},
$(document).ready(function() {
    $("#emaildrop").textInputHint("Email Address"),
    $(".slide .button").click(function(a) {
        Bobcat.SlideManager.changeSlide(1)
    }),
    $(".slide.slide1 .message2 a").click(function() {
        skipToLast()
    }),
    $("#fb-fans").append('<fb:fan profile_id="211998345516663" connections="8" stream="0" width="480" height="150" css="http://striking.ly/assets/facebook.css"></fb:fan>'),
    $("#gplus-counter").append('<g:plusone size="tall"></g:plusone>'),
    FB.init({
        appId: "230491903632065",
        status: !0,
        cookie: !0,
        xfbml: !0
    }),
    $(".slide.slide5 #signupbutton1").click(function() {
        $(".slide.slide5 .signupdiv").slideToggle(),
        $(".slide.slide5 .emaildropdiv").slideToggle()
    }),
    $(".slide.slide5 #mcformstrikingly .submit").click(function() {
        $(".slide.slide5 #mcformstrikingly").submit()
    })
})