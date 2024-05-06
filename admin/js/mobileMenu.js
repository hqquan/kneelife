 // Get header element
 const header = document.querySelector('.header');

 // Get mobile button
 const mobileBtn = document.querySelector('.mobile-menu-btn');

 // Get header height
 const headerHeight = header.clientHeight;

 // Open menu when clicked
 mobileBtn.addEventListener('click', function() {
     var isClosed = header.clientHeight === headerHeight;
     if (isClosed) {
         header.style.height = "auto";
     } else {
         header.style.height = null;
     }
 });

 // Get nav item
 const navItems = document.querySelectorAll('.header__navbar-item');
 
 // Close menu when clicked item
 for (const navItem of navItems) {
     navItem.addEventListener('click', function() {
         header.style.height = null;
     })
 }