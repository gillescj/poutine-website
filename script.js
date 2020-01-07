// Geolocation -----

// Coordinates if geolocation is not supported
var latLong = {
    lat: 43.259,
    long: -79.87
};

// For Searching
// With user's permission for location, get location and then display coordinates to user
// in geo-location div, under the 'Search My Location' button. Standard error display."
function displayGeo() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            document.getElementById('geo-location').innerHTML = `Latitude: ${position.coords.latitude}<br>
            Longitude: ${ position.coords.longitude}`;
        });
    } else {
        document.getElementById('geo-location').innerHTML("Geolocation not supported.");
    }
}

// For Location Submission
// With user's permission for location, get location and then add coordinates to the lat and long
// text inputs. Standard error display.
function addGeo() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            document.getElementById('ob-location-lat').value = position.coords.latitude;
            document.getElementById('ob-location-long').value = position.coords.longitude;
        });
    } else {
        document.getElementsById('submission-form-errors').innerHTML("Geolocation not supported.");
    }
}

// For Review Form
function addLocationID(element) {
    document.getElementById(element).value = 23;
}

// Input Validation -----

function displayError(id, message) {
    document.getElementById(id).innerHTML = message;
}

function clearErrorMessages() {
    displayError('fname-err', "");
    displayError('lname-err', "");
    displayError('reg-email-err', "");
    displayError('reg-paswd-err', "");
    displayError('login-email-err', "");
    displayError('login-paswd-err', "");
}


// Registration Validation =====

// Calling elements from their IDs and saving them to variables
const regiForm = document.getElementById('register-form');
const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const regiLocation = document.getElementById('register-location');
const regiEmail = document.getElementById('reg-email');
const regiPass = document.getElementById('reg-pswd');

var regiErrorsCount = 0;

if (regiForm) {
    regiForm.addEventListener('submit', (e) => {
        clearErrorMessages();
        validateRegiEmpty();
        validateName();
        validateRegiEmail();
        validateRegiPassword();
        if (regiErrorsCount != 0) {
            e.preventDefault();
            regiErrorsCount = 0;
        }

    });
}

// If any of the inputs are empty, add a message to the errors array
function validateRegiEmpty() {
    if (fname.value === "" || fname.value == null) {
        displayError('fname-err', "First name is required");
        regiErrorsCount = regiErrorsCount + 1;
    }
    if (lname.value === "" || lname.value == null) {
        displayError('lname-err', "Last name is required");
        regiErrorsCount = regiErrorsCount + 1;
    }
    if (regiEmail.value === "" || regiEmail.value == null) {
        displayError('reg-email-err', "Email address is required");
        regiErrorsCount = regiErrorsCount + 1;
    }
    if (regiPass.value === "" || regiPass.value == null) {
        displayError('reg-paswd-err', "Password is required");
        regiErrorsCount = regiErrorsCount + 1;
    }
}

// If the first or last name have text other than letter, add a message to the errors array
function validateName() {
    if (!(/^[a-zA-Z '.-]*$/.test(fname.value)) &&
        (fname.value.length != 0)) {
        displayError('fname-err', "Valid first name required");
        regiErrorsCount = regiErrorsCount + 1;
    }
    if (!(/^[a-zA-Z '.-]*$/.test(lname.value)) &&
        (lname.value.length > 0)) {
        displayError('lname-err', "Valid last name required");
        regiErrorsCount = regiErrorsCount + 1;
    }
}

// HTML will flag invalid email before JS is run, so this function is just for example
// If the email is not in the correct format, add a message to the errors array
function validateRegiEmail() {
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(regiEmail.value)) &&
        (regiEmail.value.length != 0)) {
        displayError('reg-email-err', "Valid email address required");
        regiErrorsCount = regiErrorsCount + 1;
    }
}

function validateRegiPassword() {
    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(regiPass.value)) &&
        (regiPass.value.length != 0)) {
        displayError('reg-paswd-err', "Valid password required:<br>At least 8 characters long<br>At least one uppercase letter<br>At least one lowercase letter<br>At least one number<br>At least one special character");
        regiErrorsCount = regiErrorsCount + 1;
    }
}


// Login Validation =====

const loginForm = document.getElementById('login-form');
const loginEmail = document.getElementById('login-email');
const loginPass = document.getElementById('login-pswd');

var loginErrorsCount = 0;

if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
        clearErrorMessages();
        validateLoginEmpty();
        validateLoginEmail();
        validateLoginPassword();
        if (loginErrorsCount != 0) {
            e.preventDefault();
            loginErrorsCount = 0;
        }

    });
}

function validateLoginEmpty() {
    if (loginEmail.value === "" || loginEmail.value == null) {
        displayError('login-email-err', "Email address is required");
        loginErrorsCount = loginErrorsCount + 1;
    }
    if (loginPass.value === "" || loginPass.value == null) {
        displayError('login-paswd-err', "Password is required");
        loginErrorsCount = loginErrorsCount + 1;
    }
}

function validateLoginEmail() {
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(loginEmail.value)) &&
        (loginEmail.value.length != 0)) {
        displayError('login-email-err', "Valid email address required");
        loginErrorsCount = loginErrorsCount + 1;
    }
}

function validateLoginPassword() {
    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(loginPass.value)) &&
        (loginPass.value.length != 0)) {
        displayError('login-paswd-err', "Valid password required:<br>At least 8 characters long<br>At least one uppercase letter<br>At least one lowercase letter<br>At least one number<br>At least one special character");
        loginErrorsCount = loginErrorsCount + 1;
    }
}
