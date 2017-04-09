function addOnClick() {
    $("#notebutton").click(function(){
        $("#notesdiv").toggle(500);
        $("#tbdsdiv").hide();
        $("#imagesdiv").hide();
        $("#linksdiv").hide();
    });
    $("#tbdbutton").click(function(){
        $("#tbdsdiv").toggle(500);
        $("#notesdiv").hide();
        $("#imagesdiv").hide();
        $("#linksdiv").hide();
    });
    $("#imagebutton").click(function(){
        $("#imagesdiv").toggle(500);
        $("#notesdiv").hide();
        $("#tbdsdiv").hide();
        $("#linksdiv").hide();

    });
    $("#linkbutton").click(function(){
        $("#linksdiv").toggle(500);
        $("#notesdiv").hide();
        $("#tbdsdiv").hide();
        $("#imagesdiv").hide();
    });
}

function addOnClear() {
    $('#clear_note').click(function() {
        $('#notearea').empty();
    })
    $('#clear_tbd').click(function() {
        $('#tbdarea').empty();
    })
}

function openInNew(textbox){
    window.open(getAbsoluteUrl(textbox.value));
    this.blur();
}

function getAbsoluteUrl(url) {
    var exp = 'http://';
    if (!url.match(exp)) {
        url = 'http://' + url;
    }
    return url;
}

function revealSection(session_active) {
    if (session_active == "picture") {
        $("#imagesdiv").show();
    } else if (session_active == "note") {
        $("#notesdiv").show();
    } else if (session_active == "tbd") {
        $("#tbdsdiv").show();
    } else if (session_active == "link") {
        $("#linksdiv").show();
    }
}
