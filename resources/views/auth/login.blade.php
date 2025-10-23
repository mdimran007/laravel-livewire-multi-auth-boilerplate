<x-guest-layout>

    <div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">

        <div class="h-screen w-screen flex justify-center items-center">

            <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
                <div class="card overflow-hidden sm:rounded-md rounded-none">
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="p-6">
                            <a href="{{ url('/') }}" class="block mb-8">
                                <img class="h-6 block dark:hidden" src="{{ getSettingData('app_logo') != null? getSettingData('app_logo'): asset('assets/no-image.png') }}" alt="">
                                <img class="h-6 hidden dark:block" src="{{ getSettingData('app_logo') != null? getSettingData('app_logo'): asset('assets/no-image.png') }}" alt="">
                            </a>

                            <h4 class="fs-32 fw-600 lh-48 text-main-color pb-5">{{__("Login:")}}</h4>


                            @if (session('status'))
                                <div class="bg-success/25 mb-3 p-4 rounded-md text-sm text-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="email">Email Address</label>
                                <input id="email" class="form-input" type="email" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                 @error('email')
                                    <span class="fs-12 text-danger">{{ $message }}</span>
                                 @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="password">Password</label>
                                <input id="password" class="form-input" type="password" placeholder="Enter your password" name="password"
                            required autocomplete="current-password">
                             @error('password')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <input type="checkbox" class="form-checkbox rounded" id="remember_me" name="remember">
                                    <label class="ms-2" for="remember_me">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-primary border-b border-dashed border-primary">Forget Password ?</a>
                                @endif
                            </div>

                            <div class="flex justify-center mb-6">
                                <button class="btn w-full text-white bg-primary" type="submit"> Log In </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</x-guest-layout>
