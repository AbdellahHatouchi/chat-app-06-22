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
    err = document.getElementById('error'),
    btnSubmit=document.getElementById('submit');
function createCompte(){
    try {
        let myRequest = new XMLHttpRequest();
        myRequest.open("POST", "/APP/signup.php");
        myRequest.onreadystatechange = () => {
            let data = myRequest.responseText;
            if (myRequest.readyState === 4 && myRequest.status === 200) {
                if (data === 'successful') {
                    console.log(data);
                    err.style.display = 'none';
                    form.innerHTML = '<div class="spinner"><span class="border-spinner"></span></div>';
                    location.replace('/APP/login.php');
                }else {
                    if (data === 'ERROR: Could not connect.') {
                        error('Error!', 'You have in Error of connect to Database', 'error', 'Try Again');
                    }else {
                        err.innerHTML = data;
                        err.style.display = 'block';
                    }
                }
                console.log(myRequest);
            }
        }
        let myform = new FormData(form);
        myRequest.send(myform);
    } catch (err) {
        error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
    }
}
form.onsubmit = (e)=> {
    e.preventDefault();
}
btnSubmit.addEventListener('click',createCompte);
