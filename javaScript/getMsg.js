


let chatbox = document.getElementById("chat-box");
let datauser = document.getElementById("contentid").getAttribute("data");
let test = true;
let lastlendata = 0;
let myform = new FormData();
let newform = form.cloneNode(true);
let parentform = form.parentNode;
let validetion = false;
let validetion2 = false;
let info = 'getdata';
function blockUser(info) {
    try {
        let myRequest = new XMLHttpRequest();
        myRequest.open("POST", "/APP/blockUser.php");
        myRequest.onreadystatechange = () => {
            let data = myRequest.responseText;
            if (myRequest.readyState === 4 && myRequest.status === 200) {
                if (info == 'getdata') {
                    if (data == 'noblock' && validetion2 == true) {
                        parentform.appendChild(newform);
                        form = document.getElementById("myform");
                        validetion = false;
                        validetion2 = false;
                        $("#message").emojioneArea({
                            pickerPosition : 'top right'
                        })
                    } else if (data == '10' || data == "01") {
                        if (validetion == false) {
                            parentform.removeChild(form);
                            validetion = true;
                        }
                        if (data == '10') {
                            blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Unblock';
                            blockitem.classList.add('block-active');
                        } else {
                            blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Block';
                            blockitem.classList.remove('block-active');
                            validetion2 = true;
                        }
                    } else if (data == 'block' && validetion == false) {
                        blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Unblock';
                        parentform.removeChild(form);
                        blockitem.classList.add('block-active');
                        validetion = true;
                        validetion2 = true;
                    }
                    // else {
                    //     messageEmptyOrError('error', 'You Have In Error !');
                    // }
                } else if (info == 'changedata') {
                    if (data == 'block') {
                        blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Unblock';
                        blockitem.classList.add('block-active');
                        // if (validetion == false) {
                        //     parentform.removeChild(form);
                        // }
                        validetion2 = true;
                    } else if (data == 'unblock') {
                        blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Block';
                        // parentform.appendChild(newform);
                        // form = document.getElementById("myform");
                        blockitem.classList.remove('block-active');
                        // validetion = false;
                    }
                } else {
                    messageEmptyOrError('error', 'You Have In Error !');
                }

                // if (info == 'changedata') {
                //     location.reload();
                // } else {
                //     if (data == 1) {
                //         blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Unblock';
                //     parentform.removeChild(form);
                //     blockitem.classList.add('block-active');
                //     }else if (data == 0) {

                //     }

                // }
                // if (data == 1 && info == 'getdata' && validetion == false) {
                //     blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Unblock';
                //     parentform.removeChild(form);
                //     blockitem.classList.add('block-active');
                //     validetion = true;
                // }else if (data == 1 && info == 'changedata') {
                //     blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Unblock';
                //     parentform.removeChild(form);
                //     blockitem.classList.add('block-active');
                // }
                // else if (data == 0 && info == "changedata"){
                //     blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Block';
                //     parentform.appendChild(newform);
                //     form = document.getElementById("myform");
                //     blockitem.classList.remove('block-active');
                //     validetion2 = true;
                // }else if(data == 0 && info == 'getdata' && validetion2 == true) {
                //     blockitem.classList.remove('block-active');
                //     blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Block';
                //         parentform.appendChild(newform);
                //         form = document.getElementById("myform");
                //         validetion2 = false;
                // }else if(data == 0 && info == 'getdata' && validetion2 == false) {
                //     blockitem.classList.remove('block-active');
                //     blockitem.innerHTML = '<i class="fa-solid fa-ban"></i> Block';
                // }
                // console.log(data)
                // console.log(validetion2)
            }
        }
        myform.append('data', datauser);
        myform.append('info', info);
        myRequest.send(myform);
    } catch (err) {
        error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
    }
}
function createMessage() {
    try {
        let myRequest = new XMLHttpRequest();
        myRequest.open("POST", "/APP/test.php");
        myRequest.onreadystatechange = () => {
            let data = myRequest.responseText;
            if (myRequest.readyState === 4 && myRequest.status === 200) {
                if (data.length > lastlendata) {
                    test = true;
                    lastlendata = data.length;
                }
                chatbox.innerHTML = data;
                if (test === true) {
                    // chatbox.scrollTo(0, document.body.scrollHeight);
                    chatbox.scrollTop = chatbox.scrollHeight;
                    test = false;
                }
            }
        }
        myform.append('data', datauser);
        myRequest.send(myform);
    } catch (err) {
        error('Error!', 'You have in Error of connect to Server', 'error', 'Try Again');
    }
}

let blockitem = document.getElementById('block');


// block user
blockitem.addEventListener('click', () => {
    blockitem.innerHTML = 'Please wait ...<div class="spinneritem"></div>';
    setTimeout(() => {
        info = 'changedata';
        blockUser(info)
    }, 1500);
})
// message
let getMsg = setInterval(() => {
    createMessage();
    info = 'getdata';
    blockUser(info);
}, 800)

// function data(node,dt) {
//     let date = new Date(dt);
//     clearInterval(getMsg);
//     node.previousElementSibling.innerHTML = date;
//     node.previousElementSibling.classList.add('activeS');
//     setTimeout(() => {
//         node.previousElementSibling.classList.remove('activeS');
//         getMsg = setInterval(() => {
//             createMessage();
//             info = 'getdata';
//             blockUser(info);
//         }, 800)
        
//     }, 5000);
// }






