$(document).ready(function () {
    var url = window.location.pathname;
    if(url == "/" ) { //判断url地址
        $(".nav-item").eq(0).addClass("active");
    }else if(url.indexOf("home") >=0)
    {
        $(".nav-item").eq(1).addClass("active");
    }else if(url.indexOf("cart") >=0)
    {
        $(".nav-item").eq(2).addClass("active");
    }else if(url.indexOf("order") >=0)
    {
        $(".nav-item").eq(3).addClass("active");
    }else if(url.indexOf("management") >=0)
    {
        $(".nav-item").eq(4).addClass("active");
    }
});