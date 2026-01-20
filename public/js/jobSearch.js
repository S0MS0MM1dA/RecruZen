function ajaxJobSearch() {
  var keyword = document.getElementById("job_keyword").value;
  var location = document.getElementById("job_location").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("job-listings").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "app/controllers/JobSearchHandler.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(
    "keyword=" +
      encodeURIComponent(keyword) +
      "&location=" +
      encodeURIComponent(location),
  );
}
