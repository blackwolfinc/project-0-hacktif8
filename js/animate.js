document.addEventListener("DOMContentLoaded", function() {
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    const loginRegisterToggle = document.getElementById('login-register-toggle');
    const loginRegisterDropdown = document.getElementById('login-register-dropdown');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const switchToRegister = document.getElementById('switch-to-register');
    const switchToLogin = document.getElementById('switch-to-login');

    // Toggle nav menu for small screens
    navToggle.addEventListener('click', function() {
      navMenu.classList.toggle('hidden');
    });

    // Toggle login/register dropdown
    loginRegisterToggle.addEventListener('click', function() {
      loginRegisterDropdown.classList.toggle('hidden');
    });

    // Switch to register form
    switchToRegister.addEventListener('click', function() {
      loginForm.classList.add('hidden');
      registerForm.classList.remove('hidden');
    });

    // Switch to login form
    switchToLogin.addEventListener('click', function() {
      registerForm.classList.add('hidden');
      loginForm.classList.remove('hidden');
    });

    // Optional: Handle form submissions
    loginForm.addEventListener('submit', function(event) {
      event.preventDefault();
      // Handle login form submission
      console.log('Logging in...');
    });

    registerForm.addEventListener('submit', function(event) {
      event.preventDefault();
      // Handle register form submission
      console.log('Registering...');
    });
  });

  document.getElementById('nav-toggle').addEventListener('click', function() {
    document.getElementById('nav-menu').classList.toggle('hidden');
});



$(document).ready(function(){
    $('.slick-slider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        autoplay: true, // Auto scroll
        autoplaySpeed: 2000, // Auto scroll speed in milliseconds
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});

 // Truncate title and description
 $('.slick-slider .max-w-sm h3').each(function() {
    var max_length = 20;
    var text = $(this).text();
    if (text.length > max_length) {
        $(this).text(text.substring(0, max_length) + '...');
    }
});

$('.slick-slider .max-w-sm .description').each(function() {
    var max_length = 100;
    var text = $(this).text();
    if (text.length > max_length) {
        $(this).text(text.substring(0, max_length) + '...');
    }
});


function calculateCost() {
  let totalCost = 0;
  
  // Get website type cost
  const websiteType = document.getElementById('websiteType').value;
  const pages = document.getElementById('pages').value;
  if (!pages || pages < 1) {
      alert("Please enter a valid number of pages.");
      return;
  }
  if (websiteType && pages) {
      const costPerPage = websiteType === 'dynamic' ? 400 : 100;
      totalCost += costPerPage * pages;
  }
  
  // Get domain registration cost
  const domain = document.getElementById('domain').value;
  if (domain === 'yes') {
      totalCost += 20;
  }

  // Get framework cost
  const framework = document.getElementById('framework').value;
  if (framework) {
      const frameworkCost = parseInt(framework === 'react' ? 300 : framework === 'angular' ? 350 : 250);
      totalCost += frameworkCost;
  }
  
  // Get deadline cost
  const deadline = document.getElementById('deadline').value;
  if (!deadline || deadline < 1) {
      alert("Please enter a valid deadline in days.");
      return;
  }
  if (deadline) {
      const weeks = Math.ceil(deadline / 7);
      totalCost += weeks * 100;
  }
  
  // Get additional features cost
  const additionalFeatures = document.querySelectorAll('input[type="checkbox"]:checked');
  additionalFeatures.forEach(feature => {
      totalCost += parseInt(feature.value);
  });
  
  // Display total cost
  document.getElementById('totalCost').innerText = totalCost;
}