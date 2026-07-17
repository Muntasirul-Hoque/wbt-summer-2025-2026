const form = document.getElementById("form");
let wrongAttempts = 0;
let isLocked = false;

form.addEventListener("submit", function(event) {
  event.preventDefault();

  // Clear Previous Errors
  clearErrors();
  if (isLocked) {
    document.getElementById("passwordError").innerHTML =
        "Password is locked. Try again after 1 minute.";
    return;
}
// <!-- 1st name || 2nd name || email || pass || gender || club || category || why -->

  let firstName = document.getElementById("firstName");
  let lastName = document.getElementById("lastName");
  let email = document.getElementById("email");
  let password = document.getElementById("password");
  let gender = document.querySelector('input[name="gender"]:checked');
  let club = document.querySelectorAll('input[name="club"]:checked');
  let category = document.getElementById("category");
  let reason = document.getElementById("reason");
 
  let valid = true;
  // ------------------------
  // Name Validation
  // ------------------------

  if (firstName.value.trim() == "") {
    showError(firstName, "firstNameError", "First Name is required.");
    valid = false;

  }
  else if (!/^[A-Za-z ]+$/.test(firstName.value.trim())) {
    showError(firstName, "firstNameError", "Only letters are allowed.");
    valid = false;
  }
  else { showSuccess(firstName);}


  if (lastName.value.trim() == "") {
    showError(lastName, "lastNameError", "Last Name is required.");
    valid = false;

  }
  else if (!/^[A-Za-z ]+$/.test(lastName.value.trim())) {
    showError(lastName, "lastNameError", "Only letters are allowed.");
    valid = false;
  }
  else { showSuccess(lastName);}

  // ------------------------
  // Email Validation
  // ------------------------
  if (email.value.trim() == "") {
    showError(email, "emailError", "Email is required.");
    valid = false;
  }
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
    showError(email, "emailError", "Invalid email address.");
    valid = false;
    }
  else { showSuccess(email); }

  // ------------------------
  // Password Validation
  // Password Alvi07
  // ------------------------
  if (password.value.trim() === "") {
    showError(password, "passwordError", "Password is required.");
    valid = false;
  }
  else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/.test(password.value)) {
    showError( password, "passwordError",
        "Password must be at least 6 characters and contain an uppercase letter, a lowercase letter, and a number."
    );
    valid = false;
  }
  else if (password.value != "Alvi07") {
    wrongAttempts++;
    showError( password, "passwordError",
      "Wrong Password! Attempt " + wrongAttempts + " of 3.");
    valid = false;

    if (wrongAttempts >= 3) {
      isLocked = true;
      document.getElementById("passwordError").innerHTML =
        "Too many wrong attempts. Password locked for 1 minute.";

      password.disabled = true;

      setTimeout(function () {
        isLocked = false;
        wrongAttempts = 0;
        password.disabled = false;

        document.getElementById("passwordError").innerHTML =
        "Password unlocked. Try again.";

      }, 60000);

    }

  }
  else {
    wrongAttempts = 0;
    showSuccess(password);
}

  // ------------------------
  // Gender Validation
  // ------------------------
  if (gender == null) {
    document.getElementById("genderError").innerHTML =
    "Please select your gender.";
    valid = false;
  }

  // ------------------------
  // Checkbox Validation
  // ------------------------

  if (club.length == 0) {
    document.getElementById("clubError").innerHTML =
    "Select at least one club.";
    valid = false;
  }

  // ------------------------
  // Category Validation
  // ------------------------
  if (category.value == "") {
    showError( category, "categoryError", "Please select a category." );
      valid = false;
  }
  else {showSuccess(category);}

  // ------------------------
  // Reason Validation
  // ------------------------
  if (reason.value.trim() == "") {
    showError(reason, "reasonError", "Reason is required.");
    valid = false;
  }
  else if (reason.value.trim().length < 20) {
    showError( reason, "reasonError", "Reason must be at least 20 characters." );
    valid = false;
  }
  else {showSuccess(reason);}

  // ------------------------
  // Success
  // ------------------------
  if (valid) {
    alert("Registration Successful!");
    form.reset();
    clearErrors();
  }

})

// ==========================
// Functions
// ==========================

// Show Error
function showError(input, errorId, message) {
  input.classList.add("errorBorder");
  input.classList.remove("successBorder");

  document.getElementById(errorId).innerHTML = message;
}

// Show Success
function showSuccess(input) {
  input.classList.remove("errorBorder");
  input.classList.add("successBorder");
}

// Clear All Errors
function clearErrors() {
  let errors = document.querySelectorAll(".error");

  errors.forEach(function (item) {
    item.innerHTML = "";
  });

  let fields = document.querySelectorAll("input, select, textarea");

  fields.forEach(function (field) {
    field.classList.remove("errorBorder");
    field.classList.remove("successBorder");
  });

}