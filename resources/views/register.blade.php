@extends("layout.main")

@section('content')
    <main
        class="mx-auto flex min-h-screen w-full items-center justify-center bg-gray-900 text-white"
    >
        <!-- component -->
        <form method="post" action="{{route('register.store')}}">
            @csrf
            <section class="flex w-[30rem] flex-col space-y-10">
                <div class="text-center text-4xl font-medium">Create an Account</div>


                <div
                    class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-pink-500"
                >
                    <input
                        type="text"
                        placeholder="name"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                        name="name"
                    />
                    @error('name'){{$message}}@enderror
                </div>
                <div
                    class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-pink-500"
                >
                    <input
                        type="text"
                        placeholder="Email"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                        name="email"
                    />
                    @error('email'){{$message}}@enderror
                </div>

                <div
                    class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-pink-500"
                >
                    <input
                        name="phone"
                        type="text"
                        placeholder="Phone"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                    />
                    @error('phone'){{$message}}@enderror
                </div>
                <div
                    class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-pink-500"
                >
                    <input
                        name="password"
                        type="password"
                        placeholder="Password"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                    />
                    @error('password'){{$message}}@enderror
                </div>

                <div
                    class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-pink-500"
                >
                    <input
                        name="password_confirmation"
                        type="password"
                        placeholder="Confirm Password"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                    />
                </div>

                <button type="submit"
                    class="transform rounded-sm bg-pink-600 py-2 font-bold duration-300 hover:bg-pink-400"
                >
                    Sign Up
                </button>

                <p class="text-center text-lg">
                    Have an account?
                    <a
                        href="{{route('login')}}"
                        class="font-medium text-pink-500 underline-offset-4 hover:underline"
                    >Log in</a
                    >
                </p>
            </section>
        </form>
    </main>
@endsection
