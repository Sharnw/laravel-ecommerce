
<a-divider><h4 class="mt-1">{{ __('Payment Options') }}</h4></a-divider>

<a-form-item
	:validate-status="paymentOptionError == '' ? '' : 'error'"
    :help="paymentOptionError">
	@foreach ($paymentOptions as $payment)
	    <p>
	        {{ $payment->render() }}
	    </p>
	@endforeach
</a-form-item>
<input type="hidden" name="payment_option" v-model="paymentOption" />

