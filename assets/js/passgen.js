function generatePassword() {
  const length = parseInt(document.getElementById("length").value);
  const includeUppercase = document.getElementById("includeUppercase").checked;
  const includeNumbers = document.getElementById("includeNumbers").checked;
  const includeSymbols = document.getElementById("includeSymbols").checked;

  const lowercaseChars = "abcdefghijklmnopqrstuvwxyz";
  const uppercaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  const numberChars = "0123456789";
  const symbolChars = "!@#$%^&*()_-+=";

  let charset = lowercaseChars;

  if (includeUppercase) {
    charset += uppercaseChars;
  }

  if (includeNumbers) {
    charset += numberChars;
  }

  if (includeSymbols) {
    charset += symbolChars;
  }

  let password = "";

  for (let i = 0; i < length; i++) {
    const randomIndex = Math.floor(Math.random() * charset.length);
    password += charset.charAt(randomIndex);
  }

  return password;
}

document.getElementById("generateBtn").addEventListener("click", function() {
  const generatedPassword = generatePassword();
  document.getElementById("password").value = generatedPassword;
});

document.getElementById("copyBtn").addEventListener("click", function() {
  const passwordField = document.getElementById("password");
  passwordField.select();
  document.execCommand("copy");

  // Mostrar el mensaje emergente
  const successPopup = document.getElementById("successPopup");
  successPopup.style.display = "block";

  // Ocultar el mensaje emergente después de unos segundos (ajustar según sea necesario)
  setTimeout(function() {
    successPopup.style.display = "none";
  }, 2000); // Ocultar después de 2 segundos
});
