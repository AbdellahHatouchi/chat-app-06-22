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

const form = document.getElementById("myform"),
    btnsubmit = document.getElementById('submit'),
    err = document.getElementById('error');
function valide(){
    try {
        let myRequest = new XMLHttpRequest();
        myRequest.open("POST",`${location.origin}/APP/loginValide.php`);
        myRequest.onreadystatechange = ()=>{
            if (myRequest.readyState === 4 && myRequest.status === 200) {
                let data = myRequest.responseText;
                if (data === 'successful') {
                    err.style.display = 'none';
                    location.replace(`${location.origin}/APP/main.php`);
                    console.log(data);
                }else {
                    if (data === 'ERROR: Could not connect.') {
                        error('Error!', 'You have in Error of connect to Database', 'error', 'Try Again');
                    }else {
                        err.innerHTML = data;
                        err.style.display = 'block';
                    }
                }
            }
        }
        let myform = new FormData(form);
        myRequest.send(myform)
    } catch (error) {
        error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
    }
}
form.onsubmit = (e)=>{
    e.preventDefault();
}
// btnsubmit.addEventListener("click",valide);
btnsubmit.onclick = ()=>{
    valide();
}