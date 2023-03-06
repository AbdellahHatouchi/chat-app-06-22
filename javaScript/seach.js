let searchInput = document.getElementById("search");
let listUsers = Array.from(document.querySelectorAll(".users-list #name"));


searchInput.addEventListener('keypress',()=>{
    console.log("hi")
    let value = search.value;
    let test = false;
    listUsers.forEach(element => {
        if (element.innerHTML.indexOf(value) != -1) {
            element.parentNode.parentNode.parentNode.style.display = 'flex';
            test = true;
        }else {
            element.parentNode.parentNode.parentNode.style.display = "none";
        }
    });
    if (!test) {
        p = document.createElement("p");
        p.innerHTML = "Netting user";
        document.querySelector(".users-list").appendChild(p)
    }
})
