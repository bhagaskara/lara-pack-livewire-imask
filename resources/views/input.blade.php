<div wire:ignore>
    <input type="text" class="{{ $class }}" id="{{ $inputId }}" @disabled($disabled) />
</div>

@script
    <script>
        const inputElement = document.getElementById('{{ $inputId }}');

        const currentValue = $wire.get('value');
        if (currentValue != null) inputElement.value = currentValue;

        const masked = IMask(inputElement, {
            mask: {{ $mask }},
            thousandsSeparator: "{{ $thousandsSeparator }}",
            radix: "{{ $radix }}",
        });

        let debounceTimer;
        inputElement.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                @this.set('value', masked.unmaskedValue);
            }, {{ $debounceTime }});
        });
    </script>
@endscript
