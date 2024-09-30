<div class="bg-blue-200 p-4 rounded shadow">
    <h2 class="text-2xl font-bold mb-2">{{ $job->company }}</h2>
    <p class="mb-1"><strong>Title:</strong> {{ $job->title }}g</p>
    <p class="mb-1"><strong>Location:</strong> {{ $job->location }}g</p>
    <p class="mb-1"><strong>Type:</strong> {{ $job->type }}g</p>
    <p class="mb-1"><strong>JobCategory:</strong> {{ $job->job_category_name ?? 'N/A' }}</p>
    <div class="mt-auto">
        {{ $slot }}
    </div>
</div>
