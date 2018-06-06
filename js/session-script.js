$(function() {
    if (sessionStorage.getItem("username") == undefined) {
        $.ajax({
            type: 'POST',
            url: 'includes/session.php',
            data: "username",
            success: function(data) {
                sessionStorage.setItem("username", data);
            }
        });
    }
    if (sessionStorage.getItem("token") == undefined) {
        $.ajax({
            type: 'POST',
            url: 'includes/session.php',
            data: "token",
            success: function(data) {
                sessionStorage.setItem("token", data);
            }
        });
    }
    alert("Session storage token: " + sessionStorage.getItem("token"));
    if (sessionStorage.getItem("token-time") == undefined) {
        $.ajax({
            type: 'POST',
            url: 'includes/session.php',
            data: "token-time",
            success: function(data) {
                sessionStorage.setItem("token-time", data);
            }
        });
    }
});

function getUrlVariables() {
    $uid = sessionStorage.getItem("username");
    $token = sessionStorage.getItem("token");
    $tokenTime = sessionStorage.getItem("token-time");
    return "?uid=" + $uid + "&tkn=" + $token + "&tm=" + $tokenTime;
}

$('#to-account-info').on('click', function() {
    window.location.assign("http://localhost/LoginAndFeedback/account-info.php" + getUrlVariables());
});