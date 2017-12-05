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

function loadIndex() {
  loadPage("routes/feed.php"); //Feed is the homepage
  getPage = findGetParameter("page");
  switch(getPage){
    case "feed":
    case "profile":
    case "events":
    case "clubs":
    case "settings":
    case "disclaimer":
    case "maintenance":
    case "createevent":
    case "search":
      loadPage("routes/" + getPage + ".php");
      break;
  }
}

// barışa sor
/*
function search_(keyword){
	alert("I am an alert");
        if (str != null && !str.isEmpty()){
		$_GET["keyword"] = keyword;
		sidebarClick(searh);
	}else
 	    alert("Please Enter a Text");
}

function load(page,id) {
    alert("I am an alert " +id);
    sidebarClick(page);
    $_GET["id"] = id;
}
*/
