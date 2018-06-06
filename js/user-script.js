$(function() {
    $.ajax({
        type: 'POST',
        url: 'includes/session.php',
        data: "username",
        success: function(data) {
            sessionStorage.setItem("username", data);
        }
    });
    $.ajax({
        type: 'POST',
        url: 'includes/session.php',
        data: "token",
        success: function(data) {
            sessionStorage.setItem("token", data);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'includes/session.php',
        data: "token-time",
        success: function(data) {
            sessionStorage.setItem("token-time", data);
        }
    });
    $.ajax({
        type: 'POST',
        url: 'includes/session.php',
        data: "firstname",
        success: function(data) {
            $('#insert-name').text(data);
        }
    });
});

// GETTERS

function getUrlVariables() {
    $uid = sessionStorage.getItem("username");
    $token = sessionStorage.getItem("token");
    $tokenTime = sessionStorage.getItem("token-time");
    return "?uid=" + $uid + "&tkn=" + $token + "&tm=" + $tokenTime;
}

// NAVIGATION

$('#to-account-info').on('click', function() {
    window.location.assign("http://localhost/LoginAndFeedback/account-info.php" + getUrlVariables());
});

// LOGOUT

$('#logout-button').on('click', function() {
    window.location.assign("includes/logout.inc.php")
});