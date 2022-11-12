// "use strict";

//   document.querySelector("#showMenu").addEventListener("click", function (event) {
//     document.querySelector("#mobileNav").classList.remove("hidden");
//   });

//   document.querySelector("#hideMenu").addEventListener("click", function (event) {
//     document.querySelector("#mobileNav").classList.add("hidden");
//   });

//   document.querySelectorAll("[toggleElement]").forEach(function (toggle) {
//     toggle.addEventListener("click", function (event) {
//       console.log(toggle);
//       var answerElement = toggle.querySelector("[answer]");
//       var caretElement = toggle.querySelector("img");
//       console.log(answerElement);
//       if (answerElement.classList.contains("hidden")) {
//         answerElement.classList.remove("hidden");
//         caretElement.classList.add("rotate-90");
//       } else {
//         answerElement.classList.add("hidden");
//         caretElement.classList.remove("rotate-90");
//       }
//     });
//   });