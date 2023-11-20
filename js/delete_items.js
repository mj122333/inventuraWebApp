function deleteItems() {

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


    var form = document.getElementById('form');
    var checkboxes = form.querySelectorAll('input[type="checkbox"]:checked');
    var ids = [];


    checkboxes.forEach(function (checkbox) {
        ids.push(checkbox.value);

        // console.log(checkbox.value);
    });

    jsonArray = JSON.stringify(ids);
    // console.log(jsonArray)

    const sessionCookie = getCookie("sessionid");
    // console.log(sessionCookie)
    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Cookie': 'sessionid=' + sessionCookie,
        },
        body: jsonArray
    };

    var url = "delete_items";
    fetch(url, requestOptions)
        .then(response => response.text())
        .then(data => {
            location.reload();

            console.log(data)

            const messageOutput = document.getElementById("serverResponse");
            messageOutput.textContent = data.message;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}