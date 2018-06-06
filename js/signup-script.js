$('#signup-form').on('submit', function(d) {
    var $firstname = $('#firstname').val();
    var $lastname = $('#lastname').val();
    var $email = $('#email').val();
    var $username = $('#new-username').val();
    var $password = $('#new-password').val();

    var userinfo = {
        firstname: $firstname,
        lastname: $lastname,
        email: $email,
        username: $username,
        password: $password
    }
    $.post("includes/signup.inc.php", userinfo, function(data, status) {
        console.log(userinfo);
        console.log(status);
    });
});