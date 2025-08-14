export default class Mailing {
    constructor() {
        this.addListeners()
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
        form.addEventListener('submit', async (e)=> {
            e.preventDefault();
            
            const formData = new FormData(form);
            const valid = this.validateForm(formData, resultClass);
            const btn = form.querySelector(`.${btnClass}`);
            console.log(ajax_object.feedback_email);

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
        
        })
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
        })

        areas.forEach(area => {
            area.value = "";
        })
    }

    isPhoneNumber(value) {
        return /^(\+?\d{1,3}[- ]?)?\d{10}$/.test(value);
    }
}