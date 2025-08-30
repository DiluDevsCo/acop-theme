document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("custom-login-form");

  if (!loginForm) return;

  loginForm.addEventListener("submit", handleLoginSubmit);

  function handleLoginSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const messagesDiv = document.getElementById("login-messages");
    const submitBtn = document.getElementById("login-submit-btn");
    const usernameField = document.getElementById("username");
    const passwordField = document.getElementById("password");
    const rememberField = document.getElementById("remember");

    if (!usernameField.value.trim() || !passwordField.value.trim()) {
      showMessage("Por favor, completa todos los campos.", "error");
      return;
    }

    submitBtn.disabled = true;
    submitBtn.textContent = "Iniciando sesión...";
    showMessage("Iniciando sesión...", "loading");

    const formData = new FormData();
    formData.append("action", "ajax_login");
    formData.append("username", usernameField.value.trim());
    formData.append("password", passwordField.value);
    formData.append("remember", rememberField.checked ? "1" : "0");
    formData.append(
      "redirect_to",
      form.dataset.redirect || window.location.origin
    );

    // Usar la URL de admin-ajax.php directamente
    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
      credentials: "same-origin",
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          showMessage("¡Inicio de sesión exitoso! Redirigiendo...", "success");
          setTimeout(() => {
            window.location.href = data.data.redirect;
          }, 1000);
        } else {
          // Verificar si es un usuario inactivo
          if (data.data && data.data.error_type === "inactive_member") {
            showMessage(
              data.data.message || "Tu cuenta se encuentra inactiva.",
              "warning"
            );
          } else {
            showMessage(
              data.data.message || "Error al iniciar sesión.",
              "error"
            );
          }
          resetForm();
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        showMessage("Error de conexión. Inténtalo de nuevo.", "error");
        resetForm();
      });

    function resetForm() {
      submitBtn.disabled = false;
      submitBtn.textContent = "Iniciar Sesión";
    }

    function showMessage(message, type) {
      if (!messagesDiv) return;

      let className = "";
      let icon = "";

      switch (type) {
        case "success":
          className = "bg-green-50 border-l-4 border-green-400 text-green-800";
          icon = "✓";
          break;
        case "error":
          className = "bg-red-50 border-l-4 border-red-400 text-red-800";
          icon = "✕";
          break;
        case "warning":
          className = "bg-amber-50 border-l-4 border-amber-400 text-amber-800";
          icon = "⚠";
          break;
        case "loading":
          className = "bg-blue-100 border border-blue-400 text-blue-700";
          icon = "⟳";
          break;
        default:
          className = "bg-gray-100 border border-gray-400 text-gray-700";
          icon = "•";
      }

      messagesDiv.innerHTML = `
        <div class="${className} p-4 mb-4 rounded-r-lg shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <span class="inline-block w-5 h-5 text-center font-bold text-sm">${icon}</span>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">${message}</p>
                </div>
            </div>
        </div>
    `;
    }
  }
});