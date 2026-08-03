import "./scss/main.scss";
import Burger from './js/Burger';
import Mailing from './js/Mailing';
import Source from './js/Source';
import Gallery from './js/Gallery';
import Testimonials from './js/Testimonials';
import Calculator from './js/Calculator';
import Diagram from './js/Diagram';
import Wheel from './js/Wheel';
import WhatsApp from './js/WhatsApp';

document.addEventListener('DOMContentLoaded', () => {
  new Burger();
  new Mailing();
  new Gallery();
  new Testimonials();
  new Calculator();
  new Diagram();
  new Wheel();
  new WhatsApp();  

  const source = new Source();  
  source.init();
});




