@extends('layout.main')

@section('content')
    <!-- component -->
    <!-- page -->
    <main
        class="mx-auto flex min-h-screen w-full items-center justify-center bg-gray-900 text-white"
    >
        <form method="post" action="{{route('login.submit')}}">
            @csrf
            <!-- component -->
            <section class="flex w-[30rem] flex-col space-y-10">
                <div class="text-center text-4xl font-medium">Log In</div>

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
                        type="password"
                        placeholder="Password"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                        name="password"
                    />
                    @error('password'){{$message}}@enderror
                </div>

                <button
                    class="transform rounded-sm bg-pink-600 py-2 font-bold duration-300 hover:bg-pink-400"
                >
                    LOG IN
                </button>

                {{--            <a--}}
                {{--                href="#"--}}
                {{--                class="transform text-center font-semibold text-gray-500 duration-300 hover:text-gray-300"--}}
                {{--            >FORGOT PASSWORD?</a--}}
                {{--            >--}}

                <p class="text-center text-lg">
                    No account?
                    <a
                        href="{{route('register')}}"
                        class="font-medium text-pink-500 underline-offset-4 hover:underline"
                    >Create One</a
                    >
                </p>
            </section>
        </form>
    </main>
@endsection
