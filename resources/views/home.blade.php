<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">
  <main class="text-slate-600 ">
    <header
      class="relative flex flex-col items-center justify-center w-full min-h-screen gap-4 py-8 border-b-2 border-gray-200 font-poppins px-8">
      @if (Route::has('login'))
        <livewire:welcome.navigation />
      @endif
      <div class="z-10">

        <h1 class="max-w-3xl mx-auto text-3xl pb-4 font-bold text-center text-teal-700 font-merriweather ">
          Simple Task Management with drag and drop reordering of tasks.
        </h1>
        <div class="max-w-4xl mx-auto pt-2">
          <ul class="flex flex-col gap-4 rounded-lg font-inter">
            <li
              class="p-4 bg-white rounded-xl shadow-[10px_10px_1px_rgba(15,_118,_110,_1),_0_10px_20px_rgba(204,_204,_204,_1)]">
              <img src="{{ Vite::asset('resources/images/screenshot.jpg') }}"
                class="rounded-xl border-gray-300 border-2" alt="A screenshot">
            </li>
          </ul>
        </div>
      </div>
      <div style="background-image: url('{{ Vite::asset('resources/images/bg-image.webp') }}')"
        class="absolute top-0 left-0 w-full h-full bg-cover md:bg-center blur bg-[left_-17rem_top_-2rem] bg-none position z-0 ">
      </div>
    </header>
  </main>
  <footer class="py-8 lg:px-0 md:px-8 px-0">
    <div class="flex pb-6 md:px-0 px-8 gap-4  border-b border-gray-600 max-w-4xl m-auto ">
      <article class="flex-1">
        <h2 class="pb-2 text-lg font-bold text-teal-700 uppercase">
          Humphrey Yeboah
        </h2>
        <p>
          A full stack and mobile developer ready to help to bring your
          business online.
        </p>
      </article>
      <article>
        <h2 class="pb-2 text-lg font-bold text-teal-700 uppercase">
          Socials
        </h2>
        <div class="sm:block grid grid-cols-2">
          <a href="https://www.linkedin.com/in/humphrey-yeboah-9850881b3/"
            class="p-2 transition-colors rounded hover:dark:bg-gray-800 hover:bg-gray-400 hover:text-white"
            target="_blank" rel="noopener noreferrer" title="Humphrey Yeboah on LinkedIn">
            <i class="text-lg fa-brands fa-linkedin"></i>
          </a>
          <a href="https://www.twitter.com/hakylepremier"
            class="p-2 transition-colors rounded hover:dark:bg-gray-800 hover:bg-gray-400 hover:text-white"
            target="_blank" rel="noopener noreferrer" title="Humphrey Yeboah on Twitter">
            <i class="text-lg fa-brands fa-x-twitter"></i>
          </a>
          <a href="https://github.com/hakylepremier"
            class="p-2 transition-colors rounded hover:dark:bg-gray-800 hover:bg-gray-400 hover:text-white"
            target="_blank" rel="noopener noreferrer" title="Humphrey Yeboah on Github">
            <i class="text-lg fa-brands fa-github"></i>
          </a>
          <a href="https://facebook.com/humphrey.yeboah.5"
            class="p-2 transition-colors rounded hover:dark:bg-gray-800 hover:bg-gray-400 hover:text-white"
            target="_blank" rel="noopener noreferrer" title="Humphrey Yeboah on Facebook">
            <i class="text-lg fa-brands fa-facebook"></i>
          </a>
        </div>
      </article>
    </div>
    <p class="px-8 pt-6 text-center">
      &copy; Copyright
      <script>
        new Date().getFullYear()
        }, Made by {
          " "
        }
      </script>
      <a href="http://humphreyyeboah.com" target="_blank" rel="noopener noreferrer"
        class="font-bold text-inherit text-teal-700 border-b dark:border-b-white hover:text-neutral hover:dark:text-gray-300 border-b-gray-600 pb-1">
        Humphrey Yeboah
      </a>
    </p>
    <p class="text-center pt-4">
      <a href="https://www.pexels.com/photo/flat-lay-photography-of-macbook-pro-beside-white-spiral-notebook-and-green-mug-434337/"
        class="text-center text-gray-300 border-b-2" target="_blank" rel="noopener noreferrer">
        Photo by Pixabay
      </a>
    </p>
  </footer>
</body>

</html>
