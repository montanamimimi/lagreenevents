/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/Burger.js":
/*!**************************!*\
  !*** ./src/js/Burger.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Burger)
/* harmony export */ });
class Burger {
  constructor() {
    this.burger = document.getElementById('hamburger');
    if (!this.burger) return;
    this.burger.addEventListener("click", event => {
      this.burger.classList.toggle("is-active");
      document.querySelector('.mobile-nav').classList.toggle("mobile-nav--active");
    });
  }
}

/***/ }),

/***/ "./src/js/Gallery.js":
/*!***************************!*\
  !*** ./src/js/Gallery.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Gallery)
/* harmony export */ });
class Gallery {
  constructor() {
    this.gallery = document.getElementById('gallery');
    if (!this.gallery) return;
    this.counter = +this.gallery.dataset.counter;
    this.urls = this.getUrlArray();
    this.arrows = this.gallery.querySelectorAll('.gallery__arrow');
    this.images = this.gallery.querySelectorAll('.gallery__image');
    this.dots = this.gallery.querySelectorAll('.gallery__dot');
    this.arrows.forEach(arrow => {
      arrow.addEventListener('click', e => {
        this.changeImages(e.target);
      });
    });
    this.dots.forEach(dot => {
      dot.addEventListener('click', e => {
        if (!dot.classList.contains('gallery__dot--active')) {
          this.changeImages(e.target);
        }
      });
    });
  }
  getUrlArray() {
    const images = {};
    const blocks = document.querySelectorAll('.gallery-data');
    blocks.forEach(block => {
      images[block.dataset.key] = block.dataset.url;
    });
    return images;
  }
  changeImages(target) {
    const ids = this.getNewIds(target);
    this.images.forEach((image, index) => {
      if (!image.classList.contains('gallery__image--small')) {
        image.classList.add('gallery__image--active');
        setTimeout(() => {
          image.style.backgroundImage = "url('" + this.urls[ids[index]] + "')";
          image.classList.remove('gallery__image--active');
        }, 500);
      } else {
        image.style.backgroundImage = "url('" + this.urls[ids[index]] + "')";
      }
      image.dataset.id = ids[index];
    });
    const dotId = ids[1];
    this.dots.forEach(dot => {
      if (dot.dataset.id == dotId) {
        dot.classList.add('gallery__dot--active');
      } else {
        dot.classList.remove('gallery__dot--active');
      }
    });
  }
  getNewIds(target) {
    let ids = [];
    this.images.forEach(image => {
      const id = +image.dataset.id;
      let newId = id;
      if (target.classList.contains('gallery__arrow--right')) {
        if (id == this.counter - 1) {
          newId = 0;
        } else {
          newId = id + 1;
        }
      }
      if (target.classList.contains('gallery__arrow--left')) {
        if (id == 0) {
          newId = this.counter - 1;
        } else {
          newId = id - 1;
        }
      }
      ids.push(newId);
    });
    if (target.classList.contains('gallery__dot')) {
      const id = +target.dataset.id;
      if (id == 0) {
        ids = [this.counter - 1, 0, 1];
      } else if (id == this.counter - 1) {
        ids = [this.counter - 2, id, 0];
      } else {
        ids = [id - 1, id, id + 1];
      }
    }
    return ids;
  }
}

/***/ }),

/***/ "./src/js/Logos.js":
/*!*************************!*\
  !*** ./src/js/Logos.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Logos)
/* harmony export */ });
class Logos {
  constructor() {
    this.container = document.getElementById('scrollContainer');
    if (!this.container) return;
    this.inner = document.getElementById('scrollInner');
    this.container.addEventListener('mouseenter', this.scroll.bind(this));
    this.container.addEventListener('mouseleave', this.stop.bind(this));
  }
  scroll() {
    const screenWidth = window.innerWidth;
    let targetWidth = 1780;
    if (screenWidth < 1000) {
      targetWidth = 1400;
    }
    const scrollAmount = screenWidth - targetWidth;
    if (scrollAmount < 0) {
      const distance = Math.abs(scrollAmount);
      const durationSeconds = distance / 100;
      this.inner.style.transition = `transform ${durationSeconds}s linear`;
      this.inner.style.transform = `translateX(${scrollAmount}px)`;
    }
  }
  stop() {
    this.inner.style.transition = `transform 0.5s ease-out`;
    this.inner.style.transform = `translateX(0)`;
  }
}

