document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('input[type="submit"]');
    const editLinks = document.querySelectorAll('a.edit-link');
    
    editLinks.forEach(function (editLink) {
        editLink.addEventListener("click", handleEditLinkClick);
    });

    let religionInput = document.getElementById("religion");
    const name = document.getElementById("name");
    const nim = document.getElementById("nim");
    let gender

    const genderRadioButtons = document.querySelectorAll('input[name="gender"]');
    genderRadioButtons.forEach(function (radio) {
        radio.addEventListener("change", function () {
            gender = radio.value
            handleRadioButtonChange();
        });
    });

    form.addEventListener("click", function (event) {
        event.preventDefault(); 

        handleFormSubmission();

        name.value = "";
        nim.value = "";
        religionInput.value = "";
        genderRadioButtons.forEach(function (radio) {
            radio.checked = false;
        });
    });

    function handleFormSubmission() {
        const name = document.getElementById("name").value;
        const nim = document.getElementById("nim").value;


        if (name === "" || nim === "") {
            alert("Nama dan nim diperlukan!");
            return;
        }

        console.log("Name: ", name);
        console.log("nim: ", nim);
        console.log("gender: ", gender);

        fetch('post.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(name)}&nim=${encodeURIComponent(nim)}&religion=${encodeURIComponent(religionInput.value)}&gender=${encodeURIComponent(gender)}`,
        })
            .then(response => response.json())
            .then(data => {
                alert('Data berhasil ditambahkan')
                console.log('Server Response:', data);
            })
            .catch(error => console.error('Error sending data to PHP:', error));


    }   

    function handleEditLinkClick(event) {
        event.preventDefault();
        alert("Berhasil masuk halaman ubah!");
        const nimValue = event.currentTarget.getAttribute("data-nim");
        window.location.href = "edit.php?nim=" + encodeURIComponent(nimValue);
    }
    
});
