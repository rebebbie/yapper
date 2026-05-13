<x-layout>
    <x-slot:title>
        yapping
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Latest Yaps</h1>

        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="/yaps">
                    @csrf
                    <div class="form-control w-full">
                        <textarea
                            name="message"
                            placeholder="What's on your mind?"
                            class="textarea textarea-bordered w-full resize-none"
                            rows="4"
                            required
                        >{{ old('message') }}</textarea>
                    </div>

                    @error('message')
                    <div class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </div>
                    @enderror

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Yap!
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @forelse ($yaps as $yap)
            <x-yap :yap="$yap"/>
        @empty
        <div>
            <p class="text-gray-500">It's quiet in here... start the yapfest!</p>
        </div>
        @endforelse

        {{ $yaps->links() }}
    </div>
</x-layout>