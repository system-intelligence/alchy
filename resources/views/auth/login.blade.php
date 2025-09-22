<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Login</h1>

        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="/login">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            class="input input-bordered w-full @error('email') input-error @enderror"
                            value="{{ old('email') }}"
                            required
                        />
                        @error('email')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="input input-bordered w-full @error('password') input-error @enderror"
                            required
                        />
                        @error('password')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="card-actions justify-between mt-4">
                        <a href="/" class="btn btn-ghost btn-sm">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>