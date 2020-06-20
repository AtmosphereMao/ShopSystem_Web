$(document).ready(function () {
    $('.leave').click(function () {
        var url = window.location.host;
        location.href = "http://"+url+"/management";
    });
});