/***/ }),

/***/ "./src/js/Mailing.js":
/*!***************************!*\
  !*** ./src/js/Mailing.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Mailing)
/* harmony export */ });
class Mailing {
  constructor() {
    this.addListeners();
  }
  addListeners() {
    const footerForm = document.getElementById('contact-form');
    const askForm = document.getElementById('ask__form');
    const contactsForm = document.getElementById('contacts-form');
    if (footerForm) {
      this.listenToForm(footerForm, 'contact-form__button', 'form-result');
    }
    if (askForm) {
      this.listenToForm(askForm, 'ask__button', 'ask__result');
    }
    if (contactsForm) {
      this.listenToForm(contactsForm, 'contacts-form__button', 'contacts-form__result');
    }
  }
  listenToForm(form, btnClass, resultClass) {
    form.addEventListener('submit', async e => {
      e.preventDefault();
      const formData = new FormData(form);
      const valid = this.validateForm(formData, resultClass);
      const btn = form.querySelector(`.${btnClass}`);
      if (valid) {
        btn.classList.add(`${btnClass}--loading`);
        const response = await fetch(ajax_object.ajax_url, {
          method: "POST",
          body: new URLSearchParams({
            action: "send_custom_email",
            name: formData.get("name"),
            phone: formData.get("phone"),
            email: formData.get("email"),
            message: formData.get("message")
          })
        });
        if (response.status == 200) {
          this.clearForm(form);
        }
        const result = await response.text();
        document.querySelector(`.${resultClass}`).innerHTML = result;
        btn.classList.remove(`${btnClass}--loading`);
      }
    });
  }
  validateForm(data, resultClass) {
    let error = false;
    let errorText = "";
    if (data.has('phone')) {
      if (!this.isPhoneNumber(data.get('phone'))) {
        error = true;
        errorText += "Please enter phone. ";
      }
    }
    if (data.has('message')) {
      if (!data.get('message')) {
        error = true;
        errorText += "Please enter your question. ";
      }
    }
    const errorContainer = document.querySelector(`.${resultClass}`);
    if (error) {
      errorContainer.innerHTML = errorText;
      errorContainer.classList.add(`${resultClass}--error`);
    } else {
      errorContainer.innerHTML = "";
      errorContainer.classList.remove(`${resultClass}--error`);
    }
    return !error;
  }
  clearForm(form) {
    const inputs = form.querySelectorAll('input');
    const areas = form.querySelectorAll('textarea');
    inputs.forEach(input => {
      input.value = "";
    });
    areas.forEach(area => {
      area.value = "";
    });
  }
  isPhoneNumber(value) {
    return /^(\+?\d{1,3}[- ]?)?\d{10}$/.test(value);
  }
}

/***/ }),

/***/ "./src/scss/main.scss":
/*!****************************!*\
  !*** ./src/scss/main.scss ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_main_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/main.scss */ "./src/scss/main.scss");
/* harmony import */ var _js_Burger__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/Burger */ "./src/js/Burger.js");
/* harmony import */ var _js_Logos__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/Logos */ "./src/js/Logos.js");
/* harmony import */ var _js_Mailing__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./js/Mailing */ "./src/js/Mailing.js");
/* harmony import */ var _js_Gallery__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./js/Gallery */ "./src/js/Gallery.js");





document.addEventListener('DOMContentLoaded', () => {
  new _js_Burger__WEBPACK_IMPORTED_MODULE_1__["default"]();
  new _js_Logos__WEBPACK_IMPORTED_MODULE_2__["default"]();
  new _js_Mailing__WEBPACK_IMPORTED_MODULE_3__["default"]();
  new _js_Gallery__WEBPACK_IMPORTED_MODULE_4__["default"]();
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map