const hamburger = document.querySelector('.header .nav-bar .nav-list .hamburger');
const mobile_menu = document.querySelector('.header .nav-bar .nav-list ul');
const menu_item = document.querySelectorAll('.header .nav-bar .nav-list ul li a');
const header = document.querySelector('.header.container');
const inputs = document.querySelectorAll(".input");

header.style.backgroundColor = '#24292F';

function focusFunc() {
	let parent = this.parentNode;
	parent.classList.add("focus");
}

function blurFunc() {
	let parent = this.parentNode;
	if (this.value == "") {
		parent.classList.remove("focus");
}
}

inputs.forEach((input) => {
	input.addEventListener("focus", focusFunc);
	input.addEventListener("blur", blurFunc);
});

hamburger.addEventListener('click', () => {
	hamburger.classList.toggle('active');
	mobile_menu.classList.toggle('active');
});

menu_item.forEach((item) => {
	item.addEventListener('click', () => {
		hamburger.classList.toggle('active');
		mobile_menu.classList.toggle('active');
	});
});

  