

function verifier(event)
{
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var cin = document.getElementById("cin").value;
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var date = document.getElementById("date").value;
    var num = document.getElementById("num").value;
    var region = document.getElementById("region").value;
    var code = document.getElementById("code").value;
    var sexe = document.getElementById("sexe").value;
    var pwd = document.getElementById("pwd").value;
    var ville = document.getElementById("ville").value;

    //

    if(username == "") {
        document.getElementById("alertUsername").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertUsername").style.display = 'none';
    }

    if(email == ""){
        document.getElementById("alertEmail").style.display = 'block';
        event.preventDefault();
    }
    else{

        document.getElementById("alertEmail").style.display = 'none';
    }

    if(pwd == ""){
        document.getElementById("alertPwd").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertPwd").style.display = 'none';
    }

    if(cin == ""){
        document.getElementById("alertCin").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertCin").style.display = 'none';
    }

    if(nom == "")
    {
        document.getElementById("alertNom").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertNom").style.display = 'none';
    }

    if(prenom == "")
    {
        document.getElementById("alertPrenom").style.display = 'block';
        event.preventDefault();
    }

    else{
        document.getElementById("alertPrenom").style.display = 'none';
    }
    if(ville == "")
    {
        document.getElementById("alertVille").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertVille").style.display = 'none';
    }

    if(region == "")
    {
        document.getElementById("alertRegion").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertRegion").style.display = 'none';
    }

    if(code == "")
    {
        document.getElementById("alertCode").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertCode").style.display = 'none';
    }

    if(date == "")
    {
        document.getElementById("alertDate").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertDate").style.display = 'none';
    }

    if(num == "")
    {
        document.getElementById("alertPhone").style.display = 'block';
        event.preventDefault();
    }
    else{
        document.getElementById("alertPhone").style.display = 'none';
    }

}

function validUsername()
{
    var username = document.getElementById("username").value;
    if(username.length == 0)
    {
        document.getElementById("alertUsername").style.display = 'block';
        document.getElementById("signup").disabled = true;
    }
    else
    {
        document.getElementById("alertUsername").style.display = 'none';
        document.getElementById("signup").disabled = false;
    }
}

function validCin()
{
    var cin = document.getElementById("cin").value;
    if(cin.length != 8 || isNaN(cin))
    {
        document.getElementById("alertCin").style.display = 'block';
        document.getElementById("signup").disabled = true;
    }
    else
    {
        document.getElementById("alertCin").style.display = 'none';
        document.getElementById("signup").disabled = false;
    }

        //alertUsername
}

