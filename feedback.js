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
    var formContainer = document.createElement("div");
    formContainer.style.cssText = "width: 400px; height: auto; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 1px solid #ddd; border-radius: 5px; box-shadow: 2px 2px 5px #888888; padding: 20px; background-color: #f9f9f9; z-index: 9999;";

    var title = document.createElement("h3");
    title.innerHTML = "We'd love your feedback!";
    title.style.textAlign = "center";
    title.style.marginBottom = "20px";

    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "home.php");

    var radioLabel = document.createElement("p");
    radioLabel.innerHTML = "Was the Cholera Diagnosis correct?";
    radioLabel.style.textAlign = "center";
    radioLabel.style.marginBottom = "10px";

    var radioDiv = document.createElement("div");
    radioDiv.style.cssText = "display: flex; flex-direction: row; justify-content: space-around; align-items: center; margin-bottom: 20px;";

    var yesDiv = document.createElement("div");
    var yesRadio = document.createElement("input");
    yesRadio.setAttribute("type", "radio");
    yesRadio.setAttribute("name", "diagnosis");
    yesRadio.setAttribute("value", "yes");
    var yesLabel = document.createElement("label");
    yesLabel.innerHTML = "Yes";
    yesDiv.appendChild(yesRadio);
    yesDiv.appendChild(yesLabel);

    var noDiv = document.createElement("div");
    var noRadio = document.createElement("input");
    noRadio.setAttribute("type", "radio");
    noRadio.setAttribute("name", "diagnosis");
    noRadio.setAttribute("value", "no");
    var noLabel = document.createElement("label");
    noLabel.innerHTML = "No";
    noDiv.appendChild(noRadio);
    noDiv.appendChild(noLabel);

    radioDiv.appendChild(yesDiv);
    radioDiv.appendChild(noDiv);

    var input = document.createElement("textarea");
    input.setAttribute("name", "feedback");
    input.setAttribute("placeholder", "Please provide your feedback here");
    input.style.cssText = "width: 100%; height: 100px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; padding: 10px; box-sizing: border-box;";

    var submit = document.createElement("input");
    submit.setAttribute("type", "submit");
    submit.setAttribute("value", "Submit");
    submit.style.cssText = "width: 100%; background-color: #3deb6c; color: #ffffff; border: none; border-radius: 5px; padding: 10px; font-weight: bold; cursor: pointer;";

    var closeButton = document.createElement("button");
    closeButton.innerHTML = "No Thanks";
    closeButton.style.cssText = "width: 100%; background-color: #3498db; color: #ffffff; border: none; border-radius: 5px; padding: 10px; margin-top: 10px; font-weight: bold; cursor: pointer;";
    closeButton.onclick = function() {
        window.location.href = "home.php";
    };

    form.appendChild(radioLabel);
    form.appendChild(radioDiv);
    form.appendChild(input);
    form.appendChild(submit);
    form.appendChild(closeButton);

    formContainer.appendChild(title);
    formContainer.appendChild(form);

    document.body.appendChild(formContainer);
}