
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
        if (!rut) return false;

        
        rut = rut.replace(/\./g, "").replace(/-/g, "").trim().toUpperCase();

         
        if (rut.length < 8 || rut.length > 10) return false;

         
        if (!/^[0-9]+[0-9K]$/.test(rut)) return false;

            
        const cuerpo = rut.slice(0, -1);
        const dv = rut.slice(-1);
        const num = parseInt(cuerpo);

         
        if (num < 1000000 || num > 99999999) return false;

        
        if (/^(\d)\1+$/.test(cuerpo)) return false;

        
        let suma = 0, multiplicador = 2;

        for (let i = cuerpo.length - 1; i >= 0; i--) {
            suma += multiplicador * parseInt(cuerpo[i]);
            multiplicador = multiplicador === 7 ? 2 : multiplicador + 1;
        }

        const resto = 11 - (suma % 11);
        const dvEsperado =
            resto === 11 ? "0" :
            resto === 10 ? "K" :
            resto.toString();

        return dv === dvEsperado;
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

