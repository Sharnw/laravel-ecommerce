<script>
import isNil from 'lodash/isNil'

export default {
    props: ['items', 'addresses'],
    data() {
        return {
            form: this.$form.createForm(this),
            submitStatus:false,
            newAccount: true,
            useDifferentBillingAddress: false,
            billingAddresses: [],
            shippingAddresses: [],
            selectedShippingAddress: null,
            selectedBillingAddress: null,
            paymentOption: '',
            paymentOptionError: '',
            shippingOption: '',
            shippingOptionError: '',
            shippingCountry: 0,
            billingCountry: 0
        }
    },
    methods: {
        handleSubmit (e) {
            e.preventDefault();

            var valid = true;

            // validate that a payment option has been selected
            if (this.paymentOption == '') {
                this.paymentOptionError = 'Please select a payment option.';
                valid = false;
            }
            // validate that a shipping option has been selected
            if (this.shippingOption == '') {
                this.shippingOptionError = 'Please select a shipping option.';
                valid = false;
            }

            // bail-out if this validation fails
            if (!valid) return;

            // attempt to process the order
            // this will bail-out if payment option fails
            EventBus.$emit('placeOrderBefore');
        },
        shippingCountryOptionChange(val) {
            this.shippingCountry = val;
        },
        billingCountryOptionChange(val) {
            this.billingCountry = val;
        },
        newAccountSwitchChange(val) {
            this.newAccount = val;
        },
        useDifferentBillingAddressSwitchChange(val) {
            this.useDifferentBillingAddress = !val;
        },
        handleShippingChange(enabled, identifier) {
            this.shippingOptionError = '';
            if (enabled) this.shippingOption = identifier;
        },
        changeSelectedShippingAddress(val) {
            this.selectedShippingAddress = this.shippingAddresses[val];
        },
        changeSelectedBillingAddress(val) {
            this.selectedBillingAddress = this.billingAddresses[val];
        }
    },
    mounted() {
        if (!isNil(this.addresses)) {
            this.addresses.forEach(address => {
                if (address.type === 'SHIPPING') {
                    this.shippingAddresses.push(address);

                    if (isNil(this.selectedShippingAddress)) {
                        this.selectedShippingAddress = address;
                    }
                }
                if (address.type === 'BILLING') {
                    this.billingAddresses.push(address);
                    if (isNil(this.selectedBillingAddress)) {
                        this.selectedBillingAddress = address;
                    }
                }
                
            });
        }
        var app = this
        EventBus.$on('selectedPaymentIdentifier', function(identifier) {
            app.paymentOptionError = '';
            app.paymentOption = identifier;
        });

        // order submission event
        EventBus.$on('placeOrderAfter', function() {
            console.log('placeorder after')
            document.getElementById('checkout-form').submit()
        })
    }
}
</script>
