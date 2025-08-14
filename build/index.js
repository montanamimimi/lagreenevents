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

/***/ "./src/js/Calculator.js":
/*!******************************!*\
  !*** ./src/js/Calculator.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Calculator)
/* harmony export */ });
class Calculator {
  constructor() {
    this.calculator = document.getElementById('calculator');
    if (!this.calculator) return;
    this.data = JSON.parse(this.calculator.dataset.inputs);
    this.id = 0;
    this.answers = [];
    this.question = this.calculator.querySelector('.calculator__question');
    this.current = document.getElementById('calcCurrent');
    this.total = +this.current.dataset.total - 1;
    this.back = document.getElementById('calcBackBtn');
    this.next = document.getElementById('calcNextBtn');
    this.error = this.calculator.querySelector('.calculator__error');
    this.options = this.calculator.querySelector('.calculator__options');
    this.contacts = this.calculator.querySelector('.calculator__contacts');
    this.back.addEventListener('click', e => {
      if (!e.target.classList.contains('btn--disabled')) {
        this.checkAnswers(false);
        this.changeSlide(-1);
      }
      if (this.options.style.display == "none") {
        this.options.style.display = "block";
        this.contacts.style.display = "none";
      }
    });
    this.next.addEventListener('click', e => {
      if (this.id > this.total) {
        this.sendForm();
        return;
      }
      if (this.checkAnswers(true)) {
        this.changeSlide(1);
      }
    });
  }
  async sendForm() {
    const name = this.calculator.querySelector('input[type="text"]');
    const phone = this.calculator.querySelector('input[type="phone"]');
    let err = false;
    if (!this.isPhoneNumber(phone.value)) {
      if (ajax_object.lang == 'ru_RU') {
        this.error.innerHTML = "Введите корректный номер";
      } else {
        this.error.innerHTML = "Please enter valid phone";
      }
      err = true;
    } else {
      this.error.innerHTML = "";
    }
    if (!err) {
      this.next.classList.add(`calculator__next--loading`);
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: new URLSearchParams({
          action: "send_custom_email",
          name: name.value,
          phone: phone.value,
          answers: this.answers
        })
      });
      if (response.status == 200) {
        this.back.style.display = "none";
        this.next.style.display = "none";
      }
      const result = await response.text();
      this.contacts.innerHTML = result;
    }
  }
  isPhoneNumber(value) {
    return /^(\+?\d{1,3}[- ]?)?\d{10}$/.test(value);
  }
  checkAnswers(check) {
    const inputs = this.calculator.querySelectorAll('input[type="radio"]');
    let checked = false;
    inputs.forEach(input => {
      if (input.checked) {
        checked = true;
        this.saveAnswer(+input.value);
      }
    });
    if (!checked && check) {
      if (ajax_object.lang == 'ru_RU') {
        this.error.innerHTML = 'Выберите хотя бы один вариант';
      } else {
        this.error.innerHTML = 'Please pick one option';
      }
    } else {
      this.error.innerHTML = '';
    }
    return checked;
  }
  saveAnswer(value) {
    if (this.data[this.id]) {
      this.answers[this.id] = this.data[this.id].answers[value].answer_text;
    }
  }
  changeSlide(add) {
    if (add == -1 && this.id == 0) {
      return;
    }
    if (add == 1 && this.id == this.total) {
      this.showForm();
      this.id = this.id + add;
      return;
    }
    this.id = this.id + add;
    this.current.innerHTML = this.id + 1;
    if (this.id == 0) {
      this.back.classList.add('btn--disabled');
    } else {
      this.back.classList.remove('btn--disabled');
    }
    this.changeText();
  }
  showForm() {
    if (ajax_object.lang == 'ru_RU') {
      this.question.innerHTML = 'Как с Вами связаться?';
    } else {
      this.question.innerHTML = 'How to contact with you?';
    }
    this.options.style.display = "none";
    this.contacts.style.display = "flex";
  }
  changeText() {
    this.question.innerHTML = this.data[this.id].question_text;
    this.options.innerHTML = "";
    const answers = this.data[this.id].answers;
    answers.forEach((answer, index) => {
      const optionDiv = document.createElement('div');
      optionDiv.className = 'calculator__option';
      const label = document.createElement('label');
      label.htmlFor = 'calc' + index;
      const input = document.createElement('input');
      input.type = 'radio';
      input.id = 'calc' + index;
      input.name = 'calculator';
      input.value = index;
      if (this.answers[this.id] && answer.answer_text == this.answers[this.id]) {
        input.checked = true;
      }
      const span = document.createElement('span');
      span.className = 'custom-radio';
      const text = document.createTextNode(answer.answer_text);
      label.appendChild(input);
      label.appendChild(span);
      label.appendChild(text);
      optionDiv.appendChild(label);
      this.options.appendChild(optionDiv);
    });
  }
}

/***/ }),

/***/ "./src/js/Diagram.js":
/*!***************************!*\
  !*** ./src/js/Diagram.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Diagram)
/* harmony export */ });
class Arc {
  constructor(ctx, cx, cy, radius, start, end, color, width) {
    this.ctx = ctx;
    this.cx = cx;
    this.cy = cy;
    this.radius = radius;
    this.start = start;
    this.end = end;
    this.color = color;
    this.width = width;
  }
  draw(text) {
    this.ctx.beginPath();
    this.ctx.lineWidth = this.width;
    this.ctx.strokeStyle = this.color;
    this.ctx.arc(this.cx, this.cy, this.radius, this.start, this.end, false);
    this.ctx.stroke();
    this.ctx.closePath();
    this.ctx.fillStyle = "white";
    this.ctx.font = Math.round(this.radius * 0.15) + "px Marcellus";
    const coords = this.getTextCoords();
    this.ctx.fillText(text, coords.x, coords.y);
  }
  getTextCoords() {
    const diff = this.end - this.start;
    const angle = this.start + diff / 2;
    let x = this.cx + this.radius * Math.cos(angle);
    let y = this.cy + this.radius * Math.sin(angle);
    return {
      x: x - Math.round(this.radius * 0.06),
      y: y + Math.round(this.radius * 0.06)
    };
  }
  isClickInside(x, y) {
    let dx = x - this.cx;
    let dy = y - this.cy;
    let distance = Math.sqrt(dx * dx + dy * dy);
    let outerRadius = this.radius + this.width / 2;
    let innerRadius = outerRadius - this.width * 1.5;
    let inRadius = distance >= innerRadius && distance <= outerRadius;
    let angle = Math.atan2(dy, dx);
    if (angle < 0) angle += 2 * Math.PI; // Normalize to [0, 2π]

    let start = this.start; // in radians
    let end = this.end; // in radians

    if (start > 2 * Math.PI) start -= 2 * Math.PI;
    if (end > 2 * Math.PI) end -= 2 * Math.PI;
    let inAngle;
    if (start < end) {
      inAngle = angle >= start && angle <= end;
    } else {
      // Wrap around 2π
      inAngle = angle >= start || angle <= end;
    }
    let insideArc = inRadius && inAngle;
    return insideArc;
  }
}
class Diagram {
  constructor() {
    this.canvas = document.getElementById('canvas');
    if (!this.canvas) return;
    this.id = false;
    this.arcs = [];
    this.size = this.getSize();
    this.canvas.width = this.size;
    this.canvas.height = this.size;
    this.data = this.collectData();
    this.items = document.querySelectorAll('.diagram__item');
    this.absolute = document.querySelector('.diagram__absolute');
    this.absolute.style.height = this.size + 'px';
    this.draw();
    this.canvas.addEventListener('click', e => {
      const rect = this.canvas.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      this.checkArcs(x, y);
    });
    this.canvas.addEventListener("mousemove", e => {
      const rect = canvas.getBoundingClientRect();
      const mouseX = e.clientX - rect.left;
      const mouseY = e.clientY - rect.top;
      this.checkArcs(mouseX, mouseY);
    });
    this.canvas.addEventListener("mouseleave", e => {
      this.id = false;
      let ctx = this.canvas.getContext('2d');
      ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
      this.arcs = [];
      this.draw();
      this.changeItems(false);
    });
    this.items.forEach(item => {
      item.addEventListener('mouseenter', () => {
        this.id = +item.dataset.id;
        let ctx = this.canvas.getContext('2d');
        ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.arcs = [];
        this.draw(this.id);
      });
      item.addEventListener('mouseleave', () => {
        this.id = false;
        let ctx = this.canvas.getContext('2d');
        ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.arcs = [];
        this.draw();
      });
      item.addEventListener('click', () => {
        this.id = +item.dataset.id;
        let ctx = this.canvas.getContext('2d');
        ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.arcs = [];
        this.draw(this.id);
        this.changeItems(this.id);
      });
    });
    window.addEventListener('resize', () => {
      this.size = this.getSize();
      this.canvas.width = this.size;
      this.canvas.height = this.size;
      this.absolute.style.height = this.size + 'px';
      this.id = false;
      this.arcs = [];
      let ctx = this.canvas.getContext('2d');
      ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
      this.draw();
    });
  }
  getSize() {
    if (window.innerWidth > 1300) {
      return 640;
    } else if (window.innerWidth > 1200) {
      return 540;
    } else if (window.innerWidth > 1000) {
      return 440;
    } else {
      return window.innerWidth - 100;
    }
  }
  checkArcs(x, y) {
    let i = false;
    this.arcs.forEach((arc, index) => {
      const inside = arc.isClickInside(x, y);
      if (inside) {
        i = index;
        return;
      }
    });
    if (i !== false && i !== this.id) {
      this.id = i;
      let ctx = this.canvas.getContext('2d');
      ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
      this.arcs = [];
      this.draw(i);
      this.changeItems(i);
    }
  }
  changeItems(i) {
    this.items.forEach(item => {
      if (i === +item.dataset.id) {
        item.classList.add('diagram__item--active');
      } else {
        item.classList.remove('diagram__item--active');
      }
    });
  }
  collectData() {
    const block = document.getElementById('diagramData');
    const data = JSON.parse(block.dataset.items);
    let arr = [];
    let summ = 0;
    let ps = [];
    data.forEach(item => {
      arr.push((+item.percent_from + +item.percent_to) / 2);
    });
    arr.forEach(item => {
      summ += item;
    });
    arr.forEach(item => {
      const num = item / summ;
      ps.push(Math.round(num * 100) / 100);
    });
    return ps;
  }
  draw(i = false) {
    const color = 'rgba(128, 141, 84, ';
    const gap = Math.PI / 20;
    const counter = this.data.length;
    let availableArc = Math.PI * 2 - gap * counter;
    let ctx = this.canvas.getContext('2d');
    let startAngle = Math.PI + 1;
    let endAngle = 0;
    let width = this.size / 8;
    let radius = (this.size - width) / 2;
    let cx = this.size / 2;
    let cy = this.size / 2;
    let colorChanger = 0.9;
    let currentColor = color + '1)';
    this.data.forEach((item, index) => {
      endAngle = startAngle + item * availableArc;
      if (i !== false && i === index) {
        const arc = new Arc(ctx, cx, cy, radius - radius * 0.15, startAngle, endAngle, currentColor, width);
        this.arcs.push(arc);
        arc.draw(index + 1);
      } else {
        const arc = new Arc(ctx, cx, cy, radius, startAngle, endAngle, currentColor, width);
        this.arcs.push(arc);
        arc.draw(index + 1);
      }
      currentColor = color + colorChanger + ')';
      colorChanger = colorChanger - 0.1;
      startAngle = endAngle + gap;
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
            message: formData.get("message"),
            feedback_email: ajax_object.feedback_email
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
        if (ajax_object.lang == 'ru_RU') {
          errorText += "Введите корректный номер. ";
        } else {
          errorText += "Please enter phone. ";
        }
      }
    }
    if (data.has('message')) {
      if (!data.get('message')) {
        error = true;
        if (ajax_object.lang == 'ru_RU') {
          errorText += "Напишите Ваш вопрос. ";
        } else {
          errorText += "Please enter your question. ";
        }
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

/***/ "./src/js/Testimonials.js":
/*!********************************!*\
  !*** ./src/js/Testimonials.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Gallery)
/* harmony export */ });
class Gallery {
  constructor() {
    this.gallery = document.getElementById('testimonials');
    if (!this.gallery) return;
    this.slider = document.getElementById('testimonialSlider');
    this.arrows = this.gallery.querySelectorAll('.testimonials__arrow');
    this.leftArrows = this.gallery.querySelectorAll('.testimonials__arrow--left');
    this.rightArrows = this.gallery.querySelectorAll('.testimonials__arrow--right');
    this.currentIndex = 0;
    this.startX = false;
    this.slider.addEventListener('touchstart', e => {
      this.startX = this.getClientX(e);
    });
    this.slider.addEventListener('touchend', e => {
      this.onEnd(e);
    });
    if (window.innerWidth > 1300) {
      this.visibleItems = 3;
    } else {
      this.visibleItems = 1;
    }
    this.totalItems = this.slider.children.length;
    this.dots = this.gallery.querySelectorAll('.testimonials__dot');
    this.arrows.forEach(arrow => {
      arrow.addEventListener('click', e => {
        this.checkButton(e.target);
      });
    });
    this.dots.forEach(dot => {
      dot.addEventListener('click', e => {
        if (!dot.classList.contains('testimonials__dot--active')) {
          this.checkButton(e.target);
        }
      });
    });
    window.addEventListener('resize', () => {
      this.resetData();
    });
  }
  getClientX(e) {
    if (e.touches && e.touches[0]) return e.touches[0].clientX;
    if (e.changedTouches && e.changedTouches[0]) return e.changedTouches[0].clientX;
    return e.clientX;
  }
  onEnd(e) {
    const currentX = this.getClientX(e);
    if (this.startX - currentX < -60) {
      if (this.currentIndex == 0) {
        this.currentIndex = this.totalItems - 1;
      } else {
        this.currentIndex--;
      }
      this.updateSlider(-this.currentIndex * 100);
    }
    if (this.startX - currentX > 60) {
      if (this.currentIndex == this.totalItems - 1) {
        this.currentIndex = 0;
      } else {
        this.currentIndex++;
      }
      this.updateSlider(-this.currentIndex * 100);
    }
  }
  resetData() {
    this.currentIndex = 0;
    this.slider.style.transform = "unset";
    this.disableButtons(this.leftArrows);
    this.enableButtons(this.rightArrows);
    if (window.innerWidth > 1300) {
      this.visibleItems = 3;
    } else {
      this.visibleItems = 1;
    }
    this.dots.forEach(dot => {
      if (dot.dataset.id == 0) {
        dot.classList.add('testimonials__dot--active');
      } else {
        dot.classList.remove('testimonials__dot--active');
      }
    });
  }
  enableButtons(buttons) {
    buttons.forEach(button => {
      button.classList.remove('testimonials__arrow--inactive');
    });
  }
  disableButtons(buttons) {
    buttons.forEach(button => {
      button.classList.add('testimonials__arrow--inactive');
    });
  }
  checkButton(target) {
    if (target.classList.contains('testimonials__arrow--right')) {
      if (this.currentIndex < this.totalItems - this.visibleItems) {
        this.currentIndex++;
        this.updateSlider();
        this.enableButtons(this.leftArrows);
        if (this.currentIndex == this.totalItems - this.visibleItems) {
          this.disableButtons(this.rightArrows);
        }
      }
    }
    if (target.classList.contains('testimonials__arrow--left')) {
      if (this.currentIndex > 0) {
        this.enableButtons(this.rightArrows);
        this.currentIndex--;
        this.updateSlider();
        if (this.currentIndex == 0) {
          this.disableButtons(this.leftArrows);
        }
      }
    }
    if (target.classList.contains('testimonials__dot')) {
      const id = +target.dataset.id;
      this.currentIndex = id;
      this.updateSlider(-id * 100);
      if (id == 0) {
        this.disableButtons(this.leftArrows);
        this.enableButtons(this.rightArrows);
      } else if (id == this.totalItems - 1) {
        this.disableButtons(this.rightArrows);
        this.enableButtons(this.leftArrows);
      } else {
        this.enableButtons(this.rightArrows);
        this.enableButtons(this.leftArrows);
      }
    }
  }
  updateSlider(shift = false) {
    if (!shift) {
      shift = -(this.currentIndex * (100 / this.visibleItems));
    }
    this.slider.style.transform = `translateX(${shift}%)`;
    const id = -shift / 100;
    this.dots.forEach(dot => {
      if (dot.dataset.id == id) {
        dot.classList.add('testimonials__dot--active');
      } else {
        dot.classList.remove('testimonials__dot--active');
      }
    });
  }
}

/***/ }),

/***/ "./src/js/Wheel.js":
/*!*************************!*\
  !*** ./src/js/Wheel.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Wheel)
/* harmony export */ });
class Arc {
  constructor(ctx, cx, radius, start, end, color, width) {
    this.ctx = ctx;
    this.cx = cx;
    this.cy = cx;
    this.radius = radius;
    this.start = start;
    this.end = end;
    this.color = color;
    this.width = width;
  }
  draw(text) {
    this.ctx.beginPath();
    this.ctx.lineWidth = this.width;
    this.ctx.strokeStyle = this.color;
    this.ctx.arc(this.cx, this.cy, this.radius, this.start, this.end, false);
    this.ctx.stroke();
    this.ctx.closePath();
    this.drawText(text);
  }
  drawLine() {
    const angle = this.end - Math.PI * 0.003;
    //  console.log(this.end);
    const smallRadius = this.radius * 0.3;
    console.log(this.radius);
    let sx = this.cx + smallRadius * Math.cos(angle);
    let sy = this.cy + smallRadius * Math.sin(angle);
    this.ctx.save();
    this.ctx.translate(sx, sy);
    this.ctx.rotate(angle);
    this.ctx.lineWidth = 5;
    this.ctx.strokeStyle = "white";
    this.ctx.beginPath();
    this.ctx.moveTo(0, 0);
    this.ctx.lineTo(this.radius + this.radius * 0.4, 0);
    this.ctx.stroke();
    this.ctx.restore();
  }
  drawText(text) {
    const diff = this.end - this.start;
    const angle = this.start + diff / 2;
    let x = this.cx + this.radius * 0.5 * Math.cos(angle);
    let y = this.cy + this.radius * 0.5 * Math.sin(angle);
    this.ctx.fillStyle = "white";
    this.ctx.font = Math.round(this.radius * 0.1) + "px Inter";
    this.ctx.save();
    this.ctx.translate(x, y);
    this.ctx.rotate(angle);
    this.ctx.fillText(text, 0, 0);
    this.ctx.restore();
    return {
      x: x - Math.round(this.radius * 0.06),
      y: y + Math.round(this.radius * 0.06)
    };
  }
}
class Wheel {
  constructor() {
    this.wheelModal = document.getElementById('wheelModal');
    if (!this.wheelModal) return;
    this.wheel = document.getElementById('wheel');
    this.form = document.getElementById('wheelForm');
    this.close = this.wheelModal.querySelectorAll('.close__item');
    this.size = this.getSize();
    this.data = this.collectData();
    this.ctx = this.wheel.getContext('2d');
    this.arcs = [];
    this.form.addEventListener('submit', e => {
      e.preventDefault();
      console.log('test');
    });
    this.close.forEach(item => {
      item.addEventListener('click', () => {
        this.wheelModal.classList.remove('wheel--active');
      });
    });
    this.draw();
  }
  collectData() {
    const block = document.getElementById('wheelData');
    const data = JSON.parse(block.dataset.items);
    return data;
  }
  getSize() {
    const rect = this.wheel.getBoundingClientRect();
    this.wheel.width = rect.width;
    this.wheel.height = rect.width;
    return rect.width;
  }
  draw() {
    this.drawWhiteCircle();
    const radius = Math.round(this.size / 2);
    const width = 0.8 * radius;
    const newRadius = radius - width / 2 - 6;
    const counter = this.data.length;
    const arcAngle = 2 * Math.PI / counter;
    let startAngle = 0;
    let endAngle = startAngle + arcAngle;
    let currentColor = "#808D54";
    this.data.forEach((item, index) => {
      const arc = new Arc(this.ctx, radius, newRadius, startAngle, endAngle, currentColor, width);
      this.arcs.push(arc);
      arc.draw(item.text);
      startAngle = endAngle;
      endAngle = startAngle + arcAngle;
      if (index % 2 === 0) {
        currentColor = "#99A173";
      } else {
        currentColor = "#808D54";
      }
    });
    this.arcs.forEach(arc => {
      arc.drawLine();
    });
    this.drawArrow();
  }
  drawArrow() {
    const center = Math.round(this.size / 2);
    const startX = 0 + center + center * 0.16;
    const startY = 0 + center - 20;
    const midX = 20 + center + center * 0.16;
    const midY = center;
    const endY = 20 + center;
    const radius = 10;
    this.ctx.fillStyle = "white";
    this.ctx.beginPath();
    this.ctx.moveTo(startX, startY);
    this.ctx.lineTo(midX - radius, startY + (midY - startY) / 2); // approach curve start
    this.ctx.arcTo(midX, midY, midX - radius, endY - (endY - midY) / 2, radius);
    this.ctx.lineTo(startX, endY);
    this.ctx.closePath();
    this.ctx.fill();
  }
  drawWhiteCircle() {
    const radius = Math.round(this.size / 2);
    const width = radius - radius * 0.12;
    const newRadius = radius - width / 2;
    this.ctx.beginPath();
    this.ctx.lineWidth = width;
    this.ctx.strokeStyle = "white";
    this.ctx.arc(radius, radius, newRadius, 0, 2 * Math.PI);
    this.ctx.stroke();
    ;
    this.ctx.closePath();
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
/* harmony import */ var _js_Testimonials__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./js/Testimonials */ "./src/js/Testimonials.js");
/* harmony import */ var _js_Calculator__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./js/Calculator */ "./src/js/Calculator.js");
/* harmony import */ var _js_Diagram__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./js/Diagram */ "./src/js/Diagram.js");
/* harmony import */ var _js_Wheel__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./js/Wheel */ "./src/js/Wheel.js");









document.addEventListener('DOMContentLoaded', () => {
  new _js_Burger__WEBPACK_IMPORTED_MODULE_1__["default"]();
  new _js_Logos__WEBPACK_IMPORTED_MODULE_2__["default"]();
  new _js_Mailing__WEBPACK_IMPORTED_MODULE_3__["default"]();
  new _js_Gallery__WEBPACK_IMPORTED_MODULE_4__["default"]();
  new _js_Testimonials__WEBPACK_IMPORTED_MODULE_5__["default"]();
  new _js_Calculator__WEBPACK_IMPORTED_MODULE_6__["default"]();
  new _js_Diagram__WEBPACK_IMPORTED_MODULE_7__["default"]();
  new _js_Wheel__WEBPACK_IMPORTED_MODULE_8__["default"]();
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map