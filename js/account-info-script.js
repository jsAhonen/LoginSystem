// LOAD DATA WHEN THE PAGE IS LOADED
$(document).ready(loadData);

function updateSessionStorage() {
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
}

function loadData() {
    updateSessionStorage();
    // UPDATE TEXT FIELDS ON THE PAGE
    $.ajax({
        type: 'POST',
        url: 'includes/account-info-php.php',
        data: "firstname",
        success: function(data) {
            $('#firstname-field').html(data);
        }
    });
    $.ajax({
        type: 'POST',
        url: 'includes/account-info-php.php',
        data: "lastname",
        success: function(data) {
            $('#lastname-field').html(data);
        }
    });
    $.ajax({
        type: 'POST',
        url: 'includes/account-info-php.php',
        data: "email",
        success: function(data) {
            $('#email-field').html(data);
        }
    });
    $.ajax({
        type: 'POST',
        url: 'includes/account-info-php.php',
        data: "uid",
        success: function(data) {
            $('#uid-field').html(data);
        }
    });
};

function getUrlVariables() {
    updateSessionStorage();
    $uid = sessionStorage.getItem("username");
    $token = sessionStorage.getItem("token");
    $tokenTime = sessionStorage.getItem("token-time");
    return "?uid=" + $uid + "&tkn=" + $token + "&tm=" + $tokenTime;
}

// EDIT FIRST NAME
$('#firstname-button').on('click', function() {
    var $firstnameText = $('#firstname-field').text();
    console.log($firstnameText);
    $('#firstname-field').html('<input type="text" id="change-firstname-field" value=""><button id="change-firstname-button" class="btn btn-sm">Confirm</button><button id="cancel-firstname-change" class="btn">Cancel</button>');
    $('#change-firstname-field').val($firstnameText);
    $('#cancel-firstname-change').on('click', function() { $('#firstname-field').html($firstnameText); });
    $('#change-firstname-button').on('click', function() {
        var $newFirstname = $('#change-firstname-field').val();
        var $firstnameData = { "name": "firstname", "value": $newFirstname };
        $.ajax({
            type: 'POST',
            url: 'includes/change-account-info-php.php' + getUrlVariables(),
            data: $firstnameData,
            success: function(data) {
                console.log(data);
                window.location.assign(data);
            }
        });
    });
});

// EDIT LAST NAME
$('#lastname-button').on('click', function() {
    var $lastnameText = $('#lastname-field').text();
    console.log($lastnameText);
    $('#lastname-field').html('<input type="text" id="change-lastname-field" value=""><button id="change-lastname-button" class="btn btn-sm">Confirm</button><button id="cancel-lastname-change" class="btn">Cancel</button>');
    $('#change-lastname-field').val($lastnameText);
    $('#cancel-lastname-change').on('click', function() { $('#lastname-field').html($lastnameText); });
    $('#change-lastname-button').on('click', function() {
        var $newLastname = $('#change-lastname-field').val();
        var $lastnameData = { "name": "lastname", "value": $newLastname };
        $.ajax({
            type: 'POST',
            url: 'includes/change-account-info-php.php' + getUrlVariables(),
            data: $lastnameData,
            success: function(data) {
                console.log(data);
                window.location.assign(data);
            }
        });
    });
});

// EDIT EMAIL
$('#email-button').on('click', function() {
    var $emailText = $('#email-field').text();
    console.log($emailText);
    $('#email-field').html('<input type="text" id="change-email-field" value=""><button id="change-email-button" class="btn btn-sm">Confirm</button><button id="cancel-email-change" class="btn">Cancel</button>');
    $('#change-email-field').val($emailText);
    $('#cancel-email-change').on('click', function() { $('#email-field').html($emailText); });
    $('#change-email-button').on('click', function() {
        $newEmail = $('#change-email-field').val();
        console.log($newEmail);
        $emailData = { "name": "email", "value": $newEmail };
        $.ajax({
            type: 'POST',
            url: 'includes/change-account-info-php.php' + getUrlVariables(),
            data: $emailData,
            success: function(data) {
                console.log(data);
                window.location.assign(data);
            }
        });
    });
});

// EDIT USERNAME
$('#uid-button').on('click', function() {
    var $uidText = $('#uid-field').text();
    console.log($uidText);
    $('#uid-field').html('<input type="text" id="change-uid-field" value=""><button id="change-uid-button" class="btn btn-sm">Confirm</button><button id="cancel-uid-change" class="btn">Cancel</button>');
    $('#change-uid-field').val($uidText);
    $('#cancel-uid-change').on('click', function() { $('#uid-field').html($uidText); });
    $('#change-uid-button').on('click', function() {
        var $newUid = $('#change-uid-field').val();
        console.log($newUid);
        var $uidData = { "name": "username", "value": $newUid };
        $.ajax({
            type: 'POST',
            url: 'includes/change-account-info-php.php' + getUrlVariables(),
            data: $uidData,
            success: function(data) {
                console.log(data);
                window.location.assign(data);
            }
        });
    });
});

// EDIT PASSWORD
$('#pwd-button').on('click', function() {
    var $pwdText = $('#pwd-field').text();
    console.log($pwdText);
    $('#pwd-field').html('<p>Your current password: <input type="password" id="current-pwd-field" value=""></p><p>Choose a new password: <input type="password" id="new-pwd-field" value=""></p><p>Confirm the new password: <input type="password" id="confirm-pwd-field" value=""></p><button id="change-pwd-button" class="btn btn-sm">Confirm</button><button id="cancel-pwd-change" class="btn">Cancel</button>');
    $('#cancel-pwd-change').on('click', function() { $('#pwd-field').html($pwdText); });
    $('#change-pwd-button').on('click', function() {
        var $currentPwd = $('#current-pwd-field').val();
        var $newPwdFirst = $('#new-pwd-field').val();
        var $newPwdConfirm = $('#confirm-pwd-field').val();
        console.log($currentPwd);
        console.log($newPwdFirst);
        console.log($newPwdConfirm);
        var $pwdData = { "name": "password", "current_password": $currentPwd, "new_password": $newPwdFirst, "confirm_password": $newPwdConfirm };
        $.ajax({
            type: 'POST',
            url: 'includes/change-account-info-php.php' + getUrlVariables(),
            data: $pwdData,
            success: function(data) {
                console.log(data);
                window.location.assign(data);
            }
        });
    });
});

// NAVIGATION 
$('#to-user-page-button').on('click', function() {
    window.location.assign("user.php" + getUrlVariables());
});


// LOGOUT

$('#logout-button').on('click', function() {
    window.location.assign("includes/logout.inc.php")
});