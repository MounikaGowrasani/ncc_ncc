function restrictInput(inputElement) {
    inputElement.addEventListener("input", function () {
        // Remove any non-alphabetical characters
        inputElement.value = inputElement.value.replace(/[^A-Za-z]+/g, '');
    });
}
restrictInput(document.getElementById("studentfirstname"));
restrictInput(document.getElementById("studentmiddlename"));
restrictInput(document.getElementById("studentlastname"));
restrictInput(document.getElementById("fatherfid"));
restrictInput(document.getElementById("fathermid"));
restrictInput(document.getElementById("fatherlid"));
restrictInput(document.getElementById("motherfid"));
restrictInput(document.getElementById("mothermid"));
restrictInput(document.getElementById("motherlid"));
restrictInput(document.getElementById("bn"));

document.addEventListener("DOMContentLoaded", function () {
    const accnoInput = document.getElementById("accountno");

    accnoInput.addEventListener("input", function () {
        // Remove any non-numeric characters
        accnoInput.value = accnoInput.value.replace(/[^0-9]/g, '');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const adInput = document.getElementById("markpercent");

    adInput.addEventListener("input", function () {
        // Remove any non-numeric characters
        adInput.value = adInput.value.replace(/[^0-9/./%]/g, '');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const adiInput = document.getElementById("kincontactid");

    adiInput.addEventListener("input", function () {
        // Remove any non-numeric characters
        adiInput.value = adiInput.value.replace(/[^0-9]/g, '');
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById("DATE");

    dateInput.addEventListener("input", function () {
        // Remove any characters that are not numbers, hyphens, slashes, or periods
        dateInput.value = dateInput.value.replace(/[^0-9/-/./-]/g, '');
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const dateiInput = document.getElementById("rno");

    dateiInput.addEventListener("input", function () {
        // Remove any characters that are not numbers, hyphens, slashes, or periods
        dateiInput.value = dateiInput.value.replace(/[^0-9/^A-Za-z]/g, '');
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const adiInput = document.getElementById("mobileno");

    adiInput.addEventListener("input", function () {
        // Remove any non-numeric characters
        adiInput.value = adiInput.value.replace(/[^0-9]/g, '');
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const addInput = document.getElementById("compincode");

    addInput.addEventListener("input", function () {
        // Remove any non-numeric characters
        addInput.value = addInput.value.replace(/[^0-9]/g, '');
    });
});



document.addEventListener("DOMContentLoaded", function () {
    var currentDate = new Date();
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1; // Months are zero-based
    var year = currentDate.getFullYear();

    // Format the date as DD/MM/YYYY
    var formattedDate = (day < 10 ? "0" : "") + day + "/" + (month < 10 ? "0" : "") + month + "/" + year;

    // Set the formatted date as the value of the input field
    document.getElementById("DATE").value = formattedDate;
});