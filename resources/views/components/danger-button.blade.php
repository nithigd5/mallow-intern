<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger']) }}
        style="width: {{ $attributes->get('width') }}; height: {{ $attributes->get('height') }};">
{{ $slot }}
</button>
