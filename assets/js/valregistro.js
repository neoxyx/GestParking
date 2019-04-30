function valida() {

    var tipousario;
    tipousuario = document.getElementById("nivel").value;
    console.log(tipousuario)


    var nombre;
    var apellidos;
    var tel;
    var email;
    var documento;
    var pass;
    var cpass;

    var empresa;
    //var siglas;
    var telemp;
    var emaile;
    var nit;
    var passe;
    var cpasse;


    //variables que validan el password
    var mayus = /[A-Z]/;
    var numeros = /\d/;
    var min = /[a-z]/;



    //console.log(nombre)
    if (tipousuario === "3") {

        nombre = document.getElementById("login-username").value;
        apellidos = document.getElementById("apellidos").value;
        tel = document.getElementById("tel1").value;
        email = document.getElementById("email").value;
        documento = document.getElementById("DocIdentidad").value;
        pass = document.getElementById("pswd").value;
        cpass = document.getElementById("pswdc").value;


        if (nombre === "") {
            alert("Dígite su nombre, por favor");
            return false;
        }
        else if (apellidos === "") {
            alert("Dígite sus apellido, por favor");
            return false;
        }
        else if (tel === "") {
            alert("Dígite su número telefónico, por favor");
            return false;
        }
        else if (tel.length < 10) {
            alert("Sí es un número fijo dígite 03 + indicativo + número de telefono, ejemplo 0314968958, ");
            return false;
        }
        else if (email === "") {
            alert("Dígite su email, por favor");
            return false;
        }
        else if (documento === "") {
            alert("Dígite su número de identificación (Usuario), por favor");
            return false;
        }
        else if (pass === "") {
            alert("Dígite su contraseña, por favor");
            return false;
        }


        else if (!((numeros.test(pass) &&
                min.test(pass)) || (numeros.test(pass) &&
                mayus.test(pass)))) {
            alert("La contraseña debe contener por lo menos un número y una letra para que sea segura");
            return false;
        }

        else if (cpass === "") {
            alert("Dígite su nuevamente su contraseña en el campo de verificación, por favor");
            return false;
        }

        else if (pass != cpass) {
            alert("Verifique que los dos campos de contraseña coincidan.");
            return false;
        }





    }

    else if (tipousuario === "2") {


        empresa = document.getElementById("empresa").value;
        siglas = document.getElementById("siglas").value;
        telemp = document.getElementById("tel1e").value;
        emaile = document.getElementById("emaile").value;
        nit = document.getElementById("nit").value;
        passe = document.getElementById("pswde").value;
        cpasse = document.getElementById("pswdce").value;





        if (empresa === "") {
            alert("Dígite el nombre de su empresa, por favor");
            return false;
        }
        /*else if(siglas===""){
         alert("Dígite las siglas de su razón social, por favor");
         return false;
         }*/
        else if (telemp === "") {
            alert("Dígite el número telefónico de contanto de su empresa, por favor");
            return false;
        }
        else if (telemp.length < 10) {
            alert("Sí es un número fijo dígite 03 + indicativo + número de telefono, ejemplo: 0314968958");
            return false;
        }
        else if (emaile === "") {
            alert("Dígite el email de contacto, por favor");
            return false;
        }
        else if (nit === "") {
            alert("Dígite el NIT de su empresa (Usuario), por favor");
            return false;
        }
        else if (passe === "") {
            alert("Dígite su contraseña, por favor");
            return false;
        }

        else if (!((numeros.test(passe) &&
                min.test(passe)) || (numeros.test(passe) &&
                mayus.test(passe)))) {
            alert("La contraseña debe contener por lo menos un número y una letra para que sea segura");
            return false;
        }

        else if (cpasse === "") {
            alert("Dígite su nuevamente su contraseña en el campo de verificación, por favor");
            return false;
        }

        else if (passe != cpasse) {
            alert("Verifique que los dos campos de contraseña coincidan.");
            return false;
        }


    }


}



