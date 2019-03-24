Array.from(document.querySelectorAll(".inputs li")).forEach(function(obj){
    obj.addEventListener("click",function(e){
        var curr=e.target.parentNode.lastChild;
		if(curr.style.display=='none')
			curr.style.display='block';
		else
			curr.style.display='none';
    })
})