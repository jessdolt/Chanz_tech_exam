<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css') @vite('resources/js/app.js')
    </head>
    <body>
        <main
            class="w-screen h-screen flex justify-center items-center bg-sky-300"
        >
            <div
                class="flex flex-col items-center justify-center bg-white p-12 rounded-md min-w-[600px]"
            >
                <form class="w-full" action="/convert" method="POST">
                    @csrf @method('post')
                    <div class="flex flex-col gap-2 items-center">
                        <label
                            for="inputValue"
                            class="text-2xl -mt-4 mb-4 font-bold uppercase"
                            >Convert Now!</label
                        >
                        <input
                            id="inputValue"
                            name="inputValue"
                            type="text"
                            placeholder="306 or 'three hundred and six'"
                            class="w-full p-2 border border-gray-300 outline-1 outline-sky-400 rounded-md"
                        />
                    </div>

                    <button
                        class="block font-bold uppercase py-2 px-8 bg-green-400 mx-auto mt-6 rounded-md hover:-translate-y-1 hover:shadow-md hover:opacity-80 duration-200"
                    >
                        Click me!
                    </button>
                </form>

                <div class="mt-10">
                    <div>
                        <span>Converted Value:</span>
                        @isset($convertedValue)
                        <span id="convertedValue" class="font-bold text-xl">{{
                            $convertedValue
                        }}</span>
                        @endisset
                    </div>
                    <div>
                        <span>Conversion from PHP to USD:</span>
                        @isset($numericValue)
                        <span id="hiddenValue" class="hidden">{{
                            $numericValue
                        }}</span>
                        <span
                            id="numericValue"
                            class="font-bold text-xl"
                        ></span>
                        @endisset
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
