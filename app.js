function scrollToBottom() {
  const scrollToOptions = {
      top: document.documentElement.scrollHeight,
      behavior: 'smooth'
  };

  // Custom timing function to make the scroll animation slower
  const timingFunction = timeFraction => {
      return Math.pow(timeFraction, 2); // Adjust the exponent to control the speed
  };

  // Calculate the animation duration based on the desired speed
  const duration = 1000; // Adjust the duration to control the speed

  // Perform the scroll animation with the custom timing function
  const start = performance.now();
  const animateScroll = currentTime => {
      const elapsed = currentTime - start;
      const progress = elapsed / duration;
      const easeProgress = timingFunction(progress);

      if (progress < 1) {
          const newY = easeProgress * scrollToOptions.top;
          window.scrollTo({ top: newY });
          requestAnimationFrame(animateScroll);
      } else {
          window.scrollTo(scrollToOptions);
      }
  };

  requestAnimationFrame(animateScroll);
}

function scrollToContent(targetId) {
  const targetElement = document.getElementById(targetId);
  if (targetElement) {
      const scrollToOptions = {
          top: targetElement.offsetTop,
          behavior: 'smooth'
      };

      // Custom timing function and duration as per your preference
      const timingFunction = timeFraction => {
          return Math.pow(timeFraction, 2);
      };
      const duration = 1000;

      const start = performance.now();
      const animateScroll = currentTime => {
          const elapsed = currentTime - start;
          const progress = elapsed / duration;
          const easeProgress = timingFunction(progress);

          if (progress < 1) {
              const newY = easeProgress * scrollToOptions.top;
              window.scrollTo({ top: newY });
              requestAnimationFrame(animateScroll);
          } else {
              window.scrollTo(scrollToOptions);
          }
      };

      requestAnimationFrame(animateScroll);
  }
}

function showUpload() {
    document.getElementById('uploadForm').classList.remove('hidden');
}

function showFileName() {
    var fileInput = document.getElementById('fileInput');
    var fileName = document.getElementById('fileName');
    fileName.textContent = fileInput.files[0].name;
    fileName.classList.remove('hidden');
}

function removeFile() {
    var fileInput = document.getElementById('fileInput');
    fetch('seelist.php') 
        .then(response => response.json())
}

function viewList() {
    var fileInput = document.getElementById('seelist');
    fetch
    var fileName = document.getElementById('fileName');
    fileName.textContent = '';
    fileName.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    // Get all the table rows
    var tableRows = document.querySelectorAll('tr');
  
    // Add click event listener to each row
    for (var i = 0; i < tableRows.length; i++) {
      tableRows[i].addEventListener('click', function() {
        // Get the data-id attribute of the clicked row
        var id = this.getAttribute('data-id');
        // Navigate to the specified page with the ID as a query parameter
        window.location.href = 'details.php?id=' + encodeURIComponent(id);
      });
    }
  });


