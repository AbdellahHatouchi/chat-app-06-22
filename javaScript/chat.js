function messageEmptyOrError(icon,title) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: icon,
        title: title
    })
}
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


let ul = document.getElementById('setting');
let btnSetting = document.getElementById('btn-setting');
btnSetting.addEventListener("click", () => {
    if (getComputedStyle(ul).display === 'none') {
        ul.style.display = 'block';
    } else {
        ul.style.display = 'none';
    }
})


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

let form = document.getElementById("myform");
const datainfo = document.getElementById("contentid").getAttribute("data"),
    btnSubmit = document.getElementById('submit');
function createMessage() {
    try {
        let myRequest = new XMLHttpRequest();
        myRequest.open("POST", "/APP/message.php");
        myRequest.onreadystatechange = () => {
            let data = myRequest.responseText;
            if (myRequest.readyState === 4 && myRequest.status === 200) {
                if (data === 'successful') {
                    console.log(data);
                    document.getElementById("message").value = '';
                    document.querySelector(".emojionearea .emojionearea-editor").innerHTML = '';
                } else {
                    if (data === 'message empty') {
                        messageEmptyOrError('warning','You Cannot Send An Empty Message');
                    }
                    if (data === 'ERROR: Could not connect.') {
                        error('Error!', 'You have in Error of connect to Database', 'error', 'Try Again');
                    }else {
                        messageEmptyOrError('error','Your Message Exceeded The Limit Of 255 Characters');
                    }

                }
                console.log(myRequest.responseText);
            }

        }
        let myform = new FormData(form);
        myform.append('data', datainfo);
        myRequest.send(myform);
    } catch (err) {
        error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
    }
}
form.onsubmit = (e) => {
    e.preventDefault();
}
btnSubmit.addEventListener('click', createMessage);

