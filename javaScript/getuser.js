function error(title, text, icon, textbtn) {
    Swal.fire({
        title: `${title}`,
        text: `${text}`,
        icon: `${icon}`,
        confirmButtonText: `${textbtn}`
    }

    ).then(function () {
        location.reload();
    });
}


let userlist = document.getElementById("users-list");
const btnSeach = document.getElementById('btn-search'),inputSerch=document.getElementById('search');




inputSerch.addEventListener('input',()=> {
    try {
        let myRequest = new XMLHttpRequest();
        myRequest.open("POST", "/APP/search.php");
        myRequest.onreadystatechange = () => {
            let data = myRequest.responseText;
            if (myRequest.readyState === 4 && myRequest.status === 200) {
                userlist.innerHTML = data;
            }
        }
        myform = new FormData();
        myform.append('dataName',inputSerch.value);
        myRequest.send(myform);
    } catch (err) {
        error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
    }
})

    function createUser() {
        try {
            let myRequest = new XMLHttpRequest();
            myRequest.open("POST", "/APP/getuser.php");
            myRequest.onreadystatechange = () => {
                let data = myRequest.responseText;
                if (myRequest.readyState === 4 && myRequest.status === 200) {
                    userlist.innerHTML = data;
                }
            }
            myRequest.send();
        } catch (err) {
            error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
        }
    }

    let setUser = setInterval(() => {
        createUser();
    }, 1500)

    btnSeach.addEventListener('click',()=> {
        inputSerch.classList.toggle("search-active");
        inputSerch.focus();
        btnSeach.classList.toggle("btn-active");
        if (btnSeach.classList.contains("btn-active")) {
            clearInterval(setUser);
        }else {
            inputSerch.value = '';
            userlist.innerHTML = '<div class="spinner"><span class="border-spinner"></span></div>';
            setUser = setInterval(() => {
                createUser();
            }, 1500)
        }
    })