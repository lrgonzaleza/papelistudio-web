
    document.addEventListener("DOMContentLoaded", () => {
    const rutInput = document.getElementById("rut");
    const form = document.querySelector(".register-form");

    if (!rutInput || !form) return;

    console.log("🧩 Validación de RUT activa con mensajes visuales");

    const msg = document.createElement("small");
    msg.style.display = "block";
    msg.style.marginTop = "4px";
    msg.style.fontSize = "0.9em";
    form.querySelector(".form-group:nth-child(3)").appendChild(msg);


    function validarRut(rut) {
        rut = rut.replace(/\./g, "").replace(/-/g, "").trim();
        if (!/^[0-9]+[0-9kK]{1}$/.test(rut)) return false;

        const cuerpo = rut.slice(0, -1);
        const dv = rut.slice(-1).toUpperCase();
        let suma = 0, multiplo = 2;

        for (let i = cuerpo.length - 1; i >= 0; i--) {
        suma += multiplo * parseInt(cuerpo.charAt(i));
        multiplo = multiplo < 7 ? multiplo + 1 : 2;
        }

        const dvEsperado = 11 - (suma % 11);
        const dvFinal =
        dvEsperado === 11 ? "0" :
        dvEsperado === 10 ? "K" :
        dvEsperado.toString();

        return dv === dvFinal;
    }


    function formatearRut(valor) {
        valor = valor.replace(/\./g, "").replace(/-/g, "");
        if (valor.length <= 1) return valor;
        const cuerpo = valor.slice(0, -1);
        const dv = valor.slice(-1);
        return cuerpo.replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "-" + dv;
    }


    rutInput.addEventListener("input", function () {
        const valorSinFormato = this.value.replace(/\./g, "").replace(/-/g, "");
        this.value = formatearRut(valorSinFormato);
        msg.textContent = ""; // Limpia mensaje mientras escribe
        this.style.borderColor = "";
    });

    rutInput.addEventListener("blur", function () {
        const valor = this.value.trim();
        if (valor === "") {
        msg.textContent = "";
        this.style.borderColor = "";
        return;
        }

        if (!validarRut(valor)) {
        this.style.borderColor = "red";
        msg.textContent = "❌ RUT inválido, verifica el número.";
        msg.style.color = "red";
        } else {
        this.style.borderColor = "green";
        msg.textContent = "✅ RUT válido.";
        msg.style.color = "green";
        }
    });


    form.addEventListener("submit", function (e) {
        const rutValor = rutInput.value.trim();
        if (!validarRut(rutValor)) {
        e.preventDefault();
        msg.textContent = "❌ El RUT ingresado no es válido. Corrige antes de continuar.";
        msg.style.color = "red";
        rutInput.style.borderColor = "red";
        rutInput.focus();
        }
    });
    });

