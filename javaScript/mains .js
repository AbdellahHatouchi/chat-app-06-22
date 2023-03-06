let listUsers = Array.from(document.querySelectorAll(".users-list #name"));
let searchInput = document.getElementById("search");
let p = document.createElement("p");
searchInput.addEventListener('input',()=>{
    console.log("hi")
    let val = searchInput.value;
    let test = false;
    listUsers.forEach(element => {
        if (element.innerHTML.indexOf(val) != -1) {
            element.parentNode.parentNode.parentNode.style.display = 'flex';
            test = true;
            p.remove();
        }else {
            element.parentNode.parentNode.parentNode.style.display = "none";
        }
    });
    if (!test) {
        p.innerHTML = "Netting user";
        document.querySelector(".users-list").appendChild(p)
    }
})


let btnSeach = document.querySelector(".user .search button");
btnSeach.addEventListener("click",()=> {
    searchInput.classList.toggle("search-active");
    searchInput.focus();
    if(btnSeach.classList.contains('btn-active')){
        listUsers.forEach(element => {
            element.parentNode.parentNode.parentNode.style.display = 'flex';
        })
        p.remove();
        searchInput.value = "";
    }
    btnSeach.classList.toggle("btn-active");
})



