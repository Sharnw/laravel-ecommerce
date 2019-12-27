
<a-divider><h4 class="mt-1">{{ __('Shipping Options') }}</h4></a-divider>

<a-form-item
	validate-status="error"
    :help="shippingOptionError">
	@foreach ($shippingOptions as $shipping)
	    <a-switch @change="handleShippingChange($event, '{{ $shipping->identifier() }}')"></a-switch>
	    {{ $shipping->name() }}
	@endforeach
</a-form-item>
<input type="hidden" name="shipping_option" v-model="shippingOption" />
