/* LOGIN MECHANISM */
$('#login-form').on('submit', function() {
    var $uid = $('#uid').val();
    var $pwd = $('#pwd').val();

    var userinfo = {
        "uid": $uid,
        "pwd": $pwd
    }

    /*$.ajax({
        method: "POST",
        url: "includes/login.inc.php",
        data: userinfo
    });*/

    $.post("includes/login.inc.php", userinfo, function() {
        console.log(userinfo);
    });
});