document.addEventListener("DOMContentLoaded", function(event) { 

	const button = document.querySelector('#scroll-top');

	button.addEventListener('click', function(){
		window.scrollTo(0, 0);
	});

	window.addEventListener('scroll', function(){
		if(window.scrollY == 0){
			button.style.opacity = "0";
		} else {
			button.style.opacity = "1";
		}
	});
  
});

// Change header background color
let className = "inverted";
let scrollTrigger = 500;

window.onscroll = function() {
  // We add pageYOffset for compatibility with IE.
  if (window.scrollY >= scrollTrigger || window.pageYOffset >= scrollTrigger) {
    document.getElementsByClassName("site-header")[0].classList.add(className);
  } else {
    document.getElementsByClassName("site-header")[0].classList.remove(className);
  }
};