function validateEmail(email)
{
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validEmail()
{
    var email = document.getElementById("email").value;

    if(email.length == 0)
    {
        document.getElementById("alertEmail").style.display = 'block';
        document.getElementById("signup").disabled = true;
    }
    else
    {
        document.getElementById("alertEmail").style.display = 'none';
        if(!validateEmail(email))
        {
            document.getElementById("alertEmailNotValid").style.display = 'block';
            document.getElementById("signup").disabled = true;
        }
        else
        {
            document.getElementById("alertEmailNotValid").style.display = 'none';
            document.getElementById("signup").disabled = false;
        }

    }
}

function validName()
{
    var nom = document.getElementById("nom").value;

    if(nom.length == 0)
        document.getElementById("alertNom").style.display = 'block';
    else
        document.getElementById("alertNom").style.display = 'none';
}

function validRegion()
{
    var region = document.getElementById("region").value;

    if(region.length == 0)
    {
        document.getElementById("signup").disabled = true;
        document.getElementById("alertRegion").style.display = 'block';
    }
    else
    {
        document.getElementById("signup").disabled = false;
        document.getElementById("alertRegion").style.display = 'none';
    }

}

function validVille()
{
    var ville = document.getElementById("ville").value;

    if(ville.length == 0)
    {
        document.getElementById("signup").disabled = true;
        document.getElementById("alertVille").style.display = 'block';
    }
    else
    {
        document.getElementById("signup").disabled = false;
        document.getElementById("alertVille").style.display = 'none';
    }

}

function validPrenom()
{
    var prenom = document.getElementById("prenom").value;
    if(prenom.length == 0)
    {
        document.getElementById("signup").disabled = true;
        document.getElementById("alertPrenom").style.display = 'block';
    }

    else
    {
        document.getElementById("signup").disabled = false;
        document.getElementById("alertPrenom").style.display = 'none';
    }

}

function validPhone()
{
    var num = document.getElementById("num").value;

    console.log(num);
    if(num.length == 0)
    {
        document.getElementById("signup").disabled = true;
        document.getElementById("alertPhone").style.display = 'block';
    }
    else
    {
        document.getElementById("alertPhone").style.display = 'none';
        if(num.length != 8 || isNaN(num))
        {
            document.getElementById("signup").disabled = true;
            document.getElementById("alertPhoneNotValid").style.display = 'block';
        }
        else
        {
            document.getElementById("signup").disabled = false;
            document.getElementById("alertPhoneNotValid").style.display = 'none';
        }
    }

}

function validCode()
{
    var code = document.getElementById("code").value;
    console.log(code);
    if(code.length == 0)
    {
        document.getElementById("signup").disabled = true;
        document.getElementById("alertCode").style.display = 'block';
    }
    else
    {
        document.getElementById("alertCode").style.display = 'none';
        if(code.length != 4 || isNaN(code)){
            document.getElementById("signup").disabled = true;
            document.getElementById("alertCodeNotValid").style.display = 'block';
        }
        else
        {
            document.getElementById("alertCodeNotValid").style.display = 'none';
            document.getElementById("signup").disabled = false;
        }

    }

}


function validPassword()
{
    var pwd = document.getElementById("pwd").value;

    if(pwd.length == 0)
    {
        document.getElementById("signup").disabled = true;
        document.getElementById("alertPwd").style.display = 'block';
    }
    else
    {
        document.getElementById("alertPwd").style.display = 'none';
        document.getElementById("signup").disabled = false;
    }
}

function showPassword()
{
    if(document.getElementById('pwd').type == 'text')
    {
        document.getElementById('pwd').type = 'password';
        document.getElementById('icon').classList.remove('fa-eye-slash');
        document.getElementById('icon').classList.add('fa-eye');
    }
    else
    {
        document.getElementById('pwd').type = 'text';
        document.getElementById('icon').classList.remove('fa-eye');
        document.getElementById('icon').classList.add('fa-eye-slash');
    }
    }


    function passwordStength()
    {
        var val = document.getElementById("pwd").value;
        var no=0;
        if(val == "")
        {
            document.getElementById("pswd_info").style.display = "block";
            document.getElementById("length").style.color = "red";
            document.getElementById("number").style.color = "red";
            document.getElementById("space").style.color = "red";
            document.getElementById("capital").style.color = "red";
            document.getElementById("alertPwd").style.display = "block";
            document.getElementById("alertPwdStrength").style.display = "none";
            document.getElementById("alertPwdStrength").style.display = "none";
            document.getElementById("alertPwdStrength").style.display = "none";
            document.getElementById("signup").disabled = true;
        }
        else
        {
            document.getElementById("alertPwd").style.display = "none";
            document.getElementById("pswd_info").style.display = "block";
            if(val.length < 8)
            {
                no=1;
                document.getElementById("length").style.color = "red";
                document.getElementById("number").style.color = "red";
                document.getElementById("space").style.color = "red";
                document.getElementById("capital").style.color = "red";

                //alertPwd
            }


            // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
            if(val.length >=8 && (val.match(/[a-z]/) ))
            {
                document.getElementById("length").style.color = "green";
            }
            if(val.length>=8 && (val.match(/[A-Z]/) ))
            {
                document.getElementById("capital").style.color = "green";
            }
            if(val.length>=8 &&(val.match(/\d+/)))
            {
                no=2;
                document.getElementById("number").style.color = "green";
            }

            if(val.length>=8 && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,),\\,/,|,[,ù,%]/))
            {
                no=2;
                document.getElementById("space").style.color = "green";
            }

            // If the password length is greater than 6 and contain alphabet,number,special character respectively
            if(val.length>8 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,),\\,/,|,[,ù,%]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))
            {
                no=3;
            }

            // If the password length is greater than 6 and must contain alphabets,numbers and special characters
            if(val.length>8 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,),\\,/,|,\[,\],ù,%]/))
            {
                document.getElementById("length").style.color = "green";
                document.getElementById("number").style.color = "green";
                document.getElementById("space").style.color = "green";
                document.getElementById("capital").style.color = "green";

                no=4;
            }

            if(no==1)
            {
                console.log("Very weak");
                document.getElementById("alertPwdStrength").innerHTML = "Very weak";
                document.getElementById("alertPwdStrength").style.display = "block";
                document.getElementById("alertPwdStrength").classList.remove("alert-success");
                document.getElementById("alertPwdStrength").classList.remove("alert-warning");
                document.getElementById("alertPwdStrength").classList.add("alert-danger");
                document.getElementById("signup").disabled = true;
            }

            if(no==2)
            {
                console.log("weak");
                document.getElementById("alertPwdStrength").innerHTML = "weak";
                document.getElementById("alertPwdStrength").style.display = "block";
                document.getElementById("alertPwdStrength").classList.remove("alert-success");
                document.getElementById("alertPwdStrength").classList.remove("alert-danger");
                document.getElementById("alertPwdStrength").classList.add("alert-warning");
                document.getElementById("signup").disabled = true;
            }

            if(no==3)
            {
                console.log("Good");
                document.getElementById("alertPwdStrength").innerHTML = "Good";
                document.getElementById("alertPwdStrength").style.display = "block";
                document.getElementById("alertPwdStrength").classList.remove("alert-danger");
                document.getElementById("alertPwdStrength").classList.remove("alert-warning");
                document.getElementById("alertPwdStrength").classList.add("alert-success");
                document.getElementById("signup").disabled = false;
            }

            if(no==4)
            {
                console.log("Strong");
                document.getElementById("alertPwdStrength").innerHTML = "Strong";
                document.getElementById("alertPwdStrength").style.display = "block";
                document.getElementById("alertPwdStrength").classList.remove("alert-danger");
                document.getElementById("alertPwdStrength").classList.remove("alert-warning");
                document.getElementById("alertPwdStrength").classList.add("alert-success");
                document.getElementById("signup").disabled = false;
            }
        }
    }

    function validateDate()
    {
        var today = new Date();
        var dateN = document.getElementById("date").value;
        var dateNaissance = new Date(dateN);
        if(today <= dateNaissance)
        {
            document.getElementById("signup").disabled = true;
            document.getElementById("alertDate").style.display = "block";
        }
        else{
            document.getElementById("signup").disabled = false;
            document.getElementById("alertDate").style.display = "none";
        }

    }