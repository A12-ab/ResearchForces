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
    fileInput.value = '';
    var fileName = document.getElementById('fileName');
    fileName.textContent = '';
    fileName.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    // Get all the table rows
    var tableRows = document.querySelectorAll('tr');
  
    for (var i = 0; i < tableRows.length; i++) {
      tableRows[i].addEventListener('click', function(event) {

        var id = this.getAttribute('data-id');
        const col = this.getElementsByTagName('td') ;
        const dt1 = col[0].innerText ;
        var currentRow = event.target.parentNode ;

        fetch('updatereq.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'cellData=' + encodeURIComponent(dt1)
        })
            .then(response => response.json())
            .then(data => {
                currentRow.style.backgroundColor = 'green' ;
            })
            .catch(error => console.error('Error:', error));
      });
    }
  });


