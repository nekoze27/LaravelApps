<x-front-layout>
    <x-slot:early-asset-load>
        @vite('resources/css/calculators/takeHomePay.css')
    </x-slot:early-asset-load>

    <div id="takeHomePay-calculator" class="takeHomePay-calculator-container"></div>

    <x-slot:late-asset-load>
        @vite('resources/js/calculators/takeHomePay.ts')
    </x-slot:late-asset-load>
</x-front-layout>
