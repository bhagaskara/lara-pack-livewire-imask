<div wire:ignore>
    <input type="text" class="{{ $class }}" id="{{ $inputId }}" @disabled($disabled) />
</div>

@script
    <script>
        const inputElement = document.getElementById('{{ $inputId }}');

        const currentValue = $wire.get('value');
        if (currentValue != null && currentValue !== '') {
            const ts = "{{ $thousandsSeparator }}";
            const rx = "{{ $radix }}";

            let raw = currentValue.toString();

            // Normalize all existing radix chars to dot (.) for processing
            if (rx !== '.') {
            raw = raw.replace(new RegExp('\\' + rx, 'g'), '.');
            }

            let [intPart, decPart] = raw.split('.');
            const sign = intPart.startsWith('-') ? '-' : '';
            intPart = intPart.replace(/^-/, '').replace(/\D/g, '');

            if (ts) {
            intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ts);
            }

            inputElement.value = sign + (decPart !== undefined && decPart !== ''
            ? intPart + rx + decPart
            : intPart);
        }

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
