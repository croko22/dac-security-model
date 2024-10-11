{{-- <x-layouts.guest-layout> --}}

<h2 class="text-center">Login</h2>
<form action="{{ route('login') }}" method="POST" class="mt-6">
    @csrf
    <div class="mb-5">
        <label for="email" class="label">Your email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" class="input"
            placeholder="john@doe.com" />
        @error('email')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-5">
        <label for="password" class="label">Your
            password</label>
        <input type="password" id="password" name="password" class="input" required />
        @error('password')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex items-center justify-between gap-5">
        <button type="submit" class="button-primary">Login</button>
    </div>
</form>
{{-- </x-layouts.guest-layout> --}}
