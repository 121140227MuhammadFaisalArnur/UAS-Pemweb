function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Max-Age=-99999999;';
}

function saveToLocalStorage(data) {
    localStorage.setItem('userData', JSON.stringify(data));
}

function getFromLocalStorage() {
    var storedData = localStorage.getItem('userData');
    return storedData ? JSON.parse(storedData) : null;
}

function removeFromLocalStorage() {
    localStorage.removeItem('userData');
}

var userDataFromCookie = getCookie('userData');
var userDataFromLocalStorage = getFromLocalStorage();

var userData = userDataFromCookie ? JSON.parse(userDataFromCookie) : userDataFromLocalStorage;

if (userData) {
    document.getElementById('name').value = userData.name;
    document.getElementById('nim').value = userData.nim;
    document.getElementById('religion').value = userData.religion;

    var genderElement = document.getElementById(userData.gender);
    if (genderElement) {
        genderElement.checked = true;
    } else {
        console.error('Elemen dengan ID ' + userData.gender + ' tidak ditemukan.');
    }
}

document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault();

    setCookie('userData', JSON.stringify({
        name: document.getElementById('name').value,
        nim: document.getElementById('nim').value,
        religion: document.getElementById('religion').value,
        gender: document.querySelector('input[name="gender"]:checked').value
    }), 5);

    saveToLocalStorage({
        name: document.getElementById('name').value,
        nim: document.getElementById('nim').value,
        religion: document.getElementById('religion').value,
        gender: document.querySelector('input[name="gender"]:checked').value
    });
});
