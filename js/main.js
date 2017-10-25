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

function loadIndex() {
  alert("Script Runs!");
  loadPage("routes/disclaimer.php"); //this is the home content now
  getPage = findGetParameter("page");
  //alert(getPage);
  switch(getPage){
    case "feed":
    case "profile":
    case "events":
    case "clubs":
    case "settings":
    case "disclaimer"
      loadPage("routes/" + getPage + ".php");
      break;
  }
}
