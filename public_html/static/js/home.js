"use strict";

const welcomeList = [
  "From a link on my website",
  "From linkedin, Twitter or other social media",
  "From a link on a project I have made, contributed or otherwise have been involved in",
  "From a random search on the internet",
  "From a link on a forum or other community",
  "From a random qr code you found somewhere",
  "From a link on a resume or CV",
  "From a link on a business card",
  "From a link on a sticker",
  "By typing in the URL directly",
  "By by accident"
];

const welcomeListSpan = document.querySelector("#welcome-list-display > span");

function wait(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

function typeText(element, text, delay) {
  let index = 0;

  return new Promise(resolve => {
    function addCharacter() {
      if (index < text.length) {
        element.textContent += text.charAt(index++);
        setTimeout(addCharacter, delay);
      } else {
        resolve();
      }
    }
    addCharacter();
  });
}

function deleteText(element, delay) {
  return new Promise(resolve => {
    function removeCharacter() {
      if (element.textContent.length > 0) {
        element.textContent =
          element.textContent.slice(0, -1);
        setTimeout(removeCharacter, delay);
      } else {
        resolve();
      }
    }
    removeCharacter();
  });
}



(async () => {
  await wait(500);
  while (true) {
    for (const item of welcomeList) {
      await typeText(welcomeListSpan, item, 50);
      await wait(1000);
      await deleteText(welcomeListSpan, 30);
      await wait(300);
    }
  }
})();