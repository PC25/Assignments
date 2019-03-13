
document.forms[0]['submit'].disabled=true;

var name=pass=cpass=email=username=false;
document.forms[0]['sname'].addEventListener("keydown",function(e){
    if((this.value.search(/^\w[\w /_ /.]{5,}$/)) == -1)
        this.nextElementSibling.innerHTML="Username is too short";
    else{
        this.nextElementSibling.innerHTML="";
        name=true;
    }
})

document.forms[0]['spassword'].addEventListener("keyup",function(e){
    if((this.value.search(/^[\w \d /@ /. /& /%]{6,}$/)) == -1)
        this.nextElementSibling.innerHTML="Password is too short";
    else{
            this.nextElementSibling.innerHTML="";
            pass=true;
        }
})

document.forms[0]['semail'].addEventListener("keyup",function(e){

    if((this.value.search(/^[a-z]+\@[a-z]{2}\.iitr\.ac\.in$/)) == -1)
        this.nextElementSibling.innerHTML="Invalid Email-Id";
    else{
            this.nextElementSibling.innerHTML="";
            email=true;
        }
})

document.forms[0]['scpassword'].addEventListener("keyup",function(e){
    if(this.value!= document.forms[0]['spassword'].value)
        this.nextElementSibling.innerHTML="Passwords don't match";
    else{
            this.nextElementSibling.innerHTML="";
            cpass=true;
        }

})
document.forms[0]['susername'].addEventListener("blur",function(e){
    var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        if(this.response.split(',').includes(document.forms[0]['susername'].value))
            document.forms[0]['susername'].nextElementSibling.innerHTML="Sorry this username is not available!!";
        else{
            document.forms[0]['susername'].nextElementSibling.innerHTML="";
            username=true;
        }
        }
        };
        xhttp.open("GET", "available.php", true);
        xhttp.send();
    }
)
window.addEventListener("keyup",()=>{
    if(pass && name && cpass && email && username){
        document.forms[0]['submit'].disabled=false;
    }
})
//  all above stuff is for sign-up

//---------------------------------------------------------------


