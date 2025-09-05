<div wire:ignore>
    <input type="text" class="{{ $class }}" id="{{ $inputId }}" @disabled($disabled) />
</div>

@script
    <script>
        const ts = "{{ $thousandsSeparator }}";
        const rx = "{{ $radix }}";
        const inputElement = document.getElementById('{{ $inputId }}');

        const currentValue = $wire.get('value');
        if (currentValue != null && currentValue !== '') {
            let [intPart, decPart] = currentValue.toString().split('.');
            const sign = intPart.startsWith('-') ? '-' : '';
            
            intPart = intPart.replace(/^-/, '').replace(/\D/g, '');
            if (ts) {
                intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ts);
            }

            inputElement.value = sign + (decPart !== undefined && decPart !== '' ?
                intPart + rx + decPart :
                intPart);
        }

        const masked = IMask(inputElement, {
            mask: {{ $mask }},
            thousandsSeparator: ts,
            radix: rx,
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
