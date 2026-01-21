function ajaxJobSearch() {
  var keyword = document.getElementById("job_keyword").value;
  var location = document.getElementById("job_location").value;
  var min_salary = document.getElementsByName("min_salary")[0].value;
  var max_salary = document.getElementsByName("max_salary")[0].value;

  var job_type = "";
  const checkedRadio = document.querySelector('input[name="job_type"]:checked');
  if (checkedRadio) {
    job_type = checkedRadio.value;
  }

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
      encodeURIComponent(location) +
      "&min_salary=" +
      encodeURIComponent(min_salary) +
      "&max_salary=" +
      encodeURIComponent(max_salary) +
      "&job_type=" +
      encodeURIComponent(job_type),
  );
}
