if (typeof(Storage) !== "undefined") {
    // code for storage
} else {
    alert("Your web browser is not supported");
}

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
          tmp = item.split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}

function loadPage(page) {
  $.ajax({
    method: "POST",
    url: page,
    data: {}
  })

  .done(function(data) {
    $(".body").html(data);
  })

  .fail(function(data) {
    $(".body").html("AJAX Request to page " + page + " failed: <br>");
    $(".body").append("Data: <br>" + data);
  });
}

function changeURL(path) {
  window.history.pushState({},"", path);
}

function sidebarClick(page) {
  loadPage("routes/" + page + ".php");
  changeURL("?page=" + page);
}

function getSessionId(){
    var jsId = document.cookie.match(/JSESSIONID=[^;]+/);
    if(jsId != null) {
        if (jsId instanceof Array)
            jsId = jsId[0].substring(11);
        else
            jsId = jsId.substring(11);
    }
    return jsId;
}

function successfulLogin() {
  loadPage("routes/feed.php"); //Feed is the homepage
  getPage = findGetParameter("page");
  switch(getPage){
    case "feed":
    case "profile":
    case "events":
    case "clubs":
    case "settings":
    case "disclaimer":
      loadPage("routes/" + getPage + ".php");
      break;
  }
}

function loginAttempt() {
  var challenge = document.getElementById("crypto_challenge");
  var sessionid = getSessionId();
  var username = document.getElementById("login_username");
  var salt = CryptoJS.SHA256("DataBros-jSociety");
  var salted_password =
    CryptoJS.SHA256(username + salt + document.getElementById("login_password"));

  sessionStorage.crypto_counter = 0;
  sessionStorage.username = username;
  sessionStorage.crypto_key = CryptoJS.SHA256(
    username + salted_password + sessionid + challenge + "0";
  )

}

function forgotpw() {
  alert("Seriously?");
}
