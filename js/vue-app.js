const app = Vue.createApp({
        // Start Vue
})

app.component('call-to-action', {
    data() {
        return {
            successImageVisibility: 'hidden',        // visible | hidden
            title: "Subscribe to our newsletter",
            description: "Get the latest news and promotions",
            placeholder: "Type your email address…",
            email: "",
            message: "",        // Input field verification message
            messageHidden: true,
            emailValid: false,
            termsAccepted: false,
            formValid: false
        }
    },
    methods: {
        validateEmail()
        {
            // RegEx from stackoverflow.com --- https://stackoverflow.com/questions/46155/how-to-validate-an-email-address-in-javascript
            const regularExpression = /^((?!\.)[\w-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/

            this.emailValid = regularExpression.test(this.email)

            const excludedDomains = {
                'Colombia' : 'co',
                'Xeland' : 'xe'
            }
            const emailToArray = this.email.split(".")      // String to array by dot
            const emailExtention = emailToArray[emailToArray.length - 1]        // Last string after dot

            if (this.emailValid) {
                    
                this.messageHidden = true
                this.message = ""

                    for (let country in excludedDomains) {
                        if (emailExtention == excludedDomains[country]) { 
                            this.messageHidden = false
                            this.message = "We are not accepting subscriptions from " + country + " emails"
                            this.emailValid = false
                        }
                    }

            } else {
                    this.messageHidden = false
                    this.message = "Please provide a valid e-mail address"
            }
        },
        validateForm()
        {
            if (this.emailValid && this.termsAccepted) {        // When email is validated and terms are accepted
                this.formValid = true
                this.messageHidden = true
                this.message = ""
                
                this.saveToDatabase(this.email, this.termsAccepted);        // Save to database

                this.title = "Thanks for subscribing!"
                this.description = "You have successfully subscribed to our email listing."
            } else if (!this.emailValid && this.termsAccepted) {
                this.message = "Please provide a valid e-mail address"
            } else if (this.emailValid && !this.termsAccepted) {
                this.message = "You must accept the terms and conditions"
            } else {
                this.message = "Please provide a valid e-mail address and accept the terms & conditions"
            }
        },
        saveToDatabase(email, terms)
        {
            axios({        // Use Axios to process in background
                method: 'post',
                url: 'submit',
                data: {
                    email: email,
                    terms: terms
                }
            });
        }
            
    },
    template:
    /*html*/
            `
            <div class="success-image" v-if="formValid"></div>
            <div id="info">
                <h3 id="title">{{ title }}</h3>
                <p id="description">{{ description }}</p>
                <h3 id="notification" :class="{hidden : messageHidden}">{{ message }}</h3>
            </div>
            <form id="form" method="POST" action="" v-if="!formValid" @submit.prevent>
                <input type="text" :placeholder="placeholder" v-model="email" @keyup="validateEmail">
                <div id="terms-base">
                    <input id="terms-accept" type="checkbox" v-model="termsAccepted">
                    <label for="terms-accept">I agree to <a href="#">terms of service</a></label>
                </div>
                <button type="submit" :disabled="!emailValid || !termsAccepted" @click="validateForm">Subscribe!</button>
            </form>
            `
})

app.mount('#app')