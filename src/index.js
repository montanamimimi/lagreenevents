import "./scss/main.scss";
import Burger from './js/Burger';
import Logos from './js/Logos';
import Mailing from './js/Mailing';
import Gallery from './js/Gallery';
import Testimonials from './js/Testimonials';
import Calculator from './js/Calculator';

document.addEventListener('DOMContentLoaded', () => {
  new Burger();
  new Logos();
  new Mailing();
  new Gallery();
  new Testimonials();
  new Calculator();
});