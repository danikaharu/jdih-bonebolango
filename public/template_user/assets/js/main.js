/**
 * Template Name: JDIH Bone Bolango
 * Author: Dinas Komunikasi dan Informatika Bone Bolango
 *
 */

// Scroll Navbar
const nav = document.querySelector("nav");
const navLink = document.querySelectorAll(".nav-item .nav-link");
const navBrand = document.getElementsByName(".navbar-brand img");

window.addEventListener("scroll", function () {
  if (window.pageYOffset > 50) {
    nav.classList.add("bg-white");
    for (const link of navLink) {
      link.classList.add("text-dark");
    }
    $(".navbar-brand img").attr(
      "src",
      "/template_user/assets/img/logo/logo-2.svg"
    );
  } else {
    nav.classList.remove("bg-white");
    for (const link of navLink) {
      link.classList.remove("text-dark");
    }
    $(".navbar-brand img").attr(
      "src",
      "/template_user/assets/img/logo/logo.svg"
    );
  }
});
// End Scroll Navbar

AOS.init();
