<template>
    <div>
        <payment-option-toggle identifier="a-cash-on-delivery" label="Cash On Delivery"></payment-option-toggle>
    </div>    
</template>

<script>
export default {
    name: 'avored-cash-on-delivery',
    props: [],
    data () {
        return {
            cardOnDeliveryToggled: false
        }
    },
    mounted() {        
        var cashPayment = this;
        // proceed to order submission
        EventBus.$on('placeOrderBefore', function() {
            // check if the event was for this payment option
            if (cashPayment.cardOnDeliveryToggled) {
                // submit order
                EventBus.$emit('placeOrderAfter');
            }
        });
        // deselect this payment method if a different one is selected
        EventBus.$on('selectedPaymentIdentifier', function(identifier) {
            cashPayment.cardOnDeliveryToggled = (identifier == 'a-cash-on-delivery');
        });
    }
}
</script>
