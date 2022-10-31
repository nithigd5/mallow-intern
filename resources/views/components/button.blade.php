<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary']) }}
        style="width: {{ $attributes->get('width') }}; height: {{ $attributes->get('height') }};">
    {{ $slot }}
</button>
