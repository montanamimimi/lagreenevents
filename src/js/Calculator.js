import { loadCookie } from './utils/gtm_cookie';

export default class Calculator {
    constructor() {
        
        this.calculator = document.getElementById('calculator');
        if (!this.calculator) return;
        this.data = JSON.parse(this.calculator.dataset.inputs);
        this.datepicker = false;

        this.dateInput = document.getElementById('calculatorDate');
       
        this.id = 0;        
        this.answers = [];
        this.question = this.calculator.querySelector('.calculator__question');
        this.current = document.getElementById('calcCurrent');
        this.total = +this.current.dataset.total - 1;
        this.back = document.getElementById('calcBackBtn');
        this.next = document.getElementById('calcNextBtn');    
        this.error = this.calculator.querySelector('.calculator__error');
        this.options = this.calculator.querySelector('.calculator__options');
        this.dateContainer = this.calculator.querySelector('.calculator__date_container');
        this.contacts = this.calculator.querySelector('.calculator__contacts');

        this.back.addEventListener('click', (e) => {
            if (!e.target.classList.contains('btn--disabled')) {
                this.checkAnswers(false);
                this.changeSlide(-1);        
                this.error.innerHTML = "";        
            }

            if (this.options.style.display == "none") {
                this.options.style.display = "block";
                this.contacts.style.display = "none";
            }                    
       
        })

        if (this.dateInput) {
            this.dateInput.addEventListener('change', () => {
                this.error.innerHTML = "";   
                this.datepicker = this.dateInput.value;
            })                 
        }

        this.next.addEventListener('click', (e) => {

            if (this.id > this.total) {
                this.sendForm();
                return;                
            }
            
            if (this.checkAnswers(true)) {
                this.changeSlide(1);
            }

        })        
    }

    async sendForm() {
        const name = this.calculator.querySelector('.calculator-name-field');
        const contact = this.calculator.querySelector('.calculator-contact-field');     
        let err = false;   

        if (!this.isPhoneNumber(contact.value) && !this.isValidEmail(contact.value)) {
            if (ajax_object.lang == 'ru_RU') {
                this.error.innerHTML = "Введите номер телефона или email";
            } else {
                this.error.innerHTML = "Please enter valid phone or email";
            }                
           
            err = true;
        } else {
            this.error.innerHTML = "";
        }

        if (!err) {
            const cookie = loadCookie();
            this.next.classList.add(`calculator__next--loading`);
            const response = await fetch(ajax_object.ajax_url, {
                method: "POST",
                body: new URLSearchParams({
                action: "send_custom_email",
                name: name.value,
                contact: contact.value,               
                answers: this.answers,
                date: this.datepicker,
                utm_source: cookie.utm_source ? cookie.utm_source : '',
                utm_campaign_id: cookie.utm_campaign_id ? cookie.utm_campaign_id : '',
                utm_adgroup_id: cookie.utm_adgroup_id ? cookie.utm_adgroup_id : '',
                utm_term: cookie.utm_term ? cookie.utm_term : '',
                gclid: cookie.gclid ? cookie.gclid : '',
                src_label: window.location.pathname,                
                feedback_email: ajax_object.feedback_email
                })
            });

            if (response.status == 200) {
                this.back.style.display = "none";
                this.next.style.display = "none";
            }

            const result = await response.text();
            this.contacts.innerHTML = '<p class="calculator__result">' + result + '</p>';
              
        }
        
    }

    isPhoneNumber(value) {
        const digits = value.replace(/\D/g, ''); 
        return /^(\d{10,15})$/.test(digits);    
    }

    isValidEmail(email) {
        email = email.trim();

        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // loadCookie() {
    //     const match = document.cookie.match(
    //         new RegExp('(?:^|; )' + this.cookieName + '=([^;]*)')
    //     );

    //     if (!match) {
    //         return {};
    //     }

    //     try {
    //         return JSON.parse(decodeURIComponent(match[1]));
    //     } catch (e) {
    //         return {};
    //     }
    // }    

    checkAnswers(check) {
        const inputs = this.calculator.querySelectorAll('input[type="radio"]');
        const date = document.getElementById('calculatorDate');
      
        if (date) {
            
            if (!date.value) {                
                if (ajax_object.lang == 'ru_RU') {
                    this.error.innerHTML = 'Выберите дату';
                } else {
                    this.error.innerHTML = 'Please pick the date';
                }   
              // return false;             
            } else {   
                this.datepicker = date.value;
                // return true;
            }

            
        }

        let checked = false;
        if (inputs.length == 0) {
          
            checked = true;
        }
        inputs.forEach(input => {
            if (input.checked) {               
                checked = true;
                this.saveAnswer(+input.value)
            }
        })

        if (!checked && check && !date) {
            
            if (ajax_object.lang == 'ru_RU') {
                this.error.innerHTML = 'Выберите хотя бы один вариант';
            } else {
                this.error.innerHTML = 'Please pick one option';
            }
            
        } else {

            if (date && date.value && checked && check) {
                this.error.innerHTML = '';
            }

            if (!date && checked && check) {
                this.error.innerHTML = '';
            }
            
        }

        return (checked && date && date.value) || (checked && !date);
    }

    saveAnswer(value) {        

        if (this.data[this.id]) {
            this.answers[this.id] = this.data[this.id].answers[value].answer_text;    
        }
  
    }

    changeSlide(add) {

        if ((add == -1) && this.id == 0) {
            return;
        }
        

        if ((add == 1) && (this.id == this.total)) {
            this.showForm();  
            this.id = this.id + add;     
            return;          
        }   

        this.id = this.id + add;            

        this.current.innerHTML = (this.id + 1);             

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
        this.dateContainer.innerHTML = "";
        if (this.data[this.id].add_datepicker_field) {
           
            const input = document.createElement('input');
            input.type = 'date';
            input.id = 'calculatorDate';
            input.name = 'calculator_date';     
            input.value = this.datepicker;      
            const div = document.createElement('div');
            const div2 = document.createElement('div');
            if (ajax_object.lang == 'ru_RU') {
                div2.innerText = "Дата мероприятия";
            } else {
                div2.innerText = "Date of the Event";    
            }
            
            div.appendChild(input);         
            this.dateContainer.appendChild(div2);  
            this.dateContainer.appendChild(div);
            input.addEventListener('change', () => {
                this.error.innerHTML = "";   
                this.datepicker = input.value;
            })                 
        }

        const answers = this.data[this.id].answers;    
        
        if (answers) {
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

                if (this.answers[this.id]) {
                    if (answer.answer_text == this.answers[this.id]) {
                        input.checked = true;
                    }                
                } else if (answer.selected_by_default) {
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
            })
        }

    }

}
