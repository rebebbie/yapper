@props(['yap'])
<div class="card bg-base-100 shadow mt-8" style="word-wrap:break-word">
    <div class="card-body">
        <div class="flex space-x-3">
            @if($yap->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                        <img src="<https://avatars.laravel.cloud/>{{ urlencode($yap->user->email) }}"
                             alt="{{ $yap->user->name }}'s avatar"
                             class="rounded-full" />
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        <img src="<https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth>"
                        alt="Anonymous User"
                        class="rounded-full" />
                    </div>
                </div>
            @endif

            <div class="min-w-0 flex-1">
                <div class="flex justify-between w-full">
                    <div class="flex items-center gap-1">
                        <span class="text-sm font-semibold">{{ $yap->user ? $yap->user->name : 'Anonymous' }}</span>
                        <span class="text-base-content/60">·</span>
                        <span class="text-sm text-base-content/60">{{ $yap->created_at->diffForHumans() }}</span>
                        @if ($yap->updated_at->gt($yap->created_at->addSeconds(5)))
                            <span class="text-base-content/60">.</span>
                            <span class="text-sm text-base-content/60 italic">edited {{$yap->updated_at}}</span>
                        @endif
                    </div>

                    @can('update',$yap)
                    <div class="flex gap-1">
                        <a href="/yaps/{{ $yap->id }}/edit" class="btn btn-ghost btn-xs">
                            Edit
                        </a>
                        <form method="POST" action="/yaps/{{ $yap->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this chirp?')"
                                class="btn btn-ghost btn-xs text-error">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>

                <p class="mt-1">
                    {{ $yap->message }}
                </p>
            </div>
        </div>
    </div>
</div>