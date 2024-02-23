function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith(name + '=')) {
            return cookie.substring(name.length + 1);
        }
    }
    return null;
}

function promjenaStanja(vrsta, proizvod_id, ucionica_id, kolicina) {

    const sessionCookie = getCookie("sessionid");
    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Cookie': 'sessionid=' + sessionCookie,
        },
        body: JSON.stringify({
            "data": {
                "proizvod_id": proizvod_id,
                "ucionica_id": ucionica_id,
                "kolicina": kolicina,
                "vrsta": vrsta
            },
            "action": "promjena_stanja"
        })
    };

    var url = "js_upload";
    fetch(url, requestOptions)
        .then(response => response.text())
        .then(data => {
            // location.reload();

            // console.log(data)
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
