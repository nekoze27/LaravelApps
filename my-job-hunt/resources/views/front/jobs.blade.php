<x-front-layout>
    <x-slot:title>MyJobHunt Jobs Items</x-slot:title>

    <h1 class="text-4xl font-bold mb-4 text-blue-500">Jobs</h1>
    <p class="text-lg mb-6">Discover various job!</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($jobsItems as $i => $jobsItem)
            <x-cards.job-card :job="$jobsItem" color="blue">
                <p class="text-center">( {{ $i + 1 }} )</p>
            </x-cards.job-card>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $jobsItems->links() }}
    </div>
</x-front-layout>
