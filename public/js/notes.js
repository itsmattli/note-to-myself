function hideDivs() {
    $("#notesdiv").hide();
    $("#tbdsdiv").hide();
    $("#imagesdiv").hide();
    $("#linksdiv").hide();
}

function addOnClick() {
    $("#notebutton").click(function(){
        $("#notesdiv").toggle(500);
    });
    $("#tbdbutton").click(function(){
        $("#tbdsdiv").toggle(500);
    });
    $("#imagebutton").click(function(){
        $("#imagesdiv").toggle(500);
    });
    $("#linkbutton").click(function(){
        $("#linksdiv").toggle(500);
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
    console.log("in");
    window.open(getAbsoluteUrl(textbox.value));
    this.blur();
}

function getAbsoluteUrl(url) {
    var a = document.createElement('a');
    a.href = url;
    return a.href;
}

function revealSection(session_active) {
    console.log(session_active.toString());
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
