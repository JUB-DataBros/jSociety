if (typeof(Storage) !== "undefined") {
    // code for storage
}
else {
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
    //loadPage("essentials/writeLOG?action=AJAX Request to page " + page + " failed");
    //This^ would be abused
    //Cannot keep the log
    //$(".body").html("AJAX Request to page " + page + " failed: <br>");
    //$(".body").append("Data: <br>" + data);
    loadPage("routes/feed.php"); //If 'feed' fails, then infinite loop
  });
}

function changeURL(path) {
  window.history.pushState({},"", path);
}

function sidebarClick(page) {
  loadPage("routes/" + page + ".php");
  changeURL("?page=" + page);
}

var sidebarLoaded = 0;
function loadSidebar() {
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
