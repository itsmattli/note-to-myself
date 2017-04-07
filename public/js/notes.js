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

function openInNew(row) {
    var value = row.val()
    window.open(value);
}