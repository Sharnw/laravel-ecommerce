<template>
    <div>
        <a-switch @click="togglePaymentOption()" :checked="selectedPaymentOption">
        </a-switch> 
        {{ label }}
    </div>    
</template>

<script>

export default {
    name: 'payment-option-toggle',
    props: ['identifier', 'label'],
    data () {
        return {
            selectedPaymentOption: false
        }
    },
    methods: {
        togglePaymentOption() {
            this.selectedPaymentOption = !this.selectedPaymentOption;
            if (this.selectedPaymentOption) {
                EventBus.$emit('selectedPaymentIdentifier', this.identifier);
            } else {
                EventBus.$emit('selectedPaymentIdentifier', '');
            }
        }
    },
    mounted() {        
        var paymentOption = this;
        // deselect this payment method if a different one is selected
        EventBus.$on('selectedPaymentIdentifier', function(identifier) {
            if (identifier != paymentOption.identifier) {
              paymentOption.selectedPaymentOption = false;  
            }
        });
    }
}
</script>
