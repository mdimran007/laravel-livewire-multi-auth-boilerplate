<x-guest-layout>

    <div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">

        <div class="h-screen w-screen flex justify-center items-center">

            <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
                <div class="card overflow-hidden sm:rounded-md rounded-none">
                    <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                        <div class="p-6">
                            <a href="{{ url('/') }}" class="block mb-8">
                                <img class="h-6 block dark:hidden" src="{{ getSettingData('app_logo') != null? asset('storage/' . getSettingData('app_logo')): asset('assets/no-image.png') }}" alt="">
                                <img class="h-6 hidden dark:block" src="{{ getSettingData('app_logo') != null? asset('storage/' . getSettingData('app_logo')): asset('assets/no-image.png') }}" alt="">
                            </a>

                            <div class="mb-4 text-sm text-gray-600">
                                <h4 class="fs-32 fw-600 lh-48 text-main-color pb-5">{{__("Forgot Password")}}</h4>
                            </div>

                            @if (session('status'))
                                <div class="bg-success/25 text-success text-sm rounded-md p-4" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="email">Email Address</label>
                                <input id="email" class="form-input" type="email" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autofocus>
                                 @error('email')
                                    <span class="fs-12 text-danger">{{ $message }}</span>
                                 @enderror
                            </div>
                            <div class="flex justify-center mb-6">
                                <button class="btn w-full text-white bg-primary" type="submit">  {{ __('Email Password Reset Link') }} </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</x-guest-layout>
