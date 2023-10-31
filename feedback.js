function openCenteredWindow(url, name, width, height) {
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var options = 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;
    var win = window.open(url, name, options);

    var pollTimer = window.setInterval(function() {
        if (win.closed !== false) {
            window.clearInterval(pollTimer);
            openFeedbackForm();
        }
    }, 200);
}

function openFeedbackForm() {
    var width = 900; // Adjust the width as desired
    var height = 630; // Adjust the height as desired
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var options = 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;
    var win = window.open('feedback.php', '_blank', options);
}


