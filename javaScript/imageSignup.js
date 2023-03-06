let fileimage = document.getElementById('file');
let imageSignup = document.getElementById('image');
fileimage.onchange = ()=>{
    try {
        let myRequest = new XMLHttpRequest();
        myRequest.open("POST", "/APP/imageSignup.php");
        myRequest.onreadystatechange = () => {
            let data = myRequest.responseText;
            if (myRequest.readyState === 4 && myRequest.status === 200) {
                if (data !== 'error') {
                    imageSignup.src = data;
                }
            }
        }
        myform = new FormData(form);
        myRequest.send(myform);
    } catch (err) {
        error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
    }
}