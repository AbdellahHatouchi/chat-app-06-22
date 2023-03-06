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

const btnSeach = document.getElementById('btn-search'),inputSerch=document.getElementById('search');

btnSeach.addEventListener('click',()=> {
    inputSerch.classList.toggle("search-active");
    inputSerch.focus();
    btnSeach.classList.toggle("btn-active");
})


inputSerch.addEventListener('input',()=> {
    try {
        let myRequest = new XMLHttpRequest();
        myRequest.open("POST", "/APP/search.php");
        myRequest.onreadystatechange = () => {
            let data = myRequest.responseText;
            if (myRequest.readyState === 4 && myRequest.status === 200) {
                userlist.innerHTML = data;
                console.log(data);
            }
        }
        myform = new FormData();
        myform.append('dataName',inputSerch.value);
        myRequest.send(myform);
    } catch (err) {
        error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
    }
})