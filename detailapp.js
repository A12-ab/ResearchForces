function GenerateImg() {
    fetch('fetch_img.php')
    .then(response => response.text())
    .then(data => {
        const listbody = document.getElementById('imglist');
        listbody.innerHTML = data;
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Get all the table rows
    var listRows = document.querySelectorAll('li');
  
    // Add click event listener to each row
    for (var i = 0; i < listRows.length; i++) {
      listRows[i].addEventListener('click', function() {
        // Get the data-id attribute of the clicked row
        var id = this.getAttribute('data-id');
        // Navigate to the specified page with the ID as a query parameter
        window.location.href = 'annoteimg.php?img=' + encodeURIComponent(id);
      });
    }
  });