$(document).ready(function () {
    var current = 1;

    widget = $(".step");
    btnnext = $(".next");
    btnback = $(".back");
    btnsubmit = $(".submit");

    widget.not(":eq(0)").hide();
    hideButtons(current);
    setProgress(current);

    btnnext.click(function (e) {
        e.preventDefault();
        if (current < widget.length) {
            widget.show();
            widget.not(":eq(" + current++ + ")").hide();
            setProgress(current);
        }
        hideButtons(current);
    });

    btnback.click(function (e) {
        e.preventDefault();
        if (current > 1) {
            current = current - 2;
            btnnext.trigger("click");
        }
        hideButtons(current);
    });
});

setProgress = function (currstep) {
    var percent = parseFloat(100 / widget.length) * currstep;
    percent = percent.toFixed();
    $(".progress-bar")
        .css("width", percent + "%")
        .html(percent + "%");
};

hideButtons = function (current) {
    var limit = parseInt(widget.length);

    $(".action").hide();

    if (current < limit) btnnext.show();
    if (current > 1) btnback.show();
    if (current == limit) {
        btnnext.hide();
        btnsubmit.show();
    }
};
