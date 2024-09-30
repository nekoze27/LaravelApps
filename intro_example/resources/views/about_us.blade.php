<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AISuperChat</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="flex flex-col min-h-screen bg-gray-100 text-gray-900 font-sans">
    <nav class="bg-gray-900 text-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div>
                    <a href="#" class="flex items-center hover:text-gray-300">
                        <span class="font-bold">AISuperChat</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="hover:text-gray-300">Home</a>
                    <a href="#" class="hover:text-gray-300">About</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-gray-300">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <header class="bg-gray-800 text-white" style="height: 30vh;">
        <div class="flex items-center justify-center h-full">
            <div class="text-center">
                <h1 class="text-3xl font-bold">about_us</h1>
                <p class="mt-3 text-lg">Start your journey into the future of communication today!</p>
            </div>
        </div>
    </header>
    <main class="flex-grow">
        <div class="max-w-4xl mx-auto py-12 px-4">
            <!--  -->
            <div class="flex flex-col space-y-4">
            </div>
        </div>
    </main>
    <footer class="bg-gray-900 text-white text-center p-4">
        <p>© {!! date('Y') !!} AISuperChat Service. All rights reserved.</p>
    </footer>
    </body>
</html>
