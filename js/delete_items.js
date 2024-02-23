function deleteItems() {
  var form = document.getElementById("form");
  var checkboxes = form.querySelectorAll('input[type="checkbox"]:checked');
  var ids = [];

  checkboxes.forEach(function (checkbox) {
    ids.push(checkbox.value);

    // console.log(checkbox.value);
  });

  // jsonArray = JSON.stringify(ids);
  // console.log(jsonArray)

  const sessionCookie = getCookie("sessionid");
  // console.log(sessionCookie)
  const requestOptions = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Cookie: "sessionid=" + sessionCookie,
    },
    body: JSON.stringify({
      ids: ids,
      action: "delete_evidencija",
    }),
  };

  var url = "js_upload";
  fetch(url, requestOptions)
    .then((response) => response.text())
    .then((data) => {
      location.reload();

      console.log(data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
