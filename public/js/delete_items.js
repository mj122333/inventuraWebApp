function deleteItems() {


    var form = document.getElementById('form');
    var checkboxes = form.querySelectorAll('input[type="checkbox"]:checked');
    var ids = [];


    checkboxes.forEach(function (checkbox) {
        ids.push(checkbox.value);

        // console.log(checkbox.value);
    });

    jsonArray = JSON.stringify(ids);
    console.log(jsonArray)

    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: jsonArray
    };

    var url = "public/delete_items.php";
    fetch(url, requestOptions)
        .then(response => response.json())
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