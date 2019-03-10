
function isValid(str,pattern){
    if(str.match(pattern)==null)
        return false;
    else
        true;
}
document.querySelectorAll("input[type='submit']").forEach((button)=>{button.disabled=true});

var name=pass=cpass=email=false;
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

    if((this.value.search(/^[a-z]\@[a-z]{2}\.iitr\.ac\.in$/)) == -1)
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
window.addEventListener("keyup",()=>{
    if(pass && name && cpass && email){
        document.forms[0]['submit'].disabled=false;
    }
})

