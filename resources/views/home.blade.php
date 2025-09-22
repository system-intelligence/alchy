
<x-layout>
    <x-slot:title>
        Home Feed
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Data Overview</h1>

          <!-- Alchy Form -->
<div class="card bg-base-100 shadow mt-8">
    <div class="card-body">
        <form method="POST" action="/alchies">
            @csrf
            <div class="form-control w-full">
                <textarea
                    name="message"
                    placeholder="What's on your mind?"
                    class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                    rows="4"
                    maxlength="255"
                    required
                >{{ old('message') }}</textarea>

                @error('message')
                    <div class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="mt-4 flex items-center justify-end">
                <button type="submit" class="btn btn-primary btn-sm">
                    Post Alchy
                </button>
            </div>
        </form>
    </div>
</div>

        <div id="alchies-container" class="space-y-4 mt-8">
            @forelse ($alchies as $alchy)
                <x-alchy :alchy="$alchy" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="mt-4 text-base-content/60">No alchies yet. Be the first to alchy!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function pollForAlchies() {
            fetch('/api/alchies/latest')
                .then(response => response.json())
                .then(alchies => {
                    const container = document.getElementById('alchies-container');
                    container.innerHTML = ''; // Clear existing

                    if (alchies.length === 0) {
                        container.innerHTML = '<div class="hero py-12"><div class="hero-content text-center"><div><svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg><p class="mt-4 text-base-content/60">No alchies yet. Be the first to alchy!</p></div></div></div>';
                        return;
                    }

                    alchies.forEach(alchy => {
                        const isEdited = new Date(alchy.updated_at) > new Date(new Date(alchy.created_at).getTime() + 5000);
                        const alchyHtml = `
                            <div class="card bg-base-100 shadow">
                                <div class="card-body">
                                    <div class="flex space-x-3">
                                        <div class="avatar">
                                            <div class="size-10 rounded-full">
                                                <img src="https://avatars.laravel.cloud/${encodeURIComponent(alchy.user?.email || 'anonymous')}?vibe=stealth" alt="${alchy.user?.name || 'Anonymous'}'s avatar" class="rounded-full" />
                                            </div>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div class="flex justify-between w-full">
                                                <div class="flex items-center gap-1">
                                                    <span class="text-sm font-semibold">${alchy.user?.name || 'Anonymous'}</span>
                                                    <span class="text-base-content/60">·</span>
                                                    <span class="text-sm text-base-content/60">${new Date(alchy.created_at).toLocaleString()}</span>
                                                    ${isEdited ? '<span class="text-base-content/60">·</span><span class="text-sm text-base-content/60 italic">edited</span>' : ''}
                                                </div>
                                                <div class="flex gap-1">
                                                    <a href="/alchies/${alchy.id}/edit" class="btn btn-ghost btn-xs">Edit</a>
                                                    <form method="POST" action="/alchies/${alchy.id}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this alchy?')" class="btn btn-ghost btn-xs text-error">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <p class="mt-1">${alchy.message}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', alchyHtml);
                    });
                })
                .catch(error => console.error('Polling error:', error));
        }

        // Poll every 5 seconds
        setInterval(pollForAlchies, 5000);
    </script>
</x-layout>