(function() {
    var po = document.createElement('script');
    po.type = 'text/javascript';
    po.async = true;
    po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
})();

function onLoadCallback() {
    gapi.client.setApiKey('AIzaSyAr3HCyjJAHaq_31tAp21x_S0AkE8y4QEw');
    gapi.client.load('plus', 'v1', function() {});
}

function logout() {
    gapi.auth.signOut();
    location.reload();
}

function login() {
    var myParams = {
        'clientid': '485814981491-121n38q3ltf6e4c3jv5gi9tuqhb96hkt.apps.googleusercontent.com',
        'cookiepolicy': 'single_host_origin',
        'callback': 'loginCallback',
        'approvalprompt': 'force',
        'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
    };
    gapi.auth.signIn(myParams);
}

function loginCallback(result) {
    if (result['status']['signed_in']) {
        var request = gapi.client.plus.people.get({
            'userId': 'me'
        });
        request.execute(function(resp) {
            var email = '';
            if (resp['emails']) {
                for (i = 0; i < resp['emails'].length; i++) {
                    if (resp['emails'][i]['type'] == 'account') {
                        email = resp['emails'][i]['value'];
                    }
                }
            }
            var email = resp['emails'].filter(function(v) {
                return v.type === 'account';
            })[0].value;
            var fName = resp.displayName;
            var _adata = {
                EmailAddress: email,
                FullName: fName,
                AccessToken: result.access_token
            };
            var adata = JSON.stringify({
                accountentity: _adata
            });
            $.ajax({
                url: "/User/getuserlogingoogle",
                type: 'POST',
                data: _adata,
                dataType: 'json',
                beforeSend: function() {
                    $("#boxLoading").show();
                },
                success: function(obj) {
                    if (obj.Success == true) {
                        var url = '/';
                        window.location.href = url;
                    } else {
                        window.location.href = '/logingoogle';
                    }
                },
                error: function(obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function() {
                    $("#boxLoading").hide();
                }
            });
            $("#inputFullname").val(fName);
            $("#inputEmail").val(email);
        });
    }
}