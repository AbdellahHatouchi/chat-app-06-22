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
try {
    let myRequest = new XMLHttpRequest();
    myRequest.onreadystatechange = () => {
        if (myRequest.readyState === 4 && myRequest.status === 200) {
            if (myRequest.responseText !== "") {
                error('Error!', 'You have in Error of connect to Database', 'error', 'Try Again');
            }
            console.log(myRequest.responseText);
        }
    }
    myRequest.open("POST", "/APP/db_config.php");
    myRequest.send();
} catch (e) {
    error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
}

