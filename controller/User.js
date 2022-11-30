class User {

    static signup() {
        let nameElement = document.getElementById('name');
        let emailElement = document.getElementById('email');
        let passwordElement = document.getElementById('password');

        let data = `name=${nameElement.value}&email=${emailElement.value}&password=${passwordElement.value}`;
        let errorMessage = "";
        
        let request = new XMLHttpRequest();
        request.open('POST', '../controller/UserSignup.php');
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(data);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let response = JSON.parse(request.responseText);
                let formContainer = document.getElementById("formContainer");

                let previousMessage = document.getElementById("message");
                if(previousMessage != null){
                    previousMessage.remove();
                }
                
                let messageElement = document.createElement("p");
                messageElement.classList += "message";
                messageElement.id = "message";
                formContainer.prepend(messageElement);

                if (response.success == '') {
                    if (response.name_error != '') {
                        errorMessage += response.name_error + "<br>";
                    }

                    if (response.email_error != '') {
                        errorMessage += response.email_error + "<br>";
                    }

                    if (response.password_error != '') {
                        errorMessage += response.password_error + "<br>";
                    }

                    messageElement.classList += " message-error";
                    messageElement.innerHTML = errorMessage;
                }
                else {
                    messageElement.classList += " message-success";
                    messageElement.innerHTML = "Cadastro realizado";
                    nameElement.value = "";
                    emailElement.value = "";
                    passwordElement.value = "";
                }
            }
        }
    }

}