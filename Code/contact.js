const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const messages = document.getElementById('messages');


form.addEventListener('submit', e => {
    e.preventDefault();

    validateInputs();
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const validateInputs = () => {
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const messagesValue = messages.value.trim();
    
    var check1;
    var check2;
    var check3;

    if(usernameValue === '') {
        setError(username, 'Full Name is required');
    } else {
        setSuccess(username);
        check1 = true;
    }

    if(emailValue === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address'); 
    } else {
        setSuccess(email);
        check2 = true;
    }

    if(messagesValue === '') {
        setError(messages, 'Please enter your message here');
    }  else {
        setSuccess(messages);
        check3 = true;
    }

    if(check1 == true && check2== true && check3 == true)
        alert("Thank You! We received your message!");    //The pop up alert for a valid email address                        
};