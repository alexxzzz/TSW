const form = document.querySelector(".loginForm");

form.addEventListener("submit", function (e) {
  e.preventDefault();
  if (
    document.querySelector("#user").value === "admin" &&
    document.querySelector("#password").value === "admin"
  ) {
    window.location.href = "../dashboard.html";
  } else {
    alert("Para entrar: User: admin, Contraseña: admin");
  }
});
