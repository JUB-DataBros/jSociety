if (typeof(Storage) === "undefined") {
    alert("Your web browser is not supported. This website will not function on your browser.");
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

function loadPage(page, param={}) {
  $.ajax({
    method: "GET",
    url: page,
    data: param
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

//Also loads the log-out button on the header
function loadSidebar() {
  if ($('div.sidebar').length == 0){
    //Load the sidebar
    $.ajax({
      method: "POST",
      url: "partials/sidebar.php",
      data: {}
    })

    .done(function(data) {
      $(".header").after(data);
      sidebarLoaded = 1;
    })

    .fail(function(data) {
      alert("Sidebar could not be loaded. Please refresh your page");
    });
  }
  if ($('img#logout').length == 0){
    //Load the log-out button
    //It needs a hyperlink so to align with the logo due to CSS code
    var logoutbutton = "<img id='logout' src='images/logout.png' alt='Log out?' onClick=\"loadPage('essentials/logout.php')\">";
    $(".header").append(logoutbutton);
  }
}
