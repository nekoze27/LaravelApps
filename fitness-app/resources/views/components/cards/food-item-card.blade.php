<div class="bg-{{ $color }}-200 p-4 rounded shadow　food-card">
    <a href="{{ route('food.show', $food) }}" class="block">
        <!-- Well begun is half done. - Aristotle -->
        <h2 class="text-2xl font-bold mb-2">{{ $food->name }}</h2>
        <p class="mb-1"><strong>Protein:</strong> {{ $food->protein }}g</p>
        <p class="mb-1"><strong>Carbs:</strong> {{ $food->carbs }}g</p>
        <p class="mb-1"><strong>Fat:</strong> {{ $food->fat }}g</p>
        <p class="mb-1"><strong>Type:</strong> {{ $food->food_type_name ?? 'N/A' }}</p>
        <div class="mt-auto">
            {{ $slot }}
        </div>
    </a>
</div